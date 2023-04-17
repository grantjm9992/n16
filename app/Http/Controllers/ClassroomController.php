<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Contracts\Queue\EntityNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $classrooms = Classroom::query()->with('company')->orderBy('name', 'ASC');
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
        $classroom = Classroom::find($id);

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
