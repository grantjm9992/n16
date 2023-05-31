<?php

namespace App\Console\Commands;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;

class RepeatEventCycle extends Command
{
    protected $signature = 'db:repeat-events';

    public function handle()
    {
        $events = Event::query()
            ->where('start_date', '>=', '2023-05-29 00:00')
            ->where('end_date', '<=', '2023-06-04 23:59')
            ->get()
            ->all();

        foreach ($events as $event) {
            $dateLimit = new Carbon('2023-07-31 23:59');
            $startDate = new Carbon($event->start_date);
            $endDate = new Carbon($event->end_date);
            $startDate->addWeeks(2);
            $endDate->addWeeks(2);
            while ($dateLimit >= $startDate) {
                $_data = [
                    'company_id' => $event->company_id,
                    'description' => $event->description,
                    'classroom_id' => $event->classroom_id,
                    'event_type_id' => $event->event_type_id,
                    'group_id' => $event->group_id,
                    'department_id' => $event->department_id,
                    'status_id' => $event->status_id,
                    'teacher_id' => 'not_set',
                    'start_date' => $startDate->format('Y-m-d H:i'),
                    'end_date' => $endDate->format('Y-m-d H:i'),
                ];
                $event = Event::create($_data);
                $startDate->addWeek();
                $endDate->addWeek();
            }
        }
    }
}
