<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;

class CustHotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return view('customer.hotels.index', compact('hotels'));
    }
}
