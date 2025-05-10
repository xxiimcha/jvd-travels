@extends('layouts.customer')

@section('content')
<section class="inner-banner-wrap">
    <div class="inner-baner-container" style="background-image: url('{{ asset('assets/customer/images/inner-banner.jpg') }}');">
        <div class="container">
            <div class="inner-banner-content">
                <h1 class="inner-title">Create Account</h1>
            </div>
        </div>
    </div>
</section>

<section class="contact-section pt-5 pb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 bg-white p-5 shadow">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('customer.register.submit') }}" class="row">
                    @csrf
                    <div class="col-12 mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="button-primary w-100">Register</button>
                    </div>
                    <div class="col-12 text-center mt-3">
                        <a href="{{ route('customer.login') }}">Already have an account? Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
