<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Customer Authentication
Route::get('/customer/login', [CustomerAuthController::class, 'showLogin'])->name('customer.login');
Route::post('/customer/login', [CustomerAuthController::class, 'login']);

Route::get('/customer/register', [CustomerAuthController::class, 'showRegister'])->name('customer.register');
Route::post('/customer/register', [CustomerAuthController::class, 'register'])->name('customer.register.submit');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Login
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

    // Dashboard (protected, add middleware if needed)
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
});
