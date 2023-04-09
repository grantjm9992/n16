<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class CompaniesSeeder extends Seeder
{
    public function run()
    {
        foreach (self::insertData() as $row) {
            DB::table('companies')->insert($row);
        }
    }

    private static function insertData(): array
    {
        return [[
            'id' => Uuid::uuid4()->toString(),
            'name' => 'San Miguel',
            'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTime())->format('Y-m-d H:i:s'),
        ], [
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Gomez Laguna',
            'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTime())->format('Y-m-d H:i:s'),
        ], [
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Alonso Martinez',
            'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTime())->format('Y-m-d H:i:s'),
        ], [
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Arguelles',
            'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTime())->format('Y-m-d H:i:s'),
        ], [
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Nuevos Ministerios',
            'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTime())->format('Y-m-d H:i:s'),
        ], [
            'id' => Uuid::uuid4()->toString(),
            'name' => 'La Paz',
            'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTime())->format('Y-m-d H:i:s'),
        ], [
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Ercilla',
            'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTime())->format('Y-m-d H:i:s'),
        ], [
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Rambla Catalunya',
            'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTime())->format('Y-m-d H:i:s'),
        ], [
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Number 16 plus/Online',
            'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTime())->format('Y-m-d H:i:s'),
        ]];
    }
}
