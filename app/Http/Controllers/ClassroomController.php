<?php

namespace App\Http\Controllers;

use App\Exceptions\ClassroomNotFoundException;
use App\Models\Classroom;
use Illuminate\Contracts\Queue\EntityNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $classrooms = Classroom::query()->with('company')->orderBy('order', 'ASC');
        $user = Auth::user()->toArray();
/*
        if (!in_array($user['user_role'], ['super_admin', 'admin'])) {
            $classrooms->where('company_id', $user['company_id']);
        }
*/
        return response()->json([
            'status' => 'success',
            'data' => $classrooms->get(),
        ]);
    }

    public function find(Request $request, string $id): JsonResponse
    {
        $classroom = Classroom::find($id);

        if (null === $classroom) {
            throw new ClassroomNotFoundException();
        }

        return response()->json([
            'status' => 'success',
            'data' => $classroom,
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_id' => 'required|string|max:255',
            'order' => 'integer',
        ]);

        $classroom = Classroom::create($request->toArray());

        return response()->json([
            'status' => 'success',
            'data' => $classroom,
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_id' => 'required|string|max:255',
            'text_colour' => 'string',
            'fill_colour' => 'string',
            'order' => 'integer',
        ]);

        $classroom = Classroom::find($id);

        if (null === $classroom) {
            throw new ClassroomNotFoundException();
        }

        $classroom->update($request->toArray());
        $classroom->save();

        return response()->json([
            'status' => 'success',
            'data' => $classroom,
        ]);
    }
}
