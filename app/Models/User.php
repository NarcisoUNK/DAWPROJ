<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'user';
    protected $primaryKey = 'id_user'; // Set the primary key
    public $timestamps = false;

    protected $fillable = [
        'username',
        'email',
        'password',
        'permissions',
        'name',
    ];

    protected $hidden = [
        'password',
    ];

    public function races(): HasMany
    {
        return $this->hasMany(Race::class, 'id_user', 'id_user');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'id_user', 'id_user');
    }
}