@extends('layouts.admin')

@section('title', 'Transport Bookings')

@section('content')
<div class="card shadow card-outline card-primary">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Vehicle Booking Records</h3>
    </div>

    <div class="card-body table-responsive">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-hover align-middle">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Pickup & Return</th>
                    <th>Origin & Destination</th>
                    <th>Vehicles</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $index => $booking)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $booking->full_name }}</td>
                    <td>{{ $booking->email }}</td>
                    <td>
                        <strong>Pickup:</strong> {{ \Carbon\Carbon::parse($booking->pickup_date)->format('M d, Y h:i A') }}<br>
                        <strong>Return:</strong> {{ \Carbon\Carbon::parse($booking->return_date)->format('M d, Y h:i A') }}
                    </td>
                    <td>{{ $booking->origin }} → {{ $booking->destination }}</td>
                    <td>
                        @php
                            $ids = is_array(json_decode($booking->vehicle_id, true)) ? json_decode($booking->vehicle_id, true) : [$booking->vehicle_id];
                        @endphp
                        @foreach ($ids as $vid)
                            @if (isset($vehicles[$vid]))
                                <span class="badge bg-info text-dark mb-1">
                                    {{ $vehicles[$vid]['model'] }} <small>({{ $vehicles[$vid]['manufacturer'] }})</small>
                                </span>
                            @else
                                <span class="badge bg-secondary mb-1">ID: {{ $vid }}</span>
                            @endif
                        @endforeach
                    </td>
                    <td>₱{{ number_format($booking->total_price, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $booking->status === 'pending' ? 'warning' : ($booking->status === 'approved' ? 'success' : 'secondary') }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No bookings found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
