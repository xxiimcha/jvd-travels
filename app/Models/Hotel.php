<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'hotel_name',
        'location',
        'room_type_pricing', // This replaces `room_type` and `price`
        'address',
    ];

    protected $casts = [
        'room_type_pricing' => 'array',
    ];
}
