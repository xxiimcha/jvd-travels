<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/customer/login', [CustomerAuthController::class, 'showLogin'])->name('customer.login');
Route::post('/customer/login', [CustomerAuthController::class, 'login']);

Route::get('/customer/register', [CustomerAuthController::class, 'showRegister'])->name('customer.register');
Route::post('/customer/register', [CustomerAuthController::class, 'register'])->name('customer.register.submit');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware('auth:admin')->name('dashboard');
});