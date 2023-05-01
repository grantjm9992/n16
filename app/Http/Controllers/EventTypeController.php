<?php

namespace App\Http\Controllers;

use App\Exceptions\CannotDeleteEntityWithEventsException;
use App\Models\Event;
use App\Models\EventType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class EventTypeController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $eventTypes = EventType::query()->get();

        return response()->json([
            'status' => 'success',
            'data' => $eventTypes,
        ]);
    }

    public function find(Request $request, string $id): JsonResponse
    {
        $eventType = EventType::find($id);
        if (null === $eventType) {
            throw new \App\Exceptions\EntityNotFoundException('Event type');
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
            'colour' => 'string|max:255',
            'text_colour' => 'string|max:255',
        ]);

        $eventType = EventType::create($request->toArray());

        return response()->json([
            'status' => 'success',
            'data' => $eventType,
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'colour' => 'string|max:255',
            'text_colour' => 'string|max:255',
        ]);

        $eventType = EventType::find($id);
        if (null === $eventType) {
            throw new \App\Exceptions\EntityNotFoundException('Event type');
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
        $events = Event::query()->where('event_type_id', $id)->get();
        if ($events > 0) {
            throw new CannotDeleteEntityWithEventsException('Event type');
        }

        $eventType = EventType::find($id);
        if (null === $eventType) {
            throw new \App\Exceptions\EntityNotFoundException('Event type');
        }
        $eventType->delete();

        return response()->json([
            'status' => 'success',
            'data' => [],
        ]);
    }
}
