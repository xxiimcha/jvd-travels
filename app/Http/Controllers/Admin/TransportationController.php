<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TransportationController extends Controller
{
    public function ratingSchedule()
    {
        $response = Http::get('https://core2.easetravelandtours.com/api/transpo-information');

        if ($response->successful()) {
            $schedules = $response->json(); // this will be an array
        } else {
            $schedules = []; // fallback on error
        }

        return view('admin.transportation.rating_schedule', compact('schedules'));
    }
}
