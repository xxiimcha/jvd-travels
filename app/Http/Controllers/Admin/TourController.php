<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::latest()->get();
        return view('admin.tours.index', compact('tours'));
    }

    public function create()
    {
        return view('admin.tours.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer',
            'price' => 'required|numeric',
            'season' => 'nullable|string',
            'capacity' => 'required|integer',
            'brochure' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('brochure')) {
            $validated['brochure'] = $request->file('brochure')->store('brochures', 'public');
        }

        Tour::create($validated);

        return redirect()->route('admin.tours.create')->with('success', 'Tour created successfully.');
    }

}