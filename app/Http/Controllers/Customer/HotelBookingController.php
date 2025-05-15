<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelBookingController extends Controller
{
    public function show($id)
    {
        $hotel = Hotel::findOrFail($id);
        $roomTypes = json_decode($hotel->room_type_pricing ?? '[]', true);
        return view('customer.hotels.book', compact('hotel', 'roomTypes'));
    }

    public function store(Request $request)
    {
        // Sample store logic — you can save to a bookings table
        // For now we just redirect with a success message
        return redirect()->route('customer.hotels.index')
            ->with('success', 'Booking successfully submitted!');
    }
}
