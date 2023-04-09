<?php

namespace App\Console\Commands;

use App\Models\Teacher;
use Illuminate\Console\Command;

class ImportTeachers extends Command
{
    protected $signature = 'db:import-teachers';

    public function handle(): void
    {
        $contents = file_get_contents(public_path().'/teachers.json');
        $decodedContents = json_decode($contents, true);
        foreach ($decodedContents as $row) {
            Teacher::create([
                'old_id' => $row['id'],
                'name' => $row['title'],
                'company_id' => 'company_id',
                'start_date' => '1900-01-01',
            ]);
        }
    }
}
