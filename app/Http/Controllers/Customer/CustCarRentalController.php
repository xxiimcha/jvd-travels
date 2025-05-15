<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CustCarRentalController extends Controller
{
    public function index()
    {
        $response = Http::get('https://logistic2.easetravelandtours.com/api/vehicle');
        $vehicles = $response->successful() ? $response['data'] : [];

        return view('customer.vehicles.index', compact('vehicles'));
    }

    public function show($id)
    {
        $response = Http::get('https://logistic2.easetravelandtours.com/api/vehicle');

        if ($response->successful() && isset($response['data'])) {
            $vehicles = $response['data'];

            $vehicle = collect($vehicles)->firstWhere('id', $id);

            if ($vehicle) {
                return view('customer.vehicles.show', compact('vehicle'));
            }
        }

        abort(404, 'Vehicle not found');
    }
}
