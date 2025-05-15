@extends('layouts.customer')

@section('title', 'Available Hotels')

@section('content')
<section class="inner-banner-wrap">
    <div class="inner-baner-container" style="background-image: url('{{ asset('assets/images/inner-banner.jpg') }}');">
        <div class="container">
            <div class="inner-banner-content">
                <h1 class="inner-title">Available Hotels</h1>
            </div>
        </div>
    </div>
</section>

@include('home.search')

<section class="package-section pt-5 pb-5">
    <div class="container">
        <div class="package-inner">
            <div class="row">
                @forelse ($hotels as $hotel)
                    @php
                        $roomTypes = json_decode($hotel->room_type_pricing ?? '[]', true);
                        $imagePath = asset('storage/hotel_images/' . $hotel->id . '.jpg');
                    @endphp
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="package-wrap">
                            <figure class="feature-image">
                                <a href="#">
                                    <img src="{{ $imagePath }}" alt="Hotel Image" onerror="this.src='{{ asset('assets/images/default-hotel.jpg') }}'">
                                </a>
                            </figure>
                            <div class="package-price">
                            <h6>
                                <span>
                                    From ₱
                                    {{ isset($roomTypes[0]['price']) ? number_format($roomTypes[0]['price']) : 'N/A' }}
                                </span>
                            </h6>
                            </div>
                            <div class="package-content-wrap">
                                <div class="package-meta text-center">
                                    <ul>
                                        <li><i class="fas fa-map-marker-alt"></i> {{ $hotel->location }}</li>
                                    </ul>
                                </div>
                                <div class="package-content">
                                    <h3>
                                        <a href="#">{{ $hotel->hotel_name }}</a>
                                    </h3>
                                    <p><strong>Address:</strong> {{ $hotel->address }}</p>
                                    @if (!empty($roomTypes))
                                        <ul class="ps-3">
                                            @foreach ($roomTypes as $room)
                                                <li>{{ $room['type'] }} - ₱{{ number_format($room['price'], 2) }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-muted">No room types available</p>
                                    @endif
                                    <div class="btn-wrap mt-3">
                                        <a href="#" class="button-text width-6">Book Now<i class="fas fa-arrow-right"></i></a>
                                        <a href="#" class="button-text width-6">Wish List<i class="far fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No hotels available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
