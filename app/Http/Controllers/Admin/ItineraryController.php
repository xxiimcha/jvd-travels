<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TourSchedule;
use App\Models\Itinerary;

class ItineraryController extends Controller
{
    public function index()
    {
        $tours = TourSchedule::selectRaw('MIN(id) as id, api_tour_id, MIN(title) as title, MIN(duration_days) as duration_days')
                    ->groupBy('api_tour_id')
                    ->get();

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

        try {
            foreach ($request->title as $index => $title) {
                Itinerary::create([
                    'tour_id'     => $request->tour_id,
                    'day_number'  => $request->day_number[$index],
                    'time'        => $request->time[$index],
                    'title'       => $title,
                    'description' => $request->description[$index] ?? null,
                ]);
            }

            // ✅ Always return JSON if the request is AJAX
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Itinerary saved successfully.'
                ]);
            }

            // Normal browser fallback
            return back()->with('success', 'Itinerary successfully added.');

        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while saving.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()->withErrors('An error occurred while saving.');
        }
    }

}
