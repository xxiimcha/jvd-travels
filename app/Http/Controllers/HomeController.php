<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourSchedule;

class HomeController extends Controller
{
    /**
     * Show the homepage with popular packages.
     *
     * @return \Illuminate\View\View
     */
    public function homepage()
    {
        // Get 3 random tour schedules to display as popular packages
        $popularPackages = TourSchedule::inRandomOrder()->take(3)->get();

        return view('welcome', compact('popularPackages'));
    }
}
