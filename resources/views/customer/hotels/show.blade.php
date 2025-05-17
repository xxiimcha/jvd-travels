@extends('layouts.customer')

@section('title', $hotel->hotel_name)

@section('content')
<section class="inner-banner-wrap">
    <div class="inner-baner-container" style="background-image: url('{{ asset('assets/images/inner-banner.jpg') }}');">
        <div class="container">
            <div class="inner-banner-content">
                <h1 class="inner-title">{{ $hotel->hotel_name }}</h1>
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
                        <img src="{{ $imagePath }}" alt="Hotel Image" onerror="this.src='{{ asset('assets/images/default-hotel.jpg') }}'">
                    </figure>
                    <div class="tab-container mt-4">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#overview">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#rooms">Room Types</a>
                            </li>
                        </ul>
                        <div class="tab-content pt-3">
                            <div class="tab-pane fade show active" id="overview">
                                <table class="table table-bordered">
                                    <tr><th>Hotel Name</th><td>{{ $hotel->hotel_name }}</td></tr>
                                    <tr><th>Location</th><td>{{ $hotel->location }}</td></tr>
                                    <tr><th>Address</th><td>{{ $hotel->address }}</td></tr>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="rooms">
                                @if (!empty($roomTypes))
                                    <div class="row">
                                        @foreach ($roomTypes as $room)
                                            <div class="col-md-6 mb-3">
                                                <div class="card h-100 shadow-sm">
                                                    <div class="card-body d-flex flex-column justify-content-between">
                                                        <div>
                                                            <h5 class="card-title">{{ $room['type'] }}</h5>
                                                            <p class="card-text text-muted">Price: ₱{{ number_format($room['price'], 2) }}</p>
                                                        </div>
                                                        <a href="{{ route('customer.hotels.book', ['id' => $hotel->id, 'room' => $room['type']]) }}" class="btn btn-primary mt-3 w-100">
                                                            Book Now
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted">No room types available.</p>
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
