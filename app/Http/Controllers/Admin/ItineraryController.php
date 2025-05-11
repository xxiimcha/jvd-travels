<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Itinerary;

class ItineraryController extends Controller
{
    public function index()
    {
        $tours = Tour::all();
        return view('admin.itineraries.index', compact('tours'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'day_number.*' => 'required|integer',
            'time.*' => 'required|string',
            'title.*' => 'required|string',
            'description.*' => 'nullable|string',
        ]);

        foreach ($request->title as $index => $title) {
            Itinerary::create([
                'tour_id'     => $request->tour_id,
                'day_number'  => $request->day_number[$index],
                'time'        => $request->time[$index],
                'title'       => $title,
                'description' => $request->description[$index],
            ]);
        }

        return back()->with('success', 'Itinerary successfully added.');
    }
}
