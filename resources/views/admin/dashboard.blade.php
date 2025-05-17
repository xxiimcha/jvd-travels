@extends('layouts.admin')

@section('content')
<div class="db-info-wrap">
    <div class="row">
        <div class="col-xl-36 col-sm-6">
            <div class="db-info-list">
                <div class="dashboard-stat-icon bg-warning">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="dashboard-stat-content">
                    <h4>Total Bookings</h4>
                    <h5>{{ number_format($totalBookings) }}</h5>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-sm-6">
            <div class="db-info-list">
                <div class="dashboard-stat-icon bg-purple">
                    <i class="fas fa-users"></i>
                </div>
                <div class="dashboard-stat-content">
                    <h4>Customers</h4>
                    <h5>{{ number_format($customers) }}</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Chart Section -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="dashboard-box chart-box">
                <h4>Booking Trends</h4>
                <div id="chartContainer" style="height: 250px; width: 100%;"></div>
            </div>
        </div>
    </div>
</div>
@endsection
