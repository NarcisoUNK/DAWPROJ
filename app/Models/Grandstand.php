<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grandstand extends Model
{

    protected $table = 'grandstand';
    public $timestamps = false;

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class, 'race_id','race_id');
    }

    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class, 'seat_id','seat_id');
    }
}
