@extends('layouts.customer')

@section('title', 'Book Tour Schedule')

@section('content')
<section class="inner-banner-wrap">
    <div class="inner-baner-container" style="background-image: url('{{ asset('assets/images/inner-banner.jpg') }}');">
        <div class="container">
            <div class="inner-banner-content">
                <h1 class="inner-title">Book: {{ $tour->location }}</h1>
            </div>
        </div>
    </div>
</section>

<section class="booking-section pt-5 pb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 bg-white p-4 shadow">

                {{-- Tour Details Card --}}
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $tour->location }}</h5>
                        <p class="mb-1"><strong>Tour Type:</strong> {{ $tour->tour_type }}</p>
                        <p class="mb-1"><strong>Duration:</strong> {{ $tour->duration_days }} Days / {{ $tour->duration_nights }} Nights</p>
                        <p class="mb-1"><strong>Price Per Pax:</strong> ₱{{ number_format($tour->price, 2) }}</p>
                        <p class="mb-1"><strong>Availability:</strong> {{ $tour->availability }}</p>
                    </div>
                </div>

                <h4 class="mb-3">Schedule Date: {{ \Carbon\Carbon::parse($schedule->schedule_date)->format('F d, Y') }}</h4>

                <form method="POST" action="{{ route('customer.tours.book.schedule.submit', $schedule->id) }}" id="bookingForm">
                    @csrf

                    <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                    <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                    <input type="hidden" name="price_per_pax" id="pricePerPax" value="{{ $schedule->price }}">
                    <input type="hidden" name="tour_type" id="tourType" value="{{ $tour->tour_type }}">

                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" value="{{ Auth::user()->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact Number</label>
                        <input type="text" name="contact" class="form-control" required>
                    </div>

                    @if(strtolower($tour->tour_type) !== 'group')
                    <div class="mb-3" id="paxInputGroup">
                        <label for="pax_count" class="form-label">Number of Pax</label>
                        <input type="number" name="pax_count" id="paxCount" class="form-control" min="1" max="{{ $schedule->capacity }}" required>
                    </div>
                    @else
                    <input type="hidden" name="pax_count" id="paxCount" value="1">
                    @endif

                    <div class="mb-4">
                        <label class="form-label">Total Price</label>
                        <input type="text" id="totalPrice" class="form-control" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Confirm Booking</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    const paxInput = document.getElementById('paxCount');
    const pricePerPax = parseFloat(document.getElementById('pricePerPax').value);
    const totalPriceInput = document.getElementById('totalPrice');
    const tourType = document.getElementById('tourType').value.toLowerCase();

    function calculateTotal() {
        const pax = (tourType === 'group') ? 1 : (parseInt(paxInput.value) || 0);
        const total = pax * pricePerPax;
        totalPriceInput.value = `₱${total.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
    }

    if (tourType !== 'group') {
        paxInput.addEventListener('input', calculateTotal);
    }

    // Initial calculation
    calculateTotal();
</script>
@endsection
