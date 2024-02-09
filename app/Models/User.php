<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property \Illuminate\Support\HigherOrderCollectionProxy|mixed $position_id
 * @property \Illuminate\Support\HigherOrderCollectionProxy|mixed $gender_id
 * @property \Illuminate\Support\HigherOrderCollectionProxy|mixed $date_of_birth
 * @property \Illuminate\Support\HigherOrderCollectionProxy|mixed $role_id
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
