<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\TourSchedule;
use App\Models\TourBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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

    public function bookSchedule($id)
    {
        // 1. Get local schedule
        $schedule = TourSchedule::find($id);

        if (!$schedule) {
            abort(404, 'Schedule not found');
        }

        // 2. Fetch external API data
        $apiResponse = Http::get('https://core2.easetravelandtours.com/api/fetch-tour');

        if ($apiResponse->failed()) {
            abort(500, 'Failed to fetch external tour info');
        }

        $apiTours = $apiResponse->json('data');

        // 3. Match the tour by ID
        $apiTour = collect($apiTours)->firstWhere('id', $schedule->api_tour_id);

        if (!$apiTour) {
            abort(404, 'Tour details not found in external API.');
        }

        // 4. Return to view with merged data
        return view('customer.tours.book', [
            'schedule' => $schedule,
            'tour' => (object) $apiTour // Convert array to object for consistency in Blade
        ]);
    }

    public function submitBooking(Request $request, $id)
    {
        $schedule = TourSchedule::findOrFail($id);

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'contact' => 'required|string|max:20',
            'pax_count' => 'nullable|integer|min:1',
            'price_per_pax' => 'required|numeric',
        ]);

        // Default to 1 if pax is not applicable (e.g., Group type)
        $pax = $request->pax_count ?? 1;
        $total = $pax * $request->price_per_pax;
        TourBooking::create([
            'user_id' => Auth::id(),
            'schedule_id' => $schedule->id,
            'tour_id' => $schedule->api_tour_id, // still this...
            'full_name' => $request->full_name,
            'email' => $request->email,
            'contact' => $request->contact,
            'pax_count' => $pax,
            'total_price' => $total,
            'status' => 'pending'
        ]);


        return redirect()->route('customer.tours.index')->with('success', 'Tour schedule booked successfully.');
    }

}
