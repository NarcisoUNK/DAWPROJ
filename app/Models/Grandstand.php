<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grandstand extends Model
{

    protected $table = 'grandstand';
    public $timestamps = false;

    protected $fillable = [
        'id_race',
        'name',
    ];

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class, 'id_race','id_race');
    }

    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class, 'id_grandstand','id_grandstand')->with('race');
    }
}
