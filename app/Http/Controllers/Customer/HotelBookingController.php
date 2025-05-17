<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hotel;
use App\Models\HotelBooking;
use Carbon\Carbon;

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
        $request->validate([
            'hotel_id'      => 'required|exists:hotels,id',
            'room_type'     => 'required|string',
            'room_price'    => 'required|numeric|min:0',
            'checkin_date'  => 'required|date|after_or_equal:today',
            'checkout_date' => 'required|date|after:checkin_date',
            'full_name'     => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'contact'       => 'required|string|max:20',
        ]);

        $checkin  = Carbon::parse($request->checkin_date);
        $checkout = Carbon::parse($request->checkout_date);
        $nights   = $checkin->diffInDays($checkout);
        $total    = $nights * $request->room_price;

        HotelBooking::create([
            'hotel_id'      => $request->hotel_id,
            'user_id'       => Auth::id(),
            'room_type'     => $request->room_type,
            'room_price'    => $request->room_price,
            'checkin_date'  => $checkin->toDateString(),
            'checkout_date' => $checkout->toDateString(),
            'total_price'   => $total,
            'full_name'     => $request->full_name,
            'email'         => $request->email,
            'contact'       => $request->contact,
            'status'        => 'pending',
        ]);

        return redirect()->route('customer.hotels.index')
            ->with('success', 'Hotel booking submitted successfully.');
    }
}
