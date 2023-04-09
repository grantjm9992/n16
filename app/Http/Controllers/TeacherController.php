<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Contracts\Queue\EntityNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $classrooms = Teacher::query()->with('company')->get();

        return response()->json([
            'status' => 'success',
            'data' => $classrooms,
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

        $classroom = Teacher::create($request->toArray());

        return response()->json([
            'status' => 'success',
            'data' => $classroom,
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
