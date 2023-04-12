<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\User;
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
        $classrooms = Teacher::query()->with('company');

        $user = Auth::user()->toArray();

        if ($user['user_role'] !== 'super_admin') {
            $classrooms->where('company_id', $user['company_id']);
        }

        return response()->json([
            'status' => 'success',
            'data' => $classrooms->get(),
        ]);
    }

    public function find(Request $request, string $id): JsonResponse
    {
        $classroom = Teacher::find($id);

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

        $user = User::query()->where('email', $request->email)->first();
        if ($user !== null) {
            throw new HttpException(400, 'Email in use');
        }

        $teacher = Teacher::create($request->toArray());

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
        ]);

        $classroom = Teacher::find($id);

        if (null === $classroom) {
            throw new EntityNotFoundException();
        }

        $classroom->update($request->toArray());
        $classroom->save();

        return response()->json([
            'status' => 'success',
            'data' => $classroom,
        ]);
    }
}
