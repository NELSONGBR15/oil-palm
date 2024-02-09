<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::crudPermissions('users');
        Permission::crudPermissions('positions');
        Permission::crudPermissions('roles');
        Permission::crudPermissions('farms');
        Permission::crudPermissions('lots');
        Permission::crudPermissions('varieties');
        Permission::crudPermissions('diseases');
        Permission::crudPermissions('registers');
    }
}
