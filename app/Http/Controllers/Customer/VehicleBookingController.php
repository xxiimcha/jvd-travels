<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\VehicleBooking;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;

class VehicleBookingController extends Controller
{
    /**
     * Show the vehicle booking form for the selected vehicle.
     */
    public function show($id)
    {
        $response = Http::get('https://logistic2.easetravelandtours.com/api/vehicle');

        if ($response->failed()) {
            abort(500, 'Failed to fetch vehicle data.');
        }

        $vehicles = collect($response->json('data'));

        // Filter vehicles that are NOT 'In Use'
        $availableVehicles = $vehicles->filter(function ($vehicle) {
            return strtolower($vehicle['current_status']) !== 'in use';
        })->values();

        // Find the selected vehicle among available ones
        $selected = $availableVehicles->firstWhere('id', (int) $id);

        if (!$selected) {
            abort(404, 'Vehicle not found or currently in use.');
        }

        // Reorder the list: selected vehicle first, then the rest
        $allVehicles = collect([$selected])->merge(
            $availableVehicles->filter(fn($v) => $v['id'] !== (int) $id)
        )->values();

        return view('customer.vehicles.book', [
            'vehicleId' => $selected['id'],
            'vehicle' => $selected,
            'allVehicles' => $allVehicles
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_ids' => 'required|array',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:pickup_date',
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:1000',
            'total_price' => 'nullable|string',
        ]);

        $booking = VehicleBooking::create([
            'user_id' => Auth::id(),
            'vehicle_id' => json_encode($request->vehicle_ids), // Save as JSON array
            'pickup_date' => $request->pickup_date,
            'return_date' => $request->return_date,
            'origin' => $request->origin,
            'destination' => $request->destination,
            'full_name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'phone' => $request->phone,
            'address' => Auth::user()->address ?? 'N/A',
            'notes' => $request->notes ?? null,
            'total_price' => floatval(str_replace(['₱', ','], '', $request->total_price)),
            'status' => 'Pending',
        ]);

        // OPTIONAL: send email
        Mail::to($booking->email)->send(new BookingConfirmation($booking));

        return redirect()->route('customer.vehicles.index')
            ->with('success', 'Your vehicle booking was successfully submitted.');
    }
}
