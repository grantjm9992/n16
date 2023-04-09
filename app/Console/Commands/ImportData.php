<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;

class ImportData extends Command
{
    protected $signature = 'db:import-data';

    public function handle(): void
    {
        $contents = file_get_contents(public_path().'/input.json');
        $decodedContents = json_decode($contents, true);
        foreach ($decodedContents as $row) {
            Event::create([
                'company_id' => 'company_id',
                'start_date' => $row['start'],
                'end_date' => $row['end'],
                'description' => $row['title'],
                'teacher_colour' => $row['color'],
                'event_type_colour' => $row['textColor'],
                'teacher_id' => $row['numIdProfesor'],
                'status_id' => $row['numIdStatus'],
                'group_id' => $row['groupId'],
                'classroom_id' => $row['resourceId'],
            ]);
        }
    }
}
