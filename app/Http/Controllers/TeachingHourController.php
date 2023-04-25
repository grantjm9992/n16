<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Event;
use App\Models\Teacher;
use Carbon\Carbon;
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
            $teachers = Teacher::query();
            if ($user['user_role'] !== 'super_admin') {
                $teachers->where('company_id', $user['company_id']);
            }
            if ($request->query->get('company_id')) {
                $teachers->where('company_id', $request->query->get('company_id'));
            }
            $teachers = $teachers->get();
            $returnArray = [];
            foreach ($teachers as $teacher) {
                $events = Event::query()
                    ->where('start_date', '>=', Carbon::parse($request->start_date)->format('Y-m-d 00:00:00'))
                    ->where('end_date', '<=', Carbon::parse($request->end_date)->format('Y-m-d 23:59:59'))
                    ->where('teacher_id', $teacher->id)
                    ->get()->toArray();
                $_teacher = $teacher->toArray();
                $_teacher['time'] = round($this->getTotalTimeForEventArray($events)/3600, 2);
                $returnArray[] = $_teacher;
            }

            return response()->json($returnArray);
        }

        if ($request->group_by === 'department') {
            $departments = Department::all();
            $returnArray = [];
            foreach ($departments as $department) {
                $events = Event::query()
                    ->where('start_date', '>=', Carbon::parse($request->start_date)->format('Y-m-d 00:00:00'))
                    ->where('end_date', '<=', Carbon::parse($request->end_date)->format('Y-m-d 23:59:59'))
                    ->where('department_id', $department->id);

                if ($user['user_role'] !== 'super_admin') {
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

    private function getTotalTimeForEventArray(array $events): int
    {
        $time = 0;
        foreach ($events as $event) {
            $time += Carbon::parse($event['end_date'])->getTimestamp() - Carbon::parse($event['start_date'])->getTimestamp();
        }
        return $time;
    }
}
