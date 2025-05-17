<div class="dashboard-navigation">
    <div id="dashboard-Navigation" class="slick-nav"></div>
    <div id="navigation" class="navigation-container">
        <ul>
            <li class="active-menu">
                <a href="{{ url('/admin/dashboard') }}">
                    <i class="far fa-chart-bar"></i> Dashboard
                </a>
            </li>

            <li>
                <a><i class="fas fa-map-marked-alt"></i> Tour Management</a>
                <ul>
                    <li><a href="{{ url('/admin/tours') }}">All Tours</a></li>
                    <li><a href="{{ url('/admin/tours/create') }}">Create Tour</a></li>
                    <li><a href="{{ url('/admin/tours/bookings') }}">Tour Bookings</a></li>
                </ul>
            </li>

            <li>
                <a><i class="fas fa-stream"></i> Itineraries</a>
                <ul>
                    <li><a href="{{ url('/admin/itineraries') }}">Customer Itineraries</a></li>
                    <li><a href="{{ url('/admin/itineraries/adjustments') }}">AI Adjustments</a></li>
                </ul>
            </li>

            <li>
                <a><i class="fas fa-bus-alt"></i> Transportation</a>
                <ul>
                    <li><a href="{{ url('/admin/transport/bookings') }}">Bookings</a></li>
                    <li><a href="{{ url('/admin/transport/schedule') }}">Routing & Schedule</a></li>
                </ul>
            </li>

            <li>
                <a><i class="fas fa-hotel"></i> Hotel Reservations</a>
                <ul>
                    <li><a href="{{ url('/admin/hotels') }}">All Hotels</a></li>
                    <li><a href="{{ url('/admin/hotels/bookings') }}">Reservations</a></li>
                </ul>
            </li>

            <li>
                <a><i class="fas fa-users-cog"></i> Users</a>
                <ul>
                    <li><a href="{{ url('/admin/users') }}">User List</a></li>
                    <li><a href="{{ url('/admin/users/create') }}">New User</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ url('/admin/feedback') }}"><i class="fas fa-comments"></i> Feedback</a>
            </li>

            <li>
                <a href="{{ url('/admin/logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>
</div>
