<h2>Booking Confirmation</h2>
<p>Hi {{ $booking->full_name }},</p>
<p>Your booking from <strong>{{ $booking->pickup_date }}</strong> to <strong>{{ $booking->return_date }}</strong> has been received.</p>
<p>Total Price: ₱{{ number_format($booking->total_price, 2) }}</p>
<p>Status: {{ $booking->status }}</p>
<p>Thank you for booking with us!</p>
