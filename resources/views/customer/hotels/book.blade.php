@extends('layouts.customer')

@section('title', 'Book Hotel')

@section('content')
<section class="inner-banner-wrap">
    <div class="inner-baner-container" style="background-image: url('{{ asset('assets/images/inner-banner.jpg') }}');">
        <div class="container">
            <div class="inner-banner-content">
                <h1 class="inner-title">Book Hotel</h1>
            </div>
        </div>
    </div>
</section>

<section class="step-section cart-section pt-5 pb-5">
    <div class="container">
        <div class="step-link-wrap mb-4 text-center">
            <div class="step-item active">Your Booking</div>
            <div class="step-item">Your Details</div>
            <div class="step-item">Finish</div>
        </div>

        <div class="cart-list-inner">
            <form action="{{ route('customer.hotels.book.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                <div class="table-responsive mb-4">
                    <table class="table table-bordered">
                        <thead class="thead-light text-center">
                            <tr>
                                <th>Hotel</th>
                                <th>Room Type</th>
                                <th>Price</th>
                                <th>Check-in Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $hotel->hotel_name }}</td>
                                <td>
                                    <select name="room_type" class="form-control" required>
                                        <option value="">Select Room</option>
                                        @foreach ($roomTypes as $room)
                                            <option value="{{ $room['type'] }}" {{ request('room') == $room['type'] ? 'selected' : '' }}>{{ $room['type'] }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="room_price" class="form-control" required>
                                        <option value="">Select Price</option>
                                        @foreach ($roomTypes as $room)
                                            <option value="{{ $room['price'] }}">₱{{ number_format($room['price'], 2) }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="date" name="checkin_date" class="form-control" required>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <h4 class="mb-3">Customer Details</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <input name="full_name" class="form-control mb-3" type="text" placeholder="Full Name" required>
                        </div>
                        <div class="col-md-4">
                            <input name="email" class="form-control mb-3" type="email" placeholder="Email" required>
                        </div>
                        <div class="col-md-4">
                            <input name="contact" class="form-control mb-3" type="text" placeholder="Contact Number" required>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="button-primary">Confirm Booking</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
