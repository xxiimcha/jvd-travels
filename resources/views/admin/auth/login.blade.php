@extends('layouts.plain') {{-- Optional: if you want a layout with just the head/footer --}}
@section('title', 'Admin Login')

@section('content')
<div class="login-page" style="background-image: url('{{ asset('assets/admin/images/bg.jpg') }}');">
    <div class="login-from-wrap">
        <form method="POST" action="{{ route('admin.login.submit') }}" class="login-from">
            @csrf
            <h1 class="site-title">
                <a href="#">
                    <img src="{{ asset('assets/admin/images/logo.png') }}" alt="Admin Logo">
                </a>
            </h1>
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" name="username" type="text" class="form-control" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit" class="button-primary w-100">Login</button>
            </div>
            <a href="{{ route('admin.password.request') }}" class="for-pass">Forgot Password?</a>
        </form>
    </div>
</div>
@endsection
