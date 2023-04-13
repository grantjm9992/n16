<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Event;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\Queue\EntityNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $events = Event::query();
        $user = Auth::user()->toArray();

        if ($user['user_role'] !== 'super_admin') {
            $events->where('company_id', $user['company_id']);
        }

        if ($user['user_role'] === 'teacher') {
            $events->where('teacher_id', $user['id']);
        }

        if ($request->query->get('date')) {
            $date = new \DateTime($request->query->get('date'));
            $events->where('start_date', 'LIKE', $date->format('Y-m-d')."%");
        } else {
            $date = new \DateTime();
            $events->where('start_date', 'LIKE', $date->format('Y-m-d')."%");
        }

        $events->orderBy('created_at', 'DESC');

        $eventArray = $events->get();

        if ($request->query->get('by_teacher')) {
            $eventArray = [];
            foreach ($events->get()->toArray() as $event) {
                $event['resourceId'] = $event['teacher_id'] ?? null;
                $eventArray[] = $event;
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

        return response()->json([
            'status' => 'success',
            'data' => $event,
        ]);
    }

    public function createRepeatedForDateRange(Request $request): JsonResponse
    {
        $user = Auth::user()->toArray();
        $request->validate([
            'name' => 'string|max:255',
            'classroom_id' => 'string|max:255',
            'teacher_id' => 'string|max:255',
            'event_type_id' => 'required|string|max:255',
            'group_id' => 'string|max:255',
            'user_id' => 'string|max:255',
            'department_id' => 'string|max:255',
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
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'description' => $request->name,
                    'classroom_id' => $request->classroom_id,
                    'teacher_id' => $request->teacher_id,
                    'event_type_id' => $request->event_type_id,
                    'group_id' => $request->group_id,
                    'user_id' => $request->user_id,
                    'department_id' => $request->department_id,
                    'status_id' => $request->status_id,
                    'company_id' => $user['company_id'],
                ]);
            }
        }

        return new JsonResponse([], 201);
    }

    public function createSingleEvent(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'string|max:255',
            'description' => 'string|max:255',
            'classroom_id' => 'string|max:255',
            'teacher_id' => 'string|max:255',
            'event_type_id' => 'required|string|max:255',
            'group_id' => 'string|max:255',
            'user_id' => 'string|max:255',
            'department_id' => 'string|max:255',
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
            'classroom_id' => 'string|max:255',
            'teacher_id' => 'string|max:255',
            'event_type_id' => 'required|string|max:255',
            'group_id' => 'string|max:255',
            'user_id' => 'string|max:255',
            'department_id' => 'string|max:255',
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

    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'classroom_id' => 'required|string|max:255',
            'teacher_id' => 'required|string|max:255',
            'event_type_id' => 'required|string|max:255',
            'group_id' => 'required|string|max:255',
            'user_id' => 'required|string|max:255',
            'department_id' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'required|string|max:255',
            'status_id' => 'required|string|max:255',
        ]);

        $event = Event::find($id);

        if (null === $event) {
            throw new EntityNotFoundException();
        }

        $event->update($request->toArray());
        $event->save();

        return response()->json([
            'status' => 'success',
            'data' => $event,
        ]);
    }

    public function updateClassroom(Request $request, string $id, string $classroomId): JsonResponse
    {
        $event = Event::find($id);
        if ($event->group_id !== null) {
            Event::query()->where( 'group_id', $event->group_id)->where('start_date', '>=', $event->start_date)->update([
                'classroom_id' => $classroomId,
            ]);
        }

        if ($event->group_id === null) {
            $event->update([
                'classroom_id' => $classroomId,
            ]);
            $event->save();
        }

        return new JsonResponse([
            'data' => $event,
        ], 201);
    }

    public function updateTeacher(Request $request, string $id, string $teacherId): JsonResponse
    {
        $event = Event::find($id);
        $event->update([
            'teacher_id' => $teacherId,
        ]);
        $event->save();

        return new JsonResponse([
            'data' => $event,
        ], 201);
    }
}
