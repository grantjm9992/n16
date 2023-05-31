<?php

namespace App\Console\Commands;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;

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
            $dateLimit = Carbon::createFromFormat('Y-m-d H:i', '2023-06-30 23:59');
            $startDate = Carbon::createFromFormat('Y-m-d H:i', $event->start_date)->addWeeks(2);
            $endDate = Carbon::createFromFormat('Y-m-d H:i', $event->end_date)->addWeeks(2);
            while ($dateLimit >= $startDate) {
                $event = Event::create($event->toArray());
                $event->update([
                    'teacher_id' => 'not_set',
                    'start_date' => $startDate->format('Y-m-d H:i'),
                    'end_date' => $endDate->format('Y-m-d H:i'),
                ]);
                $event->save();
                $startDate->addWeek();
                $endDate->addWeek();
            }
        }
    }
}
