<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\TourSchedule;

class CustTourController extends Controller
{
    public function index()
    {
        $tours = TourSchedule::selectRaw('
                api_tour_id,
                MIN(price) as min_price,
                MAX(tour_type) as tour_type,
                MAX(duration_days) as duration_days,
                MAX(duration_nights) as duration_nights,
                MAX(title) as title,
                MAX(description) as description,
                MAX(brochure) as brochure
            ')
            ->groupBy('api_tour_id')
            ->get();

        return view('customer.tours.index', compact('tours'));
    }

    public function show($api_tour_id)
    {
        $schedules = \App\Models\TourSchedule::where('api_tour_id', $api_tour_id)->get();

        if ($schedules->isEmpty()) {
            abort(404);
        }

        $tour = $schedules->first(); // For display details (like title, description)

        return view('customer.tours.show', compact('tour', 'schedules'));
    }

}
