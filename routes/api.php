<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExternalApiController;

// Optional: Basic test route to verify Postman works
Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});

// Public external vehicle bookings API
Route::prefix('vehicle-bookings')->group(function () {
    // Get all vehicle bookings
    Route::get('/', [ExternalApiController::class, 'getVehicleBookings']);

    // Update booking status: approve or reject
    Route::post('/{id}/status', [ExternalApiController::class, 'updateBookingStatus']);
});
