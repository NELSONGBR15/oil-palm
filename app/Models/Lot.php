<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static findOrFail(int $id)
 * @property mixed $name
 * @property mixed $year_of_planting
 * @property mixed $variety_id
 * @property mixed $farm_id
 */
class Lot extends Model
{
    use HasFactory, SoftDeletes;

    public function variety()
    {
        return $this->belongsTo(Variety::class);
    }

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
}
