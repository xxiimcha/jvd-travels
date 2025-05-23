<header id="masthead" class="site-header header-primary">
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 d-none d-lg-block">
                    <div class="header-contact-info">
                        <ul>
                            <li><a href="#"><i class="fas fa-phone-alt"></i>0975 058 0829</a></li>
                            <li><a href="mailto:info@travel.com"><i class="fas fa-envelope"></i> jvdclassic@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-header">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="site-identity">
                <p class="site-title">
                    <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center">
                        <img src="{{ asset('assets/logo.png') }}" alt="JVD Travel and Tours Logo" style="height: 40px;">
                    </a>
                </p>
            </div>
            <div class="main-navigation d-none d-lg-block">
                <nav id="navigation" class="navigation">
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="menu-item-has-children">
                            <a href="#">Tours</a>
                            <ul>
                                <li><a href="{{url('/tours')}}">Destinations</a></li>
                                <li><a href="#">Tour Packages</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ url('/vehicles') }}">Car Rental</a></li>
                        <li><a href="{{ url('/hotels') }}">Hotel Reservation</a></li>
                    </ul>
                </nav>
            </div>
            <div class="header-btn">
                @auth
                    <div class="dropdown">
                        <button class="button-primary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ url('/profile') }}">My Profile</a></li>
                            <li>
                                <form method="POST" action="{{ route('customer.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('customer.login') }}" class="button-primary">Login</a>
                @endauth
            </div>

        </div>
    </div>

    <div class="mobile-menu-container"></div>
</header>
