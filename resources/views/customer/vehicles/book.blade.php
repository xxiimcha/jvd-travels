@extends('layouts.customer')

@section('title', 'Vehicle Booking')

@section('content')
<section class="inner-banner-wrap">
    <div class="inner-baner-container" style="background-image: url('{{ asset('assets/images/inner-banner.jpg') }}');">
        <div class="container">
            <div class="inner-banner-content">
                <h1 class="inner-title">Create Vehicle Reservation</h1>
            </div>
        </div>
    </div>
    <div class="inner-shape"></div>
</section>

<section class="booking-section pt-5 pb-5">
    <div class="container">
        <form method="POST" action="{{ route('customer.vehicles.book.submit') }}">
            @csrf

            <!-- Customer Info -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body row">
                    <div class="col-md-6 mb-3">
                        <label>Customer Name</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Customer Contact</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                </div>
            </div>

            <!-- Vehicle Selection -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <label class="mb-2"><strong>Select Vehicles</strong></label>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="selectAllVehicles" onchange="toggleAllVehicles(this)">
                        <label class="form-check-label" for="selectAllVehicles">Select All Vehicles</label>
                    </div>
                    <div class="ps-3">
                        @foreach ($allVehicles as $v)
                        <div class="form-check mb-1">
                            <input class="form-check-input vehicle-checkbox" type="checkbox" name="vehicle_ids[]" value="{{ $v['id'] }}" id="vehicle{{ $v['id'] }}">
                            <label class="form-check-label" for="vehicle{{ $v['id'] }}">
                                {{ $v['model'] }} <small class="text-muted">({{ $v['vehicle_type'] }}) - ₱{{ number_format($v['purchase_price'] ?? 0, 2) }}</small>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-2">
                        <span class="badge bg-primary">Vehicle Count: <span id="vehicleCount">0</span></span>
                    </div>
                </div>
            </div>

            <!-- Schedule -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body row">
                    <div class="col-md-6 mb-3">
                        <label>Start Date</label>
                        <input type="datetime-local" name="pickup_date" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>End Date</label>
                        <input type="datetime-local" name="return_date" class="form-control" required>
                    </div>
                </div>
            </div>

            <!-- Location Details -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body row">
                    <div class="col-md-6 mb-3">
                        <label>Pickup Location</label>
                        <input type="text" name="origin" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Destination</label>
                        <input type="text" name="destination" class="form-control" required>
                    </div>
                </div>
            </div>

            <!-- Price and Notes -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body row">
                    <div class="col-md-6 mb-3">
                        <label>Total Price (auto-calculated)</label>
                        <input type="text" name="total_price" class="form-control" id="totalPrice" readonly>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Reservation Notes</label>
                        <textarea class="form-control" name="notes" rows="4"></textarea>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="text-end">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-paper-plane me-1"></i> Create Reservation
                </button>
            </div>
        </form>
    </div>
</section>

<script>
    const vehiclePrices = @json(collect($allVehicles)->mapWithKeys(fn($v) => [$v['id'] => (float) ($v['purchase_price'] ?? 0)]));

    function toggleAllVehicles(source) {
        document.querySelectorAll('.vehicle-checkbox').forEach(cb => cb.checked = source.checked);
        updateVehicleCount();
        calculateTotalPrice();
    }

    function updateVehicleCount() {
        const count = document.querySelectorAll('.vehicle-checkbox:checked').length;
        document.getElementById('vehicleCount').textContent = count;
    }

    function calculateTotalPrice() {
        const pickup = document.querySelector('input[name="pickup_date"]').value;
        const returnDate = document.querySelector('input[name="return_date"]').value;

        if (!pickup || !returnDate) return;

        const start = new Date(pickup);
        const end = new Date(returnDate);
        let days = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
        days = Math.max(days, 1);

        let total = 0;
        document.querySelectorAll('.vehicle-checkbox:checked').forEach(cb => {
            const id = cb.value;
            const price = vehiclePrices[id] || 0;
            const perDay = price;
            total += perDay * days;
        });

        document.getElementById('totalPrice').value = `₱${total.toLocaleString(undefined, { maximumFractionDigits: 2 })}`;
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.vehicle-checkbox').forEach(cb => {
            cb.addEventListener('change', () => {
                updateVehicleCount();
                calculateTotalPrice();
            });
        });

        document.querySelector('input[name="pickup_date"]').addEventListener('change', calculateTotalPrice);
        document.querySelector('input[name="return_date"]').addEventListener('change', calculateTotalPrice);
    });
</script>
@endsection
