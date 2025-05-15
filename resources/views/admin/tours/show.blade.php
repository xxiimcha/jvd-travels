@extends('layouts.admin')

@section('title', 'Tour Details')

@section('content')
<div class="card shadow card-info card-outline">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Tour Details - {{ $tour->title }}</h3>
        <a href="{{ route('admin.tours.index') }}" class="btn btn-secondary btn-sm">
            Back
        </a>
    </div>

    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <p><strong>Tour Type:</strong> {{ $tour->tour_type }}</p>
                <p><strong>Duration:</strong> {{ $tour->duration_days }}D / {{ $tour->duration_nights }}N</p>
                <p><strong>Capacity:</strong> {{ $tour->capacity }}</p>
                <p><strong>Price Basis:</strong> {{ $tour->price_basis }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Price:</strong> ₱{{ number_format($tour->price, 2) }}</p>
                @if ($tour->brochure)
                <p><strong>Brochure:</strong>
                    <a href="{{ asset('storage/brochures/' . $tour->brochure) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                        View Brochure
                    </a>
                </p>
                @endif
            </div>
        </div>

        <div class="mb-3">
            <h5>Description</h5>
            <div class="border rounded p-3 bg-light">
                {!! $tour->description !!}
            </div>
        </div>

        <hr>

        <div class="mt-4">
            <h5>Tour Schedules</h5>
            @if ($schedules->isEmpty())
                <p class="text-muted">No schedules available.</p>
            @else
                <div class="row">
                    @foreach ($schedules as $item)
                    <div class="col-md-4 mb-2">
                        <div class="border p-2 rounded bg-white shadow-sm">
                            {{ \Carbon\Carbon::parse($item->schedule_date)->format('F j, Y') }}
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        <hr>

        <div class="mt-4">
            <h5>Itinerary</h5>
            @if ($itineraries->isEmpty())
                <p class="text-muted">No itinerary found.</p>
                <a href="{{ route('admin.itineraries.index') }}" class="btn btn-sm btn-primary">
                    Add Itinerary
                </a>
            @else
                @foreach ($itineraries->groupBy('day_number') as $day => $items)
                    <div class="mb-3">
                        <h6 class="text-primary">Day {{ $day }}</h6>
                        @foreach ($items as $item)
                            <div class="border rounded p-2 mb-2 bg-light">
                                <strong>{{ $item->time }}</strong> - {{ $item->title }}
                                <div>{!! $item->description !!}</div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
