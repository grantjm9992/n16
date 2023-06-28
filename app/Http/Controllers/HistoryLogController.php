<?php

namespace App\Http\Controllers;

use App\Models\EventChangeLog;
use App\Models\History;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

    public function event(Request $request): JsonResponse
    {
        $query = EventChangeLog::query();

        if ($request->query->get('name')) {
            $query->where('name', 'LIKE', '%'.$request->query->get('name').'%');
        }

        if ($request->query->get('teacher')) {
            $query->where(function (Builder $query) use ($request) {
                $query->where('new_teacher', 'LIKE', '%'.$request->query->get('teacher').'%')
                    ->orWhere('original_teacher', 'LIKE', '%'.$request->query->get('teacher').'%');
            });
        }

        if ($request->query->get('user')) {
            $query->where('user', 'LIKE', '%'.$request->query->get('user').'%');
        }

        if ($request->query->get('date')) {
            $query->where(
                'original_start_date',
                '>=',
                Carbon::parse(
                    $request->query->get('date')
                )->format('Y-m-d 00:00')
            )->where(
                'original_start_date',
                '<=',
                Carbon::parse(
                    $request->query->get('date')
                )->format('Y-m-d 23:59')
            );
        }

        $query->orderBy('created_at', 'DESC');
        return new JsonResponse(['data' => $query->limit(1000)->get()]);
    }
}
