<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\History;
use Illuminate\Console\Command;

class UpdateFromLogs extends Command
{
    protected $signature = 'db:update-events-from-logs';
    public function handle(): void
    {
        $logs = History::query()
            ->where('entity', Event::class)
            ->where('created_at', '>=', '2023-05-30 10:00:00')
            ->get()
            ->all();

        foreach ($logs as $log) {
            if ($log->action === 'update') {
                $updatedEntity = $log->original_entity;
                /** @var Event $event */
                $event = Event::find($updatedEntity['id']);
                if ($event) {
                    $event->setAttribute('department_id', $updatedEntity['department_id']);
                    $event->setAttribute('event_type_id', $updatedEntity['event_type_id']);
                    $event->setAttribute('teacher_id', $updatedEntity['teacher_id']);
                }
            }
        }
    }
}
