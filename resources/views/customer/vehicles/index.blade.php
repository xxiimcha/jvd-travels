@extends('layouts.customer')

@section('title', 'Car Rentals')

@section('content')
<section class="inner-banner-wrap">
    <div class="inner-baner-container" style="background-image: url('{{ asset('assets/images/inner-banner.jpg') }}');">
        <div class="container">
            <div class="inner-banner-content">
                <h1 class="inner-title">Car Rentals</h1>
            </div>
        </div>
    </div>
</section>

<section class="package-section pt-5 pb-5">
    <div class="container">
        <div class="package-inner">
            <div class="row">
                @forelse ($vehicles as $vehicle)
                    @if ($vehicle['current_status'] !== 'In Use')
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="package-wrap">
                            <figure class="feature-image" style="height: 250px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                <a href="#">
                                    <img src="https://logistic2.easetravelandtours.com/storage/{{ $vehicle['image_path'] }}" onerror="this.src='{{ asset('assets/images/default-hotel.jpg') }}'" alt="Vehicle Image" style="width: 100%; height: 100%; object-fit: cover;">
                                </a>
                            </figure>
                            @if (!empty($vehicle['purchase_price']))
                            <div class="package-price">
                                <h6>
                                    <span>₱{{ number_format($vehicle['purchase_price'], 2) }}</span>
                                </h6>
                            </div>
                            @endif
                            <div class="package-content-wrap">
                                <div class="package-meta text-center">
                                    <ul>
                                        <li><i class="fas fa-bus"></i> {{ $vehicle['vehicle_type'] }}</li>
                                    </ul>
                                </div>
                                <div class="package-content">
                                    <a href="{{ route('customer.vehicles.show', $vehicle['id']) }}">
                                        {{ $vehicle['model'] }} - {{ $vehicle['manufacturer'] }}
                                    </a>

                                    <p><strong>Capacity:</strong> {{ $vehicle['capacity'] }} persons</p>
                                    <p><strong>Fuel Type:</strong> {{ $vehicle['fuel_type'] }}</p>
                                    <p><strong>Year:</strong> {{ $vehicle['year_of_manufacture'] }}</p>
                                    <p><strong>Color:</strong> {{ $vehicle['color'] }}</p>
                                    <div class="btn-wrap mt-3">
                                        <a href="#" class="button-text width-6">Book Now<i class="fas fa-arrow-right"></i></a>
                                        <a href="#" class="button-text width-6">Wish List<i class="far fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No vehicles available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
