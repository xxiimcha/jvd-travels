<!doctype html>
<html lang="en">
<head>
    @include('partials.customer.head')
</head>
<body class="home">
    <div id="siteLoader" class="site-loader">
        <div class="preloader-content">
            <img src="{{ asset('assets/customer/images/loader1.gif') }}" alt="">
        </div>
    </div>

    <div id="page" class="full-page">
        @include('partials.customer.header')

         <main id="content" class="site-main">
            @yield('content')
        </main>

        @include('partials.customer.footer')
    </div>

    @include('partials.customer.scripts')
</body>
</html>
