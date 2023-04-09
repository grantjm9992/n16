<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $eventTypes = Resource::query()->get();

        return new JsonResponse($eventTypes);
    }

    public function find(Request $request, string $id): JsonResponse
    {
        $eventType = Resource::find($id);

        return new JsonResponse($eventType);
    }

    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'resource_type_id' => 'required|string|max:36',
            'notes' => 'required|string|max:255',
            'active' => 'boolean',
        ]);

        $eventType = Resource::create($request->toArray());

        return new JsonResponse($eventType);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'resource_type_id' => 'required|string|max:36',
            'notes' => 'required|string|max:255',
            'active' => 'boolean',
        ]);

        $eventType = Resource::find($id);
        $eventType->update($request->toArray());
        $eventType->save();

        return new JsonResponse($eventType);
    }
}
