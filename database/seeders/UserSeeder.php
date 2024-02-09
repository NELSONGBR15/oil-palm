<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Administrador',
                'email' => 'admin@mail.com',
                'date_of_birth' => '1990-01-01',
                'gender_id' => 1,
                'position_id' => 1,
                'role_id' => 1,
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
            ]
        ];

        User::insert($users);

        $users = User::all();

        $users->each(function ($user) {
            $user->assignRole($user->role->name);
        });
    }
}
