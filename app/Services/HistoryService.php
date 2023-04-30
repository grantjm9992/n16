<?php

namespace App\Services;

use App\Models\History;
use App\Models\User;

class HistoryService
{
    public static function insertAction(
        string $userId,
        string $action,
        string $entityName,
        array $originalEntity,
        array $updatedEntity
    ): void {
        $user = User::find($userId);
        if (null === $user) {
            return;
        }
        History::create([
            'user_id' => $userId,
            'company_id' => $user['company_id'],
            'user' => $user->name . ' ' . $user->surname,
            'action' => $action,
            'entity' => $entityName,
            'original_entity' => $originalEntity,
            'updated_entity' => $updatedEntity,
        ]);
    }
}
