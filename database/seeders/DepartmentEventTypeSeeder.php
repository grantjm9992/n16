<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Nonstandard\Uuid;

class DepartmentEventTypeSeeder extends Seeder
{
    public function run()
    {
        foreach (self::departmentSeedData() as $row) {
            DB::table('departments')->insert($row);
        }
        foreach (self::eventTypeSeedData() as $row) {
            DB::table('event_types')->insert([
                'name' => $row,
                'id' => Uuid::uuid4()->toString(),
            ]);
        }
    }

    private static function eventTypeSeedData(): array
    {
        return [
            'Prueba de nivel',
            'Lectiva',
            'Prep',
            'Drive',
            'Disp. Pas.',
            'Kids walk',
            'Holiday',
            'Baja/Sick',
            'Training/Meeting',
        ];
    }

    private static function departmentSeedData(): array
    {
        return [[
            'name' => 'General English',
            'id' => Uuid::uuid4()->toString(),
        ],[
            'name' => 'Exams',
            'id' => Uuid::uuid4()->toString(),
        ],[
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Kids',
        ],[
            'id' => Uuid::uuid4()->toString(),
            'name' => 'In-company',
        ],];
    }

}
