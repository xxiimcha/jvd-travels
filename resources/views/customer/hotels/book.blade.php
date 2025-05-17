@extends('layouts.customer')

@section('title', 'Book Hotel')

@section('content')
<section class="inner-banner-wrap">
    <div class="inner-baner-container" style="background-image: url('{{ asset('assets/images/inner-banner.jpg') }}');">
        <div class="container">
            <div class="inner-banner-content">
                <h1 class="inner-title">Book: {{ $hotel->hotel_name }}</h1>
            </div>
        </div>
    </div>
</section>

<section class="booking-section pt-5 pb-5">
    <div class="container">
        {{-- Hotel Overview --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h4 class="mb-3">{{ $hotel->hotel_name }}</h4>
                <p class="mb-1"><strong>Location:</strong> {{ $hotel->location }}</p>
                <p class="mb-1"><strong>Address:</strong> {{ $hotel->address }}</p>
            </div>
        </div>

        {{-- Booking Form --}}
        <form method="POST" action="{{ route('customer.hotels.book.submit') }}" class="bg-white p-4 shadow">
            @csrf
            <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="room_type" class="form-label">Room Type</label>
                    <select name="room_type" id="roomType" class="form-control" required>
                        <option value="">Select Room</option>
                        @foreach ($roomTypes as $room)
                            <option value="{{ $room['type'] }}" data-price="{{ $room['price'] }}" {{ request('room') == $room['type'] ? 'selected' : '' }}>
                                {{ $room['type'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="room_price" class="form-label">Room Price (Per Night)</label>
                    <input type="text" id="roomPrice" class="form-control" readonly>
                    <input type="hidden" name="room_price" id="roomPriceRaw">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="checkin_date" class="form-label">Check-in Date</label>
                    <input type="date" name="checkin_date" id="checkinDate" class="form-control" required min="{{ now()->toDateString() }}">
                </div>
                <div class="col-md-6">
                    <label for="checkout_date" class="form-label">Check-out Date</label>
                    <input type="date" name="checkout_date" id="checkoutDate" class="form-control" required min="{{ now()->toDateString() }}">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Total Price</label>
                <input type="text" id="totalPrice" class="form-control" readonly>
            </div>

            <hr class="my-4">

            <h5 class="mb-3">Customer Information</h5>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <input name="full_name" class="form-control" type="text" placeholder="Full Name" value="{{ Auth::user()->name ?? '' }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <input name="email" class="form-control" type="email" placeholder="Email" value="{{ Auth::user()->email ?? '' }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <input name="contact" class="form-control" type="text" placeholder="Contact Number" required>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Confirm Booking</button>
            </div>
        </form>
    </div>
</section>

<script>
    const roomSelect = document.getElementById('roomType');
    const priceInput = document.getElementById('roomPrice');
    const priceRawInput = document.getElementById('roomPriceRaw');
    const checkinInput = document.getElementById('checkinDate');
    const checkoutInput = document.getElementById('checkoutDate');
    const totalInput = document.getElementById('totalPrice');

    function updatePrice() {
        const selected = roomSelect.options[roomSelect.selectedIndex];
        const price = parseFloat(selected.getAttribute('data-price')) || 0;
        priceInput.value = price ? `₱${price.toLocaleString(undefined, { minimumFractionDigits: 2 })}` : '';
        priceRawInput.value = price;
        computeTotal();
    }

    function computeTotal() {
        const price = parseFloat(priceRawInput.value) || 0;
        const checkin = new Date(checkinInput.value);
        const checkout = new Date(checkoutInput.value);

        if (checkin && checkout && checkout > checkin) {
            const diffDays = Math.round((checkout - checkin) / (1000 * 60 * 60 * 24));
            const total = price * diffDays;
            totalInput.value = `₱${total.toLocaleString(undefined, { minimumFractionDigits: 2 })}`;
        } else {
            totalInput.value = '';
        }
    }

    roomSelect.addEventListener('change', updatePrice);
    checkinInput.addEventListener('change', computeTotal);
    checkoutInput.addEventListener('change', computeTotal);

    document.addEventListener('DOMContentLoaded', () => {
        const today = new Date().toISOString().split('T')[0];
        checkinInput.setAttribute('min', today);
        checkoutInput.setAttribute('min', today);
        updatePrice();
    });
</script>
@endsection
