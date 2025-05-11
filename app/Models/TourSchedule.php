<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'api_tour_id',
        'title',
        'description',
        'tour_type',
        'duration_days',
        'duration_nights',
        'price',
        'price_basis',
        'capacity',
        'brochure',
        'schedule_date',
    ];
}
