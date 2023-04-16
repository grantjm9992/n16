<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Holiday;
use App\Models\Classroom;
use App\Models\Teacher;
use App\ValueObject\HolidayStatus;
use Carbon\CarbonPeriod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class HolidayController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $classrooms = Holiday::query()->with('teacher');
        $user = Auth::user()->toArray();

        if ($user['user_role'] !== 'super_admin') {
            $classrooms->where('company_id', $user['company_id']);
        }

        if ($request->query('company_id')) {
            $classrooms->where('company_id', $request->query('company_id'));
        }

        if ($user['user_role'] === 'teacher') {
            $classrooms->where('teacher_id', $user['id']);
        }

        return response()->json([
            'status' => 'success',
            'data' => $classrooms->get(),
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'start_date' => 'required|string',
            'end_date' => 'required|string',
            'notes' => 'string',
        ]);
        $user = Auth::user()->toArray();
        if ($user['user_role'] !== 'teacher') {
            throw new MethodNotAllowedException();
        }

        $holiday = Holiday::create($request->toArray());
        $holiday->teacher_id = $user['id'];
        $holiday->company_id = $user['company_id'];
        $holiday->status = HolidayStatus::PENDING;
        $holiday->save();

        return new JsonResponse([], 201);
    }

    public function accept(string $id): JsonResponse
    {
        $user = Auth::user()->toArray();
        if ($user['user_role'] === 'teacher') {
            throw new MethodNotAllowedException();
        }

        $holiday = Holiday::find($id);
        if ($holiday === null) {
            throw new NotFoundHttpException('');
        }

        $holiday->status = HolidayStatus::ACCEPTED;
        $holiday->save();

        $teacher = Teacher::find($holiday->teacher_id);

        $period = CarbonPeriod::create($holiday->start_date, $holiday->end_date);
        foreach ($period->toArray() as $date) {
            $startDate = $date->clone();
            $endDate = $date->clone();
            $startDate->setTimeFromTimeString('00:00');
            $minutes = $teacher->hours ? $teacher->hours * 10 : 31 * 10;
            $endDate->setTimeFromTimeString('00:00')->addMinutes($minutes);
            Event::create([
                'start_date' => $startDate,
                'end_date' => $endDate,
                'description' => 'holiday',
                'classroom_id' => 'not_set',
                'teacher_id' => $teacher->id,
                'event_type_id' => 'holiday',
                'status_id' => '1',
                'company_id' => $teacher->company_id,
                'holiday_id' => $holiday->id,
            ]);
        }

        return new JsonResponse([], 201);
    }

    public function reject(string $id): JsonResponse
    {
        $user = Auth::user()->toArray();
        if ($user['user_role'] === 'teacher') {
            throw new MethodNotAllowedException();
        }

        $holiday = Holiday::find($id);
        $holiday->status = HolidayStatus::REJECTED;
        $holiday->save();

        return new JsonResponse([], 201);
    }

    public function revoke(string $id): JsonResponse
    {
        $user = Auth::user()->toArray();
        if ($user['user_role'] === 'teacher') {
            throw new HttpException(403, 'Method not allowed for user');
        }

        $holiday = Holiday::find($id);
        $holiday->status = HolidayStatus::REJECTED;
        $holiday->save();

        Event::query()->where('holiday_id', $id)
            ->delete();

        return new JsonResponse([], 201);
    }
}
