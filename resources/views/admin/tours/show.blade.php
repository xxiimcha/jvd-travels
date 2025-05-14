@extends('layouts.admin')

@section('title', 'Tour Details')

@section('content')
<div class="card shadow card-info card-outline">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-map-marked-alt me-1"></i> Tour Details - {{ $tour->title }}</h3>
        <a href="{{ route('admin.tours.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <p><strong><i class="fas fa-tag me-1"></i>Tour Type:</strong> {{ $tour->tour_type }}</p>
                <p><strong><i class="fas fa-clock me-1"></i>Duration:</strong> {{ $tour->duration_days }}D / {{ $tour->duration_nights }}N</p>
                <p><strong><i class="fas fa-users me-1"></i>Capacity:</strong> {{ $tour->capacity }}</p>
                <p><strong><i class="fas fa-info-circle me-1"></i>Price Basis:</strong> {{ $tour->price_basis }}</p>
            </div>
            <div class="col-md-6">
                <p><strong><i class="fas fa-money-bill-wave me-1"></i>Price:</strong> ₱{{ number_format($tour->price, 2) }}</p>
                @if ($tour->brochure)
                <p><strong><i class="fas fa-file-pdf me-1"></i>Brochure:</strong>
                    <a href="{{ asset('storage/brochures/' . $tour->brochure) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                        View Brochure
                    </a>
                </p>
                @endif
            </div>
        </div>

        <div class="mb-3">
            <h5><i class="fas fa-align-left me-1"></i>Description</h5>
            <div class="border rounded p-3 bg-light">
                {!! nl2br(e($tour->description)) !!}
            </div>
        </div>

        <hr>

        <div class="mt-4">
            <h5><i class="fas fa-calendar-alt me-1"></i>Tour Schedules</h5>
            @if ($schedules->isEmpty())
                <p class="text-muted">No schedules available.</p>
            @else
                <div class="row">
                    @foreach ($schedules as $item)
                    <div class="col-md-4 mb-2">
                        <div class="border p-2 rounded bg-white shadow-sm">
                            <i class="far fa-calendar-alt text-primary me-1"></i>
                            {{ \Carbon\Carbon::parse($item->schedule_date)->format('F j, Y') }}
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
