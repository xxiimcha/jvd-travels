@extends('layouts.admin')

@section('title', 'Tour Bookings')

@section('content')
<div class="card shadow card-primary card-outline">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Tour Bookings</h3>
    </div>

    <div class="card-body table-responsive">
        @if($bookings->isEmpty())
            <div class="alert alert-info">No tour bookings found.</div>
        @else
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Schedule</th>
                    <th>Pax</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $index => $booking)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $booking->full_name }}</td>
                    <td>{{ $booking->email }}</td>
                    <td>{{ $booking->contact }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->schedule->schedule_date)->format('F j, Y') }}</td>
                    <td>{{ $booking->pax_count ?? 'N/A' }}</td>
                    <td>₱{{ number_format($booking->total_price, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $booking->status == 'pending' ? 'warning' : ($booking->status == 'approved' ? 'success' : 'danger') }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td>
                        @if($booking->status == 'pending')
                        <form method="POST" action="{{ route('admin.tours.bookings.update', $booking->id) }}" style="display:inline-block">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('admin.tours.bookings.update', $booking->id) }}" style="display:inline-block">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                        </form>
                        @else
                            <button class="btn btn-sm btn-secondary" disabled>No Action</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection
