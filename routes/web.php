<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAuthController;

// Admin Controller
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\ItineraryController;
use App\Http\Controllers\Admin\TransportationController;

//Customer Modules
use App\Http\Controllers\Customer\CustHotelController;
use App\Http\Controllers\Customer\CustCarRentalController;
use App\Http\Controllers\Customer\CustTourController;
use App\Http\Controllers\Customer\VehicleBookingController;

//Customer Booking
use App\Http\Controllers\Customer\HotelBookingController;


Route::get('/', function () {
    return view('welcome');
});

// ----------------------
// Customer Authentication
// ----------------------
Route::get('/customer/login', [CustomerAuthController::class, 'showLogin'])->name('customer.login');
Route::post('/customer/login', [CustomerAuthController::class, 'login']);
Route::post('/customer/verify-otp', [CustomerAuthController::class, 'verifyOtp'])->name('customer.verify.otp');

Route::get('/customer/register', [CustomerAuthController::class, 'showRegister'])->name('customer.register');
Route::post('/customer/register', [CustomerAuthController::class, 'register'])->name('customer.register.submit');

Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

// ----------------------
// Customer Hotels
// ----------------------
Route::get('/hotels', [CustHotelController::class, 'index'])->name('customer.hotels.index');
Route::get('/hotels/{id}', [CustHotelController::class, 'show'])->name('customer.hotels.show');
Route::get('/hotels/book/{id}', [HotelBookingController::class, 'show'])->name('customer.hotels.book');
Route::post('/hotels/book', [HotelBookingController::class, 'store'])->name('customer.hotels.book.submit');

// ----------------------
// Vehicles
// ----------------------
Route::get('/vehicles', [CustCarRentalController::class, 'index'])->name('customer.vehicles.index');

// FIX: move this above /vehicles/{id}
Route::get('/vehicles/book/{id}', [VehicleBookingController::class, 'show'])->name('customer.vehicles.book');
Route::post('/vehicles/book', [VehicleBookingController::class, 'store'])->name('customer.vehicles.book.submit');

// this should come last to avoid catching `/book/`
Route::get('/vehicles/{id}', [CustCarRentalController::class, 'show'])->name('customer.car.show');

// ----------------------
// Tours
// ----------------------
Route::get('/tours', [CustTourController::class, 'index'])->name('customer.tours.index');
Route::get('/tours/{api_tour_id}', [CustTourController::class, 'show'])->name('customer.tours.show');

// ----------------------
// Admin Routes
// ----------------------
Route::prefix('admin')->name('admin.')->group(function () {
    // Login
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Tours
    Route::get('/tours', [TourController::class, 'index'])->name('tours.index');
    Route::get('/tours/create', [TourController::class, 'create'])->name('tours.create');
    Route::post('/tours/store', [TourController::class, 'store'])->name('tours.store');
    Route::get('/tours/import-from-api', [TourController::class, 'importFromAPI'])->name('tours.import');
    Route::get('/tours/view/{id}', [TourController::class, 'show'])->name('tours.show');

    // Hotels
    Route::prefix('hotels')->name('hotels.')->group(function () {
        Route::get('/', [HotelController::class, 'index'])->name('index');
        Route::get('/create', [HotelController::class, 'create'])->name('create');
        Route::post('/store', [HotelController::class, 'store'])->name('store');
        Route::post('/upload-image/{hotelId}', [HotelController::class, 'uploadImage'])->name('uploadImage');
    });

    // Itineraries
    Route::get('/itineraries', [ItineraryController::class, 'index'])->name('itineraries.index');
    Route::post('/itineraries', [ItineraryController::class, 'store'])->name('itineraries.store');

    // Transportation Rating Schedule
    Route::get('/transport/schedule', [TransportationController::class, 'ratingSchedule'])->name('transportation.rating_schedule');

    // ✅ NEW: Vehicle Bookings Page
    Route::get('/transport/bookings', [TransportationController::class, 'index'])->name('transport.bookings');
});
