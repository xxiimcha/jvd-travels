<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/admin/images/favicon.png') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}" media="all">
    <!-- Fonts Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/all.min.css') }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/style.css') }}">
    <title>Admin Login | JVD Travel & Tours</title>
</head>
<body>
    <div class="login-page" style="background-image: url('{{ asset('assets/admin/images/bg.jpg') }}');">
        <div class="login-from-wrap">
            <form class="login-from" method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <h1 class="site-title">
                    <a href="#"><strong>JVD Admin</strong></a>
                </h1>

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <button class="button-primary w-100" type="submit">Login</button>
                </div>

                <a href="#" class="for-pass">Forgot Password?</a>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/admin/js/jquery-3.2.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/canvasjs.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('assets/admin/js/dashboard-custom.js') }}"></script>
</body>
</html>
