<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            [
                'name' => 'Recolector',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cultivador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Position::insert($positions);
    }
}
