<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerDetail;
use App\Models\Inquiry;
use App\Models\TourBooking;
use App\Models\HotelBooking;
use App\Models\VehicleBooking;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $todayViews = 2450; // Placeholder or replace with actual tracking logic

        $earnings = TourBooking::whereMonth('created_at', now()->month)->sum('total_price')
                  + HotelBooking::whereMonth('created_at', now()->month)->sum('total_price')
                  + VehicleBooking::whereMonth('created_at', now()->month)->sum('total_price');

        $customers = CustomerDetail::count(); // Use CustomerDetail instead of User

        $inquiries = 134; // Replace with actual Inquiry::count() if model/table exists

        $totalBookings = TourBooking::count() + HotelBooking::count() + VehicleBooking::count();

        $notifications = [
            'New customer registered',
            'Tour Package approved',
            'Pending booking confirmed',
        ];

        return view('admin.dashboard', compact(
            'todayViews',
            'earnings',
            'customers',
            'inquiries',
            'notifications',
            'totalBookings'
        ));
    }
}
