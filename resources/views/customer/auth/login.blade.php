@extends('layouts.customer')

@section('content')
<section class="inner-banner-wrap">
    <div class="inner-baner-container" style="background-image: url('{{ asset('assets/customer/images/inner-banner.jpg') }}');">
        <div class="container">
            <div class="inner-banner-content">
                <h1 class="inner-title">Customer Login</h1>
            </div>
        </div>
    </div>
    <div class="inner-shape"></div>
</section>

<section class="contact-section pt-5 pb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 bg-white p-5 shadow">
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if(session('otp_required'))
                    <form method="POST" action="{{ route('customer.verify.otp') }}" class="row">
                        @csrf
                        <div class="col-12 mb-3">
                            <label class="form-label">Enter OTP sent to your email</label>
                            <input type="text" name="otp" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="button-primary w-100">Verify OTP</button>
                        </div>
                    </form>
                @else
                    <form method="POST" action="{{ route('customer.login') }}" class="row">
                        @csrf
                        <div class="col-12 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="col-12 mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="button-primary w-100">Login</button>
                        </div>
                        <div class="col-12 text-center mt-3">
                            <a href="{{ route('customer.register') }}">Don’t have an account? Register now</a>
                        </div>
                    </form>
                @endif

                @if($errors->has('error'))
                    <div class="alert alert-danger mt-3">
                        {{ $errors->first('error') }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>
@endsection
