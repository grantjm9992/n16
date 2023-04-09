<?php

namespace App\Http\Controllers;

use App\Models\ResourceType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResourceTypeController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $eventTypes = ResourceType::query()->get();

        return new JsonResponse($eventTypes);
    }

    public function find(Request $request, string $id): JsonResponse
    {
        $eventType = ResourceType::find($id);

        return new JsonResponse($eventType);
    }

    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $eventType = ResourceType::create($request->toArray());

        return new JsonResponse($eventType);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $eventType = ResourceType::find($id);
        $eventType->update($request->toArray());
        $eventType->save();

        return new JsonResponse($eventType);
    }
}
