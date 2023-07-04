<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeachingHourController extends Controller
{
    public function index(): JsonResponse
    {
        $teachers = Teacher::with(['events' => function ($query) {
            $query->where('events.start_date', '>=', 'teachers.start_date')
                ->where('start_date', '<=', Carbon::now()->format('Y-m-d 00:00:00'));
        }])->get();

        foreach ($teachers as $teacher) {
            $accumulatedHours = 0;
            foreach ($teacher->events as $event) {
                $durationInHours = round(
                    Carbon::createFromFormat('Y-m-d H:i:s', $event->end_date)->getTimestamp() /
                    (Carbon::createFromFormat('Y-m-d H:i:s', $event->start_date)->getTimestamp() * 3600), 2
                );
                $accumulatedHours += $durationInHours;
            }
            $teacher->accumulatedHours = $accumulatedHours;
        }
        foreach ($teachers as $teacher) {
            $totalDays = max(Carbon::now()->diffInDays($teacher->start_date), 1);
            $daysWorked = ceil((6 * $totalDays) / 7);
            $hoursPerDay = $teacher->hours / 6;
            $timeBalance = $teacher->accumulatedHours - ($daysWorked * $hoursPerDay);
            $teacher->time_balance = $timeBalance;
        }

        return response()->json(['data' => $teachers]);
    }

    public function data(Request $request): JsonResponse
    {
        $request->validate([
            'start_date' => 'required|string',
            'end_date' => 'required|string',
            'group_by' => 'required|string',
        ]);
        $user = Auth::user()->toArray();

        if ($request->group_by === 'teacher') {
            return response()->json($this->byTeacher($request, $user));
        }

        if ($request->group_by === 'teacher_and_event_type') {
            return response()->json($this->byTeacherAndEventType($request, $user));
        }

        if ($request->group_by === 'teacher_and_department') {
            return response()->json($this->byTeacherAndDepartment($request, $user));
        }

        if ($request->group_by === 'department') {
            $departments = Department::all();
            $returnArray = [];
            foreach ($departments as $department) {
                $events = Event::query()
                    ->where('start_date', '>=', Carbon::parse($request->start_date)->format('Y-m-d 00:00:00'))
                    ->where('end_date', '<=', Carbon::parse($request->end_date)->format('Y-m-d 23:59:59'))
                    ->where('department_id', $department->id);

                if (!in_array($user['user_role'], ['super_admin', 'admin'])) {
                    $events->where('company_id', $user['company_id']);
                }

                if ($request->query->get('company_id')) {
                    $events->where('company_id', $request->query->get('company_id'));
                }
                $events = $events->get()->toArray();
                $_teacher = $department->toArray();
                $_teacher['time'] = round($this->getTotalTimeForEventArray($events)/3600, 2);
                $returnArray[] = $_teacher;
            }

            return response()->json($returnArray);
        }

        return response()->json([]);
    }

    private function getTeachers($request, $user): Collection|array
    {
        $teachers = Teacher::query();
        if (!in_array($user['user_role'], ['super_admin', 'admin'])) {
            $teachers->whereRaw(
                '(company_id = :company_id OR company_id = "not_set")',
                ['company_id' => $user['company_id']]
            );
        }
        if ($request->query->get('company_id')) {
            $teachers->whereRaw(
                '(company_id = :company_id OR company_id = "not_set")',
                ['company_id' => $request->query->get('company_id')]
            );
        }
        return $teachers->get();
    }

    private function byTeacher(Request $request, $user): array
    {
        $query = Event::query()
            ->select('events.start_date', 'events.end_date', 'events.teacher_id', 'teachers.name', 'teachers.surname')
            ->where('events.start_date', '>=', Carbon::parse($request->start_date)->format('Y-m-d 00:00:00'))
            ->where('events.end_date', '<=', Carbon::parse($request->end_date)->format('Y-m-d 23:59:59'))
            ->leftJoin('teachers', 'teachers.id', '=', 'events.teacher_id');
        if ($request->query->get('company_id')) {
            $query->whereRaw(
                '(teachers.company_id = ? OR teachers.company_id = "not_set")',
                [$request->query->get('company_id')]
            );
        }
        $returnArray = [];
        $events = $query->get()->toArray();
        $toggleArray = [];
        foreach ($events as $event) {
            $key = $event['teacher_id'];
            if (array_key_exists($key, $toggleArray)) {
                $toggleArray[$key]['time'] += round($this->getTotalTimeForEventArray([$event])/3600, 2);
            } else {
                $toggleArray[$key] = [
                    'name' => $event['name'],
                    'surname' => $event['surname'],
                    'time' => round($this->getTotalTimeForEventArray([$event])/3600, 2),
                ];
            }
        }

        return $returnArray;
    }

    private function byTeacherAndDepartment(Request $request, $user): array
    {
        $query = Event::query()
            ->select('events.start_date', 'events.end_date', 'events.teacher_id', 'events.department_id', 'teachers.name', 'teachers.surname', 'departments.name AS department')
            ->where('events.start_date', '>=', Carbon::parse($request->start_date)->format('Y-m-d 00:00:00'))
            ->where('events.end_date', '<=', Carbon::parse($request->end_date)->format('Y-m-d 23:59:59'))
            ->leftJoin('departments', 'departments.id', '=', 'events.department_id')
            ->leftJoin('teachers', 'teachers.id', '=', 'events.teacher_id');

        if ($request->query->get('company_id')) {
            $query->whereRaw(
                '(teachers.company_id = ? OR teachers.company_id = "not_set")',
                [$request->query->get('company_id')]
            );
        }
        $events = $query->get()->toArray();
        $returnArray = [];
        $toggleArray = [];
        foreach ($events as $event) {
            $key = $event['teacher_id'].'-'.$event['department_id'];
            if (array_key_exists($key, $toggleArray)) {
                $toggleArray[$key]['time'] += round($this->getTotalTimeForEventArray([$event])/3600, 2);
            } else {
                $toggleArray[$key] = [
                    'name' => $event['name'],
                    'surname' => $event['surname'],
                    'department' => $event['department'],
                    'time' => round($this->getTotalTimeForEventArray([$event])/3600, 2),
                ];
            }
        }

        foreach ($toggleArray as $key => $value) {
            $returnArray[] = $value;
        }
        return $returnArray;
    }

    private function byTeacherAndEventType($request, $user): array
    {
        $query = Event::query()
            ->select('events.start_date', 'events.end_date', 'events.teacher_id', 'events.event_type_id', 'teachers.name', 'teachers.surname', 'event_types.name AS event_type')
            ->where('start_date', '>=', Carbon::parse($request->start_date)->format('Y-m-d 00:00:00'))
            ->where('end_date', '<=', Carbon::parse($request->end_date)->format('Y-m-d 23:59:59'))
            ->leftJoin('event_types', 'event_types.id', '=', 'events.event_type_id')
            ->leftJoin('teachers', 'teachers.id', '=', 'events.teacher_id');

        if ($request->query->get('company_id')) {
            $query->whereRaw(
                '(teachers.company_id = ? OR teachers.company_id = "not_set")',
                [$request->query->get('company_id')]
            );
        }

        $events = $query->get()->toArray();
        $returnArray = [];
        $toggleArray = [];
        foreach ($events as $event) {
            $key = $event['teacher_id'].'-'.$event['event_type_id'];
            if (array_key_exists($key, $toggleArray)) {
                $toggleArray[$key]['time'] += round($this->getTotalTimeForEventArray([$event])/3600, 2);
            } else {
                $toggleArray[$key] = [
                    'name' => $event['name'],
                    'surname' => $event['surname'],
                    'event_type' => $event['event_type'],
                    'time' => round($this->getTotalTimeForEventArray([$event])/3600, 2),
                ];
            }
        }

        foreach ($toggleArray as $key => $value) {
            $returnArray[] = $value;
        }

        return $returnArray;
    }

    private function getTotalTimeForEventArray(array $events): int
    {
        $time = 0;
        foreach ($events as $event) {
            $time += Carbon::parse($event['end_date'])->getTimestamp() - Carbon::parse($event['start_date'])->getTimestamp();
        }
        return $time;
    }
}
