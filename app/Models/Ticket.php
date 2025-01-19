<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model
{
    protected $table = 'ticket';
    public $timestamps = false;

    protected $fillable = [
        'id_seat',
        'id_user',
        'final_price'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id','user_id');
    }

    public function seat(): HasOne
    {
        return $this->HasOne(Seat::class, 'seat_id','seat_id');
    }
}
