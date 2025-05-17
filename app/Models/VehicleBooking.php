<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleBooking extends Model
{
    use HasFactory;

    protected $table = 'vehicle_bookings';

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'pickup_date',
        'return_date',
        'origin',
        'destination',
        'full_name',
        'email',
        'phone',
        'address',
        'notes',
        'total_price',
        'status',
    ];

    protected $casts = [
        'pickup_date' => 'datetime',
        'return_date' => 'datetime',
        'total_price' => 'float',
    ];

    // Optional: Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
