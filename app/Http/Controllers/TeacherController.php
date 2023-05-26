<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\EntityNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TeacherController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $classrooms = Teacher::query()
            ->whereRaw('(leave_date IS NULL OR leave_date >= "' . Carbon::now()->format('Y-m-d'). '") ')
            ->orderBy('name', 'ASC')
            ->orderBy('surname', 'ASC')
            ->with('company');

        $user = Auth::user()->toArray();

        if (!in_array($user['user_role'], ['super_admin', 'admin'])) {
            $classrooms->where('company_id', $user['company_id']);
        }

        if ($request->query->get('company_id')) {
            $classrooms->where('company_id', $request->query->get('company_id'));
        }

        return response()->json([
            'status' => 'success',
            'data' => $classrooms->get(),
        ]);
    }

    public function find(Request $request, string $id): JsonResponse
    {
        $classroom = Teacher::find($id);
        if (null === $classroom) {
            throw new \App\Exceptions\EntityNotFoundException('Teacher');
        }

        return response()->json([
            'status' => 'success',
            'data' => $classroom,
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string',
            'company_id' => 'required|string',
            'text_colour' => 'string',
            'colour' => 'string',
        ]);

        $requestData = $request->toArray();
        if (array_key_exists('hours', $requestData)) {
            $requestData['hours'] = strval($requestData['hours']);
        }
        if (array_key_exists('start_hours', $requestData)) {
            $requestData['start_hours'] = strval($requestData['start_hours']);
        }

        $user = User::query()->where('email', $request->email)->first();
        if ($user !== null) {
            throw new HttpException(400, 'Email in use');
        }

        $teacher = Teacher::create($requestData);

        $user = $teacher->toArray();
        $user['user_role'] = 'teacher';
        $user['password'] = Hash::make('defaultPassword');
        User::create($user);

        return response()->json([
            'status' => 'success',
            'data' => $teacher,
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string',
            'company_id' => 'required|string',
            'text_colour' => 'string',
            'colour' => 'string',
            'hours' => 'numeric|nullable',
            'start_date' => 'string|nullable',
        ]);

        $classroom = Teacher::find($id);

        if (null === $classroom) {
            throw new \App\Exceptions\EntityNotFoundException('Teacher');
        }

        $requestData = $request->toArray();
        if (array_key_exists('hours', $requestData)) {
            $requestData['hours'] = strval($requestData['hours']);
        }
        if (array_key_exists('start_hours', $requestData)) {
            $requestData['start_hours'] = strval($requestData['start_hours']);
        }
        $classroom->update($requestData);
        $classroom->save();

        return response()->json([
            'status' => 'success',
            'data' => $classroom,
        ]);
    }

    public function delete(Request $request, string $id): JsonResponse
    {
        $teacher = Teacher::find($id);
        if (null === $teacher) {
            throw new \App\Exceptions\EntityNotFoundException('Teacher');
        }
        $teacher->delete();

        $user = User::find($id);
        if (null === $user) {
            throw new \App\Exceptions\EntityNotFoundException('User');
        }
        $user->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
