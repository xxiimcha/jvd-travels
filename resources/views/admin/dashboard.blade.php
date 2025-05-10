@extends('layouts.admin')

@section('content')
<div class="db-info-wrap">
    <div class="row">
        <!-- Stats Box -->
        <div class="col-xl-3 col-sm-6">
            <div class="db-info-list">
                <div class="dashboard-stat-icon bg-blue">
                    <i class="far fa-chart-bar"></i>
                </div>
                <div class="dashboard-stat-content">
                    <h4>Today Views</h4>
                    <h5>2,450</h5>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="db-info-list">
                <div class="dashboard-stat-icon bg-green">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="dashboard-stat-content">
                    <h4>Earnings</h4>
                    <h5>₱82,300</h5>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="db-info-list">
                <div class="dashboard-stat-icon bg-purple">
                    <i class="fas fa-users"></i>
                </div>
                <div class="dashboard-stat-content">
                    <h4>Customers</h4>
                    <h5>1,820</h5>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="db-info-list">
                <div class="dashboard-stat-icon bg-red">
                    <i class="far fa-envelope-open"></i>
                </div>
                <div class="dashboard-stat-content">
                    <h4>Inquiries</h4>
                    <h5>134</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Chart Section -->
    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="dashboard-box chart-box">
                <h4>Booking Trends</h4>
                <div id="chartContainer" style="height: 250px; width: 100%;"></div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="dashboard-box">
                <h4>Notifications</h4>
                <ul class="list-group">
                    <li class="list-group-item">New customer registered</li>
                    <li class="list-group-item">Tour Package approved</li>
                    <li class="list-group-item">Pending booking confirmed</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
