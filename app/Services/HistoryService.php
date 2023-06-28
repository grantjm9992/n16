<?php

namespace App\Services;

use App\Models\Classroom;
use App\Models\EventChangeLog;
use App\Models\History;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;

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

    public static function insertEventLog(
        string $userId,
        string $eventId,
        string $name,
        string $originalTeacherId,
        string $newTeacherId,
        string $originalClassroomId,
        string $newClassroomId,
        string $originalStartDate,
        string $newStartDate
    ): void {
        $user = User::find($userId);
        if (null === $user) {
            return;
        }
        $originalTeacher = Teacher::find($originalTeacherId);
        $newTeacher = Teacher::find($newTeacherId);
        $originalClassroom = Classroom::find($originalClassroomId);
        $newClassroom = Classroom::find($newClassroomId);
        EventChangeLog::create([
            'user' => $user->name . ' ' . $user->surname,
            'event_id' => $eventId,
            'date_changed' => Carbon::now()->format('Y-m-d H:i:s'),
            'name' => $name,
            'original_teacher' => $originalTeacher?->name . ' ' .$originalTeacher?->surname,
            'new_teacher' => $newTeacher?->name . ' ' .$newTeacher?->surname,
            'original_classroom' => $originalClassroom?->name,
            'new_classroom' => $newClassroom?->name,
            'original_start_date' => $originalStartDate,
            'new_start_date' => $newStartDate,
        ]);
    }
}
