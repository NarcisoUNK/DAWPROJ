<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Seat extends Model
{
    protected $table = 'seat';
    public $timestamps = false;

    protected $fillable = [
        'id_grandstand',
        'n_seat_grandstand',
        'price'
    ];

    public function grandstand(): BelongsTo
    {
        return $this->belongsTo(Grandstand::class, 'id_grandstand','id_grandstand')->with('race');
    }

    public function ticket(): HasOne
    {
        return $this->HasOne(Ticket::class, 'id_seat','id_seat');
    }
}
