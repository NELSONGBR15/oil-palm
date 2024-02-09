<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genders = [
            [
                'name' => 'Masculino',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Femenino',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Otro',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        Gender::insert($genders);
    }
}
