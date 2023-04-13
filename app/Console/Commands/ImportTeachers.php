<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ImportTeachers extends Command
{
    protected $signature = 'db:import-teachers';

    public function handle(): void
    {
        Teacher::query()->delete();
        User::query()->where('user_role', 'teacher')->delete();
        $contents = file_get_contents(public_path().'/teachers.json');
        $decodedContents = json_decode($contents, true);
        foreach ($decodedContents as $row) {
            $teacher = Teacher::create([
                'old_id' => (int)$row['numIdUsuario'],
                'name' => $row['strNombre'],
                'surname' => $row['strApellidos'],
                'email' => $row['strUsuario'],
                'hours' => $row['numContrato'],
                'start_hours' => $row['numHoras'],
                'text_colour' => $row['strColorTexto'],
                'colour' => $row['strColorProfesor'],
                'company_id' => 'not_set',
                'start_date' => '1900-01-01',
            ]);

            $user = $teacher->toArray();
            $user['password'] = Hash::make($row['strPassword']);
            $user['user_role'] = 'teacher';
            User::create($user);
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
            \DB::table('teachers')->where('name', 'LIKE', "$initials%")->where('company_id', 'not_set')->update([
                'company_id' => $company['id']
            ]);
            \DB::table('users')->where('name', 'LIKE', "$initials%")->where('company_id', 'not_set')->update([
                'company_id' => $company['id']
            ]);
        }
    }
}
