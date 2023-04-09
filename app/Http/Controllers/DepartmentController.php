<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Event;
use Doctrine\DBAL\Exception\ConstraintViolationException;
use Illuminate\Contracts\Queue\EntityNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $eventTypes = Department::query()->get();

        return response()->json([
            'status' => 'success',
            'data' => $eventTypes,
        ]);
    }

    public function find(Request $request, string $id): JsonResponse
    {
        $eventType = Department::find($id);

        return response()->json([
            'status' => 'success',
            'data' => $eventType,
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $eventType = Department::create($request->toArray());

        return response()->json([
            'status' => 'success',
            'data' => $eventType,
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $eventType = Department::find($id);
        $eventType->update($request->toArray());
        $eventType->save();

        return response()->json([
            'status' => 'success',
            'data' => $eventType,
        ]);
    }

    public function delete(string $id): JsonResponse
    {
        $department = Department::find($id);
        if ($department === null) {
            throw new EntityNotFoundException(Department::class, $id);
        }

        $events = Event::query()->where('department_id', $department->id)
            ->count();
        if ($events > 0) {
            throw new \HttpException();
        }

        $department->delete();
        return new JsonResponse([], 201);
    }
}
