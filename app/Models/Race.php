<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Race extends Model
{

    protected $table = 'race';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'race_name',
        'year',
        'country',
        'city',
        'image',
        'circuit'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id','user_id');
    }

    public function grandstands(): HasMany
    {
        return $this->hasMany(Grandstand::class, 'grandstand_id','grandstand_id');
    }
}
