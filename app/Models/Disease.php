<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static findOrFail($id)
 * @property mixed|string $name
 */
class Disease extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
}
