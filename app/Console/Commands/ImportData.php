<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\Event;
use App\Models\EventType;
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
                'company_id' => 'not_set',
                'start_date' => $row['start'],
                'end_date' => $row['end'],
                'description' => $row['title'],
                'name' => $row['title'],
                'teacher_colour' => $row['color'],
                'event_type_colour' => $row['textColor'],
                'teacher_id' => $row['numIdProfesor'],
                'status_id' => $row['numIdStatus'],
                'group_id' => $row['groupId'],
                'classroom_id' => $row['resourceId'],
            ]);
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

        $eventType = [
            ["id"=>1,"name"=>"Prueba de nivel"],
            ["id"=>2,"name"=>"Lectiva"],
            ["id"=>7,"name"=>"Drive"],
            ["id"=>8,"name"=>"Disp. Pas."],
            ["id"=>9,"name"=>"Kids walk"],
            ["id"=>10,"name"=>"Holiday"],
            ["id"=>11,"name"=>"Baja"],
            ["id"=>12,"name"=>"Training"]
        ];

        foreach ($companies as $company) {
            $initials = $array[$company['name']] ?? 'DOESNTEXIST';
            \DB::table('events')->where('description', 'LIKE', "$initials%")->where('company_id', 'not_set')->update([
                'company_id' => $company['id']
            ]);
        }

        $eventTypes = EventType::all()->toArray();

        \DB::update('UPDATE events SET teacher_id = (SELECT id FROM teachers WHERE CAST(teachers.old_id AS CHAR) = events.teacher_id)');
        \DB::update('UPDATE events SET classroom_id = (SELECT id FROM classrooms WHERE CAST(classrooms.old_id AS CHAR) = events.classroom_id)');
    }

}
