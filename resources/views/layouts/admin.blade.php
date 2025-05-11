<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">
      <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/admin/css/all.min.css') }}">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Raleway:wght@400;600;700&display=swap">
      <link rel="stylesheet" href="{{ asset('assets/admin/style.css') }}">
      <title>Admin Panel - JVD Travel and Tours</title>
      @stack('styles')
   </head>
   <body>
      <div id="container-wrapper">
         <!-- Dashboard Container -->
         <div id="dashboard" class="dashboard-container">

            {{-- Header Section --}}
            @include('partials.admin.header')

            {{-- Sidebar Navigation --}}
            @include('partials.admin.sidebar')

            {{-- Main Content --}}
            <div class="db-info-wrap">
               @yield('content')
            </div>

            {{-- Footer --}}
            <div class="copyrights text-center py-3">
               Copyright © {{ now()->year }} JVD Travel and Tours. All rights reserved.
            </div>
         </div>
      </div>

      <script src="{{ asset('assets/admin/js/jquery-3.2.1.min.js') }}"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
      <script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('assets/admin/js/canvasjs.min.js') }}"></script>
      <script src="{{ asset('assets/admin/js/chart.js') }}"></script>
      <script src="{{ asset('assets/admin/js/counterup.min.js') }}"></script>
      <script src="{{ asset('assets/admin/js/jquery.slicknav.js') }}"></script>
      <script src="{{ asset('assets/admin/js/dashboard-custom.js') }}"></script>
      @stack('scripts')
   </body>
</html>
