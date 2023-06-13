<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HistoryLogController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = History::query();

        if ($request->query->get('user_id')) {
            $query->where('user_id', $request->query->get('user_id'));
        }
        if ($request->query->get('q')) {
            $query->where('original_entity', 'LIKE', "%". $request->query->get('q'). "%");
        }

        $query->orderBy('created_at', 'DESC');
        return new JsonResponse(['data' => $query->limit(1000)->get()]);
    }
}
