<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    /**
     * Display all hotels fetched from external API.
     */
    public function index()
    {
        $response = Http::get('https://core2.easetravelandtours.com/api/hotel-information');

        if (!$response->successful()) {
            return back()->with('error', 'Failed to fetch hotel data from API.');
        }

        $hotels = $response->json();

        // Load locally uploaded image paths, if any
        $localImages = [];
        foreach ($hotels as $hotel) {
            $localImages[$hotel['id']] = Storage::disk('public')->exists("hotel_images/{$hotel['id']}.jpg")
                ? asset("storage/hotel_images/{$hotel['id']}.jpg")
                : null;
        }

        return view('admin.hotels.index', compact('hotels', 'localImages'));
    }

    /**
     * Upload a local image for a specific hotel ID.
     */
    public function uploadImage(Request $request, $hotelId)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $image = $request->file('image');
        $image->storeAs('hotel_images', $hotelId . '.jpg', 'public');

        return back()->with('success', 'Image uploaded successfully.');
    }
}
