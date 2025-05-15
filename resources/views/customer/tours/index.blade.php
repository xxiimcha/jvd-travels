@extends('layouts.customer')

@section('title', 'Available Tours')

@section('content')
<section class="inner-banner-wrap">
    <div class="inner-baner-container" style="background-image: url('{{ asset('assets/images/inner-banner.jpg') }}');">
        <div class="container">
            <div class="inner-banner-content">
                <h1 class="inner-title">Available Tours</h1>
            </div>
        </div>
    </div>
</section>

<section class="package-section pt-5 pb-5">
    <div class="container">
        <div class="package-inner">
            <div class="row">
                @forelse ($tours as $tour)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="package-wrap">
                            <figure class="feature-image">
                                <a href="{{ route('customer.tours.show', $tour->api_tour_id) }}">
                                    <img src="{{ asset('storage/' . $tour->brochure) }}" alt="Tour Image" onerror="this.src='{{ asset('assets/images/default-tour.jpg') }}'">                                </a>
                            </figure>
                            <div class="package-price">
                                <h6>
                                    <span>Starts at ₱{{ number_format($tour->min_price, 2) }}</span>
                                </h6>
                            </div>
                            <div class="package-content-wrap">
                                <div class="package-meta text-center">
                                    <ul>
                                        <li><i class="fas fa-users"></i> {{ $tour->tour_type }}</li>
                                        <li><i class="fas fa-clock"></i> {{ $tour->duration_days }} Days / {{ $tour->duration_nights }} Nights</li>
                                    </ul>
                                </div>
                                <div class="package-content">
                                    <h3>
                                        <a href="{{ route('customer.tours.show', $tour->api_tour_id) }}">{{ $tour->title }}</a>
                                    </h3>
                                    <p>{!! $tour->description !!}</p>
                                    <div class="btn-wrap mt-3">
                                        <a href="{{ route('customer.tours.show', $tour->api_tour_id) }}" class="button-text width-6">View Schedules <i class="fas fa-arrow-right"></i></a>
                                        <a href="#" class="button-text width-6">Wish List<i class="far fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No tours available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
