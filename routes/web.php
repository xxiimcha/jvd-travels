<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\ExternalApiController;

// Customer Auth
use App\Http\Controllers\CustomerAuthController;

// Admin
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\ItineraryController;
use App\Http\Controllers\Admin\TransportationController;
use App\Http\Controllers\Admin\UserController;

// Customer Modules
use App\Http\Controllers\Customer\CustTourController;
use App\Http\Controllers\Customer\CustHotelController;
use App\Http\Controllers\Customer\CustCarRentalController;
use App\Http\Controllers\Customer\VehicleBookingController;
use App\Http\Controllers\Customer\HotelBookingController;

// Homepage
Route::get('/', [HomeController::class, 'homepage'])->name('home');

// ----------------------
// API Routes (Public Access)
// ----------------------
Route::prefix('external')->group(function () {
    Route::get('/vehicle-bookings', [ExternalApiController::class, 'getVehicleBookings']);
    Route::post('/vehicle-bookings/{id}/status', [ExternalApiController::class, 'updateBookingStatus']);
});

// ----------------------
// Customer Authentication
// ----------------------
Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('/login', [CustomerAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [CustomerAuthController::class, 'login']);
    Route::post('/verify-otp', [CustomerAuthController::class, 'verifyOtp'])->name('verify.otp');

    Route::get('/register', [CustomerAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [CustomerAuthController::class, 'register'])->name('register.submit');

    Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('logout');
});

// ----------------------
// Customer Hotel Booking
// ----------------------
Route::prefix('hotels')->name('customer.hotels.')->group(function () {
    Route::get('/', [CustHotelController::class, 'index'])->name('index');
    Route::get('/{id}', [CustHotelController::class, 'show'])->name('show');
    Route::get('/book/{id}', [HotelBookingController::class, 'show'])->name('book');
    Route::post('/book', [HotelBookingController::class, 'store'])->name('book.submit');
});

// ----------------------
// Customer Car Rentals
// ----------------------
Route::prefix('vehicles')->name('customer.vehicles.')->group(function () {
    Route::get('/', [CustCarRentalController::class, 'index'])->name('index');
    Route::get('/book/{id}', [VehicleBookingController::class, 'show'])->name('book');
    Route::post('/book', [VehicleBookingController::class, 'store'])->name('book.submit');
    Route::get('/{id}', [CustCarRentalController::class, 'show'])->name('show');
});

// ----------------------
// Customer Tours
// ----------------------
Route::prefix('tours')->name('customer.tours.')->group(function () {
    Route::get('/', [CustTourController::class, 'index'])->name('index');
    Route::get('/{api_tour_id}', [CustTourController::class, 'show'])->name('show');
    Route::get('/book-schedule/{id}', [CustTourController::class, 'bookSchedule'])->name('book.schedule');
    Route::post('/book-schedule/{id}', [CustTourController::class, 'submitBooking'])->name('book.schedule.submit');
});

// ----------------------
// Admin Routes
// ----------------------
Route::prefix('admin')->name('admin.')->group(function () {
    // User
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');

    // Admin Auth
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Tours
    Route::prefix('tours')->name('tours.')->group(function () {
        Route::get('/', [TourController::class, 'index'])->name('index');
        Route::get('/create', [TourController::class, 'create'])->name('create');
        Route::post('/store', [TourController::class, 'store'])->name('store');
        Route::get('/view/{id}', [TourController::class, 'show'])->name('show');
        Route::get('/import-from-api', [TourController::class, 'importFromAPI'])->name('import');
        Route::get('/bookings', [TourController::class, 'bookings'])->name('bookings');
        Route::put('/bookings/{id}', [TourController::class, 'updateBookingStatus'])->name('bookings.update');
    });

    // Hotels
    Route::prefix('hotels')->name('hotels.')->group(function () {
        Route::get('/', [HotelController::class, 'index'])->name('index');
        Route::get('/create', [HotelController::class, 'create'])->name('create');
        Route::post('/store', [HotelController::class, 'store'])->name('store');
        Route::post('/upload-image/{hotelId}', [HotelController::class, 'uploadImage'])->name('uploadImage');
        Route::get('/bookings', [HotelController::class, 'bookings'])->name('bookings');
        Route::patch('/bookings/{id}', [HotelController::class, 'updateBookingStatus'])->name('bookings.update');
    });

    // Itineraries
    Route::get('/itineraries', [ItineraryController::class, 'index'])->name('itineraries.index');
    Route::post('/itineraries', [ItineraryController::class, 'store'])->name('itineraries.store');

    // Transportation
    Route::get('/transport/schedule', [TransportationController::class, 'ratingSchedule'])->name('transportation.rating_schedule');
    Route::get('/transport/bookings', [TransportationController::class, 'index'])->name('transport.bookings');
});
