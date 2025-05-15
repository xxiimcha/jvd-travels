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

use App\Http\Controllers\Customer\CustHotelController;

Route::get('/', function () { return view('welcome'); });

// Customer Authentication
Route::get('/customer/login', [CustomerAuthController::class, 'showLogin'])->name('customer.login');
Route::post('/customer/login', [CustomerAuthController::class, 'login']);

Route::get('/customer/register', [CustomerAuthController::class, 'showRegister'])->name('customer.register');
Route::post('/customer/register', [CustomerAuthController::class, 'register'])->name('customer.register.submit');

// Customer Hotels
Route::get('/hotels', [CustHotelController::class, 'index'])->name('customer.hotels.index');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Login
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

    // Dashboard (protected, add middleware if needed)
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

    // Tranportation
    Route::get('/transport/schedule', [TransportationController::class, 'ratingSchedule'])->name('admin.transportation.rating_schedule');
}); 