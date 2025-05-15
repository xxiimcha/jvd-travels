<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();

        $localImages = [];
        foreach ($hotels as $hotel) {
            $localImages[$hotel->id] = Storage::disk('public')->exists("hotel_images/{$hotel->id}.jpg")
                ? asset("storage/hotel_images/{$hotel->id}.jpg")
                : null;
        }

        return view('admin.hotels.index', compact('hotels', 'localImages'));
    }

    public function uploadImage(Request $request, $hotelId)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $image = $request->file('image');
        $image->storeAs('hotel_images', $hotelId . '.jpg', 'public');

        return back()->with('success', 'Image uploaded successfully.');
    }

    public function create()
    {
        return view('admin.hotels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'room_types' => 'required|array',
            'room_prices' => 'required|array',
            'room_types.*' => 'required|string|max:255',
            'room_prices.*' => 'required|numeric|min:0',
            'address' => 'required|string|max:500',
            'image' => 'required|image|max:2048',
        ]);
    
        $hotel = Hotel::create([
            'hotel_name' => $request->hotel_name,
            'location' => $request->location,
            'address' => $request->address,
            'room_type_pricing' => json_encode(array_map(function ($type, $price) {
                return ['type' => $type, 'price' => $price];
            }, $request->room_types, $request->room_prices)),
        ]);
    
        if ($request->hasFile('image')) {
            $request->file('image')->storeAs('hotel_images', $hotel->id . '.jpg', 'public');
        }
    
        return redirect()->route('admin.hotels.index')->with('success', 'Hotel added successfully.');
    }    
}
