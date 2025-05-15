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
            <div class="col-lg-8">
                <div class="single-tour-inner">
                    <figure class="feature-image">
                        <img src="https://logistic2.easetravelandtours.com/storage/{{ $vehicle['image_path'] }}" alt="Vehicle Image" onerror="this.src='{{ asset('assets/images/default-hotel.jpg') }}'">
                    </figure>
                    <div class="tab-container">
                        <ul class="nav nav-tabs" id="vehicleTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="features-tab" data-toggle="tab" href="#features" role="tab">Details</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="vehicleTabContent">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel">
                                <div class="overview-content">
                                    <p>{!! $vehicle['remarks'] ?? 'No description available for this vehicle.' !!}</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="features" role="tabpanel">
                                <table class="table table-bordered table-striped mt-3">
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
                                            <th>Fuel Type</th>
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
                                        @if (!empty($vehicle['purchase_price']))
                                        <tr>
                                            <th>Price</th>
                                            <td>₱{{ number_format($vehicle['purchase_price'], 2) }}</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if (!empty($vehicle['image_path']))
                    <div class="single-tour-gallery mt-5">
                        <h3>Gallery / Photos</h3>
                        <div class="single-tour-slider">
                            <div class="single-tour-item">
                                <figure class="feature-image">
                                    <img src="https://logistic2.easetravelandtours.com/storage/{{ $vehicle['image_path'] }}" alt="Vehicle Gallery Image">
                                </figure>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar">
                    @if (!empty($vehicle['purchase_price']))
                    <div class="package-price">
                        <h5 class="price">
                            <span>₱{{ number_format($vehicle['purchase_price'], 2) }}</span> / full rental
                        </h5>
                    </div>
                    @endif
                    <div class="widget-bg booking-form-wrap">
                        <h4 class="bg-title">Book This Vehicle</h4>
                        <form class="booking-form">
                            <div class="form-group">
                                <input name="name" type="text" placeholder="Full Name">
                            </div>
                            <div class="form-group">
                                <input name="email" type="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input name="contact" type="text" placeholder="Contact Number">
                            </div>
                            <div class="form-group">
                                <input class="input-date-picker" type="text" name="date" autocomplete="off" readonly="readonly" placeholder="Rental Date">
                            </div>
                            <div class="form-group submit-btn">
                                <input type="submit" name="submit" value="Book Now">
                            </div>
                        </form>
                    </div>
                    <div class="widget-bg information-content text-center">
                        <h5>Need Help?</h5>
                        <p>Contact us for additional assistance on bookings and vehicle information.</p>
                        <a href="#" class="button-primary">Contact Support</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
