<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VehicleBooking;

class ExternalApiController extends Controller
{
    // Return all vehicle bookings (no auth required)
    public function getVehicleBookings()
    {
        $bookings = VehicleBooking::select([
            'id',
            'user_id',
            'vehicle_id',
            'pickup_date',
            'return_date',
            'origin',
            'destination',
            'full_name',
            'email',
            'phone',
            'address',
            'notes',
            'total_price',
            'status',
            'created_at',
            'updated_at'
        ])->orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'data' => $bookings
        ], 200);
    }

    public function updateBookingStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        $booking = VehicleBooking::find($id);

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found.'
            ], 404);
        }

        $booking->status = $request->status;
        $booking->save();

        return response()->json([
            'success' => true,
            'message' => "Booking has been {$request->status}.",
            'data' => $booking
        ]);
    }
}
