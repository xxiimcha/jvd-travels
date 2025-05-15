@extends('layouts.customer')

@section('title', $tour->title)

@section('content')
<section class="inner-banner-wrap">
    <div class="inner-baner-container" style="background-image: url('{{ asset('assets/images/inner-banner.jpg') }}');">
        <div class="container">
            <div class="inner-banner-content">
                <h1 class="inner-title">{{ $tour->title }}</h1>
            </div>
        </div>
    </div>
</section>

<div class="single-tour-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="single-tour-inner">
                    <figure class="feature-image mb-4">
                        <img src="{{ asset('storage/' . $tour->brochure) }}" alt="Tour Image" onerror="this.src='{{ asset('assets/images/default-tour.jpg') }}'">
                    </figure>
                    <div class="tab-container mt-4">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#overview">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#schedules">Available Schedules</a>
                            </li>
                        </ul>
                        <div class="tab-content pt-3">
                            <div class="tab-pane fade show active" id="overview">
                                <table class="table table-bordered">
                                    <tr><th>Title</th><td>{{ $tour->title }}</td></tr>
                                    <tr><th>Type</th><td>{{ $tour->tour_type }}</td></tr>
                                    <tr><th>Duration</th><td>{{ $tour->duration_days }} Days / {{ $tour->duration_nights }} Nights</td></tr>
                                    <tr><th>Description</th><td>{!! $tour->description !!}</td></tr>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="schedules">
                                @if ($schedules->count())
                                    <div class="row">
                                        @foreach ($schedules as $schedule)
                                            <div class="col-md-6 mb-3">
                                                <div class="card h-100 shadow-sm">
                                                    <div class="card-body d-flex flex-column justify-content-between">
                                                        <div>
                                                            <h5 class="card-title">{{ $schedule->schedule_date }}</h5>
                                                            <p class="card-text mb-1 text-muted">Price: ₱{{ number_format($schedule->price, 2) }}</p>
                                                            <p class="card-text text-muted">Capacity: {{ $schedule->capacity }} pax</p>
                                                        </div>
                                                        <a href="#" class="btn btn-primary mt-3 w-100">Book Schedule</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted">No schedules available for this tour yet.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
