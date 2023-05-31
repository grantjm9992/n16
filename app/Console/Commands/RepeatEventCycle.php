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
            $dateLimit = Carbon::createFromFormat('Y-m-d H:i', '2023-06-30 23:59');
            $startDate = Carbon::createFromFormat('Y-m-d H:i', $event->start_date)->addWeeks(2);
            $endDate = Carbon::createFromFormat('Y-m-d H:i', $event->end_date)->addWeeks(2);
            while ($dateLimit >= $startDate) {
                $data = $event->toArray();
                $data['id'] = Uuid::uuid4()->toString();
                $data['teacher_id'] = 'not_set';
                $data['start_date'] = $startDate->format('Y-m-d H:i');
                $data['end_date'] = $endDate->format('Y-m-d H:i');
                $event = Event::create($data);
                $startDate->addWeek();
                $endDate->addWeek();
            }
        }
    }
}
