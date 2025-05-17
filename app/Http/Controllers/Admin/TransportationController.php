<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\VehicleBooking;

class TransportationController extends Controller
{
    public function ratingSchedule()
    {
        $response = Http::get('https://logistic2.easetravelandtours.com/api/vehicle');

        if ($response->successful()) {
            $schedules = $response->json(); // Expects a 'data' key
        } else {
            $schedules = ['data' => []];
        }

        return view('admin.transportation.rating_schedule', compact('schedules'));
    }


    public function index()
    {
        // Fetch bookings from DB
        $bookings = VehicleBooking::orderBy('created_at', 'desc')->get();

        // Fetch vehicles from external API
        $vehicleResponse = Http::get('https://logistic2.easetravelandtours.com/api/vehicle');
        $vehicles = [];

        if ($vehicleResponse->successful()) {
            $vehicles = collect($vehicleResponse->json('data'))->keyBy('id');
        }

        return view('admin.transport.index', compact('bookings', 'vehicles'));
    }
}
