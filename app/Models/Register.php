<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static findOrFail(int $id)
 */
class Register extends Model
{
    use HasFactory,SoftDeletes;

    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }

    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
