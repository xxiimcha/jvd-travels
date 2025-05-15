<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;

class CustHotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return view('customer.hotels.index', compact('hotels'));
    }

    public function show($id)
    {
        $hotel = Hotel::findOrFail($id);
        $roomTypes = json_decode($hotel->room_type_pricing ?? '[]', true);
        $imagePath = asset('storage/hotel_images/' . $hotel->id . '.jpg');

        return view('customer.hotels.show', compact('hotel', 'roomTypes', 'imagePath'));
    }

}
