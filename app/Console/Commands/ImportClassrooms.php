<?php

namespace App\Console\Commands;

use App\Models\Classroom;
use Illuminate\Console\Command;

class ImportClassrooms extends Command
{
    protected $signature = 'db:import-classrooms';

    public function handle(): void
    {
        $contents = file_get_contents(public_path().'/classrooms.json');
        $decodedContents = json_decode($contents, true);
        foreach ($decodedContents as $row) {
            Classroom::create([
                'old_id' => $row['id'],
                'name' => $row['title'],
                'company_id' => 'company_id',
            ]);
        }
    }
}
