<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'day_number',
        'time',
        'title',
        'description',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
