<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Event;
use App\Models\Group;
use App\Models\Holiday;
use App\Models\TeachingHours;
use App\Services\HistoryService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\Queue\EntityNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class EventController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $events = Event::query();
        $user = Auth::user();
        if (null === $user) {
            throw new UnauthorizedHttpException('');
        }

        $user = $user->toArray();

//        if (!in_array($user['user_role'], ['super_admin', 'admin'])) {
//            $events->where('company_id', $user['company_id']);
//        }

        if ($user['user_role'] === 'teacher' && $request->query->get('my_calendar')) {
            return $this->getMyCalendar($user['id']);
        }

        if ($request->query->get('date')) {
            $date = new \DateTime($request->query->get('date'));
        } else {
            $date = new \DateTime();
        }
        $events->where('start_date', 'LIKE', $date->format('Y-m-d')."%");

        $events->orderBy('created_at', 'DESC');

        $eventArray = $events->get();

        if ($request->query->get('by_teacher')) {
            $eventArray = [];
            foreach ($events->get()->toArray() as $event) {
                $event['resourceId'] = $event['teacher_id'] ?? null;
                $eventArray[] = $event;
            }

            $holidays = Holiday::query()
                ->where('status', 'accepted')
                ->where('start_date', '<=', $date->format('Y-m-d'))
                ->where('end_date', '>=', $date->format('Y-m-d'))
                ->get()
                ->all();

            foreach ($holidays as $holiday) {
                $period = CarbonPeriod::create($holiday->start_date, $holiday->end_date);
                foreach ($period->toArray() as $date) {
                    $startDate = $date->clone();
                    $endDate = $date->clone();
                    $eventArray[] = [
                        'title' => $holiday->absence_type,
                        'description' => $holiday->absence_type,
                        'start' => $startDate->setTimeFromTimeString('00:00')->format('Y-m-d H:i'),
                        'end' => $endDate->setTimeFromTimeString('23:59')->format('Y-m-d H:i'),
                        'resourceId' => $holiday->teacher_id,
                        'display' => 'background',
                    ];
                }
            }
        }
        return response()->json([
            'status' => 'success',
            'data' => $eventArray,
        ]);
    }

    public function find(Request $request, string $id): JsonResponse
    {
        $event = Event::find($id);
        if (null === $event) {
            throw new \App\Exceptions\EntityNotFoundException('Event');
        }

        return response()->json([
            'status' => 'success',
            'data' => $event,
        ]);
    }

    private function getMyCalendar(string $userId): JsonResponse
    {
        $events = Event::query()
            ->where('teacher_id', $userId)
            ->get()
            ->all();

        $holidays = Holiday::query()
            ->where('teacher_id', $userId)
            ->where('status', 'accepted')
            ->get()
            ->all();

        foreach ($holidays as $holiday) {
            $events[] = [
                'title' => 'Holiday',
                'description' => 'Holiday',
                'start' => Carbon::parse($holiday->start_date)->setTimeFromTimeString('00:00'),
                'end' => Carbon::parse($holiday->end_date)->setTimeFromTimeString('23:59'),
            ];
        }

        return new JsonResponse([
            'data' => $events,
        ]);
    }

    public function createRepeatedForDateRange(Request $request): JsonResponse
    {
        $user = Auth::user()->toArray();
        $request->validate([
            'name' => 'string|max:255',
            'classroom_id' => 'string|max:255|nullable',
            'teacher_id' => 'string|max:255|nullable',
            'event_type_id' => 'required|string|max:255',
            'group_id' => 'string|max:255|nullable',
            'user_id' => 'string|max:255|nullable',
            'department_id' => 'string|max:255|nullable',
            'date_range_start' => 'string|max:255',
            'date_range_end' => 'string|max:255',
            'days_of_the_week' => 'array',
            'time_start' => 'string',
            'time_end' => 'string',
        ]);

        $period = CarbonPeriod::create($request->date_range_start, $request->date_range_end);
        foreach ($period->toArray() as $date) {
            if (in_array($date->dayOfWeek, $request->days_of_the_week)) {
                $startDate = $date->clone();
                $endDate = $date->clone();
                $startDate = $startDate->setTimeFromTimeString($request->time_start);
                $endDate = $endDate->setTimeFromTimeString($request->time_end);

                Event::create([
                    'start_date' => $startDate->format('Y-m-d H:i:s'),
                    'end_date' => $endDate->format('Y-m-d H:i:s'),
                    'description' => $request->name,
                    'classroom_id' => $request->classroom_id,
                    'teacher_id' => $request->teacher_id ?? null,
                    'event_type_id' => $request->event_type_id,
                    'group_id' => $request->group_id,
                    'user_id' => $request->user_id,
                    'department_id' => $request->department_id ?? null,
                    'status_id' => $request->status_id,
                    'company_id' => $request->company_id ?? $user['company_id'],
                ]);
            }
        }

        Group::create([
            'name' => $request->name,
            'data' => json_encode($request->toArray()),
        ]);

        return new JsonResponse([], 201);
    }

    public function updateTeacherForGroup(string $id, string $teacherId): JsonResponse
    {
        $event = Event::find($id);
        $event->teacher_id = $teacherId;
        $event->save();

        Event::query()->where( 'group_id', $event->group_id)->where('start_date', '>=', $event->start_date)->update([
            'teacher_id' => $teacherId,
        ]);

        return new JsonResponse([], 201);
    }

    public function updateEventsForGroup(Request $request, string $groupId): JsonResponse
    {
        $group = Group::find($groupId);
        $request->validate([
            'description' => 'string|max:255',
            'classroom_id' => 'string|max:255|nullable',
            'teacher_id' => 'string|max:255|nullable',
            'department_id' => 'string|max:255|nullable',
            'date_range_start' => 'required|string|max:255',
            'time_start' => 'string',
            'time_end' => 'string',
        ]);

        $events = Event::query()
            ->where('group_id', $groupId)
            ->where('start_date', '>=', Carbon::createFromFormat('Y-m-d', $request->date_range_start)->format('Y-m-d 00:00:00'))
            ->get();
        foreach ($events as $event) {
            $event->update($request->toArray());
            if ($request->time_start) {
                $event->start_date = Carbon::parse($event->start_date)->setTimeFromTimeString($request->time_start)->format('Y-m-d H:i');
                $event->end_date = Carbon::parse($event->end_date)->setTimeFromTimeString($request->time_end)->format('Y-m-d H:i');
            }
            $event->save();
        }

        if ($group) {
            $groupData = json_decode($group->data);
            $groupData = array_merge($groupData, $request->toArray());
            $group->data = json_encode($groupData);
            $group->save();
        }

        return new JsonResponse([], 201);
    }

    public function suspendEventsForDayForCompany(Request $request, string $companyId, string $day): JsonResponse
    {
        $user = Auth::user()->toArray();
        Event::query()
            ->join('classrooms', 'classrooms.id', '=', 'events.classroom_id')
            ->where('classrooms.company_id', $companyId)
            ->where('start_date', '>=', Carbon::parse($day)->format('Y-m-d 00:00'))
            ->where('start_date', '<=', Carbon::parse($day)->format('Y-m-d 23:59'))
            ->update([
                'status_id' => 2,
                'teacher_id' => 'not_set',
            ]);

        HistoryService::insertEventLog($user['id'], 'company_id-'.$companyId, 'UPDATE FOR COMPANY', '', 'not_set', '', '', '', '');

        return response()->json();
    }

    public function deleteEventsForGroup(Request $request, string $groupId): JsonResponse
    {
        $user = Auth::user()->toArray();
        $request->validate([
            'date_range_start' => 'required|string|max:255',
        ]);
        $group = Group::find($groupId);
        $group?->delete();
        Event::query()
            ->where('group_id', $groupId)
            ->where('start_date', '>=', Carbon::parse($request->date_range_start)->format('Y-m-d 00:00:00'))
            ->delete();

        HistoryService::insertAction($user['id'], 'delete', Event::class, ['group_id' => $groupId], ['group_id' => $groupId]);

        return new JsonResponse([], 201);
    }

    public function delete(string $id): JsonResponse
    {
        $event = Event::find($id);
        if (null === $event) {
            throw new \App\Exceptions\EntityNotFoundException('Event');
        }
        $event->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function createSingleEvent(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'string|max:255',
            'description' => 'string|max:255',
            'classroom_id' => 'string|max:255|nullable',
            'teacher_id' => 'string|max:255|nullable',
            'event_type_id' => 'required|string|max:255',
            'group_id' => 'string|max:255|nullable',
            'user_id' => 'string|max:255|nullable',
            'department_id' => 'string|max:255|nullable',
            'status_id' => 'string|max:255',
            'start_date' => 'string|max:255',
            'end_date' => 'string|max:255',
        ]);

        Event::create([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'classroom_id' => $request->classroom_id,
            'teacher_id' => $request->teacher_id,
            'event_type_id' => $request->event_type_id,
            'group_id' => $request->group_id,
            'user_id' => $request->user_id,
            'department_id' => $request->department_id,
            'status_id' => $request->status_id,
        ]);

        return new JsonResponse([], 201);
    }

    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'classroom_id' => 'string|max:255|nullable',
            'teacher_id' => 'string|max:255|nullable',
            'event_type_id' => 'required|string|max:255',
            'group_id' => 'string|max:255|nullable',
            'user_id' => 'string|max:255|nullable',
            'department_id' => 'string|max:255|nullable',
            'start_date' => 'required|string|max:255',
            'end_date' => 'required|string|max:255',
            'status_id' => 'required|string|max:255',
        ]);

        $event = Event::create($request->toArray());

        return response()->json([
            'status' => 'success',
            'data' => $event,
        ]);
    }

    public function updateDates(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'start_date' => 'required|string|max:255',
            'end_date' => 'required|string|max:255',
        ]);

        $event = Event::find($id);
        if (null === $event) {
            throw new \App\Exceptions\EntityNotFoundException('Event');
        }
        $event->update([
            'start_date' => Carbon::parse($request->start_date)->format('Y-m-d H:i'),
            'end_date' => Carbon::parse($request->end_date)->format('Y-m-d H:i'),
        ]);
        $event->save();

        return new JsonResponse([], 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'classroom_id' => 'required|string|max:255',
            'teacher_id' => 'required|string|max:255|nullable',
            'event_type_id' => 'required|string|max:255',
            'department_id' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'required|string|max:255',
            'status_id' => 'required|string|max:255',
        ]);

        $event = Event::find($id);

        if (null === $event) {
            throw new \App\Exceptions\EntityNotFoundException('Event');
        }

        if ($request->event_type_id !== $event->event_type_id) {
            Event::query()->where( 'group_id', $event->group_id)->where('start_date', '>=', $event->start_date)->update([
                'event_type_id' => $request->event_type_id,
            ]);
        }

        if ($request->department_id !== $event->department_id) {
            Event::query()->where( 'group_id', $event->group_id)->where('start_date', '>=', $event->start_date)->update([
                'department_id' => $request->department_id,
            ]);
        }
        $event->update($request->toArray());
        if ((int)$request->status_id === 2) {
            $event->update([
                'teacher_id' => 'not_set',
            ]);
        }
        $event->save();

        return response()->json([
            'status' => 'success',
            'data' => $event,
        ]);
    }

    public function updateClassroom(Request $request, string $id, string $classroomId): JsonResponse
    {
        $event = Event::find($id);
        if (null === $event) {
            throw new \App\Exceptions\EntityNotFoundException('Event');
        }

        $event->update([
            'classroom_id' => $classroomId,
        ]);
        $event->save();

        return new JsonResponse([
            'data' => $event,
        ], 201);
    }

    public function updateTeacher(Request $request, string $id, string $teacherId): JsonResponse
    {
        $event = Event::find($id);
        if (null === $event) {
            throw new \App\Exceptions\EntityNotFoundException('Event');
        }
        $event->update([
            'teacher_id' => $teacherId,
        ]);
        $event->save();

        return new JsonResponse([
            'data' => $event,
        ], 201);
    }
}
