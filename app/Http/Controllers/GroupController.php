<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Ramsey\Uuid\Uuid;

class GroupController extends Controller
{
    public function __construct(
    ) {
    }

    public function index(): JsonResponse
    {
        return new JsonResponse([
            'data' => [
                [
                    'id' => Uuid::uuid4()->toString(),
                    'name' => 'Test group',
                ]
            ],
            'status' => 'success',
        ]);
    }
}
