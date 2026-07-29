<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventModel extends Model
{
    protected $table = 'events';

    protected $fillable = ['user_id', 'name', 'photo', 'theme', 'event_date', 'description'];

    protected $casts = [
        'photo' => 'array',
        'event_date' => 'datetime',
    ];

    // GUNAKAN belongsTo DI SINI
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }
}
