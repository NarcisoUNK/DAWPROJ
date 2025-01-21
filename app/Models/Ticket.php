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
        return $this->belongsTo(User::class, 'id_user','id_user');
    }

    public function seat(): HasOne
    {
        return $this->HasOne(Seat::class, 'id_seat','id_seat')->with('grandstand');
    }
}
