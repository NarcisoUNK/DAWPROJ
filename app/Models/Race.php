<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Race extends Model
{
    protected $table = 'race';
    protected $primaryKey = 'id_race'; // Set the primary key
    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function grandstands(): HasMany
    {
        return $this->hasMany(Grandstand::class, 'id_race', 'id_race');
    }
}