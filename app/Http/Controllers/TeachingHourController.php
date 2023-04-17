<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
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
}
