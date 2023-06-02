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
        // company_id, user_id, action, entity
        foreach ($request->query->all() as $key => $value) {
            $query->where($key, $value);
        }

        $query->orderBy('created_at', 'DESC');
        return new JsonResponse(['data' => $query->limit(1000)->get()]);
    }
}
