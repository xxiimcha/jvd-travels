@extends('layouts.customer')

@section('title', $vehicle['model'] . ' - ' . $vehicle['manufacturer'])

@section('content')
<section class="inner-banner-wrap">
    <div class="inner-baner-container" style="background-image: url('{{ asset('assets/images/inner-banner.jpg') }}');">
        <div class="container">
            <div class="inner-banner-content">
                <h1 class="inner-title">{{ $vehicle['model'] }} - {{ $vehicle['manufacturer'] }}</h1>
            </div>
        </div>
    </div>
</section>

<div class="single-tour-section">
    <div class="container">
        <div class="row">
            <!-- Left Section -->
            <div class="col-lg-8">
                <div class="single-tour-inner">
                    <figure class="feature-image">
                        <img src="https://logistic2.easetravelandtours.com/storage/{{ $vehicle['image_path'] }}" alt="Vehicle Image" onerror="this.src='{{ asset('assets/images/default-hotel.jpg') }}'">
                    </figure>

                    <div class="tab-container mt-4">
                        <ul class="nav nav-tabs" id="vehicleTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="gallery-tab" data-toggle="tab" href="#gallery" role="tab">Gallery</a>
                            </li>
                        </ul>
                        <div class="tab-content pt-3" id="vehicleTabContent">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel">
                                <div class="overview-content">
                                    <p>{!! $vehicle['remarks'] ?? 'No description available for this vehicle.' !!}</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="gallery" role="tabpanel">
                                @if (!empty($vehicle['image_path']))
                                <div class="single-tour-gallery mt-3">
                                    <figure class="feature-image">
                                        <img src="https://logistic2.easetravelandtours.com/storage/{{ $vehicle['image_path'] }}" alt="Vehicle Gallery Image">
                                    </figure>
                                </div>
                                @else
                                <p class="text-muted">No gallery image available.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">
                    @if (!empty($vehicle['purchase_price']))
                    <div class="package-price mb-3">
                        <h5 class="price">
                            <span>₱{{ number_format($vehicle['purchase_price'], 2) }}</span> / full rental
                        </h5>
                    </div>
                    @endif

                    <div class="widget-bg p-3 shadow-sm">
                        <h4 class="bg-title mb-3">Vehicle Details</h4>
                        <table class="table table-bordered table-striped mb-0">
                            <tbody>
                                <tr>
                                    <th>Type</th>
                                    <td>{{ $vehicle['vehicle_type'] }}</td>
                                </tr>
                                <tr>
                                    <th>Manufacturer</th>
                                    <td>{{ $vehicle['manufacturer'] }}</td>
                                </tr>
                                <tr>
                                    <th>Model</th>
                                    <td>{{ $vehicle['model'] }}</td>
                                </tr>
                                <tr>
                                    <th>Year</th>
                                    <td>{{ $vehicle['year_of_manufacture'] }}</td>
                                </tr>
                                <tr>
                                    <th>Fuel</th>
                                    <td>{{ $vehicle['fuel_type'] }}</td>
                                </tr>
                                <tr>
                                    <th>Capacity</th>
                                    <td>{{ $vehicle['capacity'] }} persons</td>
                                </tr>
                                <tr>
                                    <th>Color</th>
                                    <td>{{ $vehicle['color'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Sidebar -->
        </div>
    </div>
</div>
@endsection
