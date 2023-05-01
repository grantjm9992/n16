<?php

namespace App\Http\Controllers;

use App\Exceptions\CannotDeleteEntityWithEventsException;
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
        $eventTypes = Department::query()->orderBy('name', 'ASC')->get();

        return response()->json([
            'status' => 'success',
            'data' => $eventTypes,
        ]);
    }

    public function find(Request $request, string $id): JsonResponse
    {
        $eventType = Department::find($id);

        if (null === $eventType) {
            throw new \App\Exceptions\EntityNotFoundException('Department');
        }

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
        if (null === $eventType) {
            throw new \App\Exceptions\EntityNotFoundException('Department');
        }
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
        if (null === $department) {
            throw new \App\Exceptions\EntityNotFoundException('Department');
        }

        $events = Event::query()->where('department_id', $department->id)
            ->count();
        if ($events > 0) {
            throw new CannotDeleteEntityWithEventsException('Department');
        }

        $department->delete();
        return new JsonResponse([], 201);
    }
}
