<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
{
    use HasFactory;

    protected $fillable = ['name', 'guard_name', 'table_name'];

    public static function crudPermissions($name)
    {
        self::upsert([
            ['name' => 'view ' . $name, 'guard_name' => 'web', 'table_name' => $name],
            ['name' => 'create ' . $name, 'guard_name' => 'web', 'table_name' => $name],
            ['name' => 'update ' . $name, 'guard_name' => 'web', 'table_name' => $name],
            ['name' => 'delete ' . $name, 'guard_name' => 'web', 'table_name' => $name],
        ], ['name'], ['guard_name'
        ]);
    }
}
