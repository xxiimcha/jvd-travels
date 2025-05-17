<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TourSchedule;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
   
    public function index()
    {
        $tours = TourSchedule::all()->groupBy('api_tour_id');
        return view('admin.tours.index', compact('tours'));
    }
    
    public function create()
    {
        return view('admin.tours.create');
    }

    public function show($id)
    {
        // Get the main tour info
        $tour = TourSchedule::where('id', $id)->firstOrFail();

        // Group all schedules with the same api_tour_id
        $schedules = TourSchedule::where('api_tour_id', $tour->api_tour_id)->get();

        // Fetch itineraries using the local tour ID (not api_tour_id)
        $itineraries = \App\Models\Itinerary::where('tour_id', $tour->id)->get();

        return view('admin.tours.show', compact('tour', 'schedules', 'itineraries'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'api_tour_id'     => 'required|integer',
            'title'           => 'required|string|max:255',
            'description'     => 'nullable|string',
            'tour_type'       => 'required|string|max:50',
            'duration_days'   => 'required|integer|min:1',
            'duration_nights' => 'required|integer|min:0',
            'price'           => 'required|numeric',
            'capacity'        => 'required|integer|min:1',
            'schedules'       => 'required|array|min:1',
            'schedules.*'     => 'required|date|after_or_equal:today',
            'brochure'        => 'nullable|image|max:2048',
        ]);

        $brochurePath = null;
        if ($request->hasFile('brochure')) {
            $brochurePath = $request->file('brochure')->store('brochures', 'public');
        }

        foreach ($request->schedules as $scheduleDate) {
            TourSchedule::create([
                'api_tour_id'     => $validated['api_tour_id'],
                'title'           => $validated['title'],
                'description'     => $validated['description'],
                'tour_type'       => $validated['tour_type'],
                'duration_days'   => $validated['duration_days'],
                'duration_nights' => $validated['duration_nights'],
                'price'           => $validated['price'],
                'price_basis'     => $request->price_basis ?? null,
                'capacity'        => $validated['capacity'],
                'schedule_date'   => $scheduleDate,
                'brochure'        => $brochurePath,
            ]);
        }

        return redirect()->route('admin.tours.create')->with('success', 'Tour schedules created successfully.');
    }

    public function bookings()
    {
        $bookings = \App\Models\TourBooking::latest()->get();
        return view('admin.tours.bookings', compact('bookings'));
    }

    public function updateBookingStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        $booking = \App\Models\TourBooking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        return redirect()->back()->with('success', 'Booking has been ' . $request->status . '.');
    }


}
