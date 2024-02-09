<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static findOrFail(int $id)
 */
class Variety extends Model
{
    use HasFactory, SoftDeletes;

    public function lots()
    {
        return $this->hasMany(Lot::class);
    }
}
