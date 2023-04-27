<?php

namespace App\Console\Commands;

use App\Models\Classroom;
use App\Models\Company;
use Illuminate\Console\Command;

class ImportClassrooms extends Command
{
    protected $signature = 'db:import-classrooms';

    public function handle(): void
    {
        $contents = file_get_contents(public_path().'/classrooms.json');
        $decodedContents = json_decode($contents, true);
        $i = 1;
        foreach ($decodedContents as $row) {
            Classroom::create([
                'old_id' => $row['id'],
                'name' => $row['title'],
                'company_id' => 'not_set',
                'order' => $i,
            ]);
            $i++;
        }
        $companies = Company::all()->toArray();
        $this->updateCompanyIds($companies);
    }

    private function updateCompanyIds(array $companies): void
    {
        $array = [
            'San Miguel' => 'SM',
            'Gomez Laguna' => 'GL',
            'Alonso Martinez' => 'AM',
            'Arguelles' => 'AR',
            'Nuevos Ministerios' => 'NM',
            'La Paz' => 'LP',
            'Ercilla' => 'ER',
            'Rambla Catalunya' => 'RC',
            'Number 16 plus/Online' => 'OL',
        ];

        foreach ($companies as $company) {
            $initials = $array[$company['name']] ?? 'DOESNTEXIST';
            \DB::table('classrooms')->where('name', 'LIKE', "$initials%")->where('company_id', 'not_set')->update([
                'company_id' => $company['id']
            ]);
        }
    }
}
