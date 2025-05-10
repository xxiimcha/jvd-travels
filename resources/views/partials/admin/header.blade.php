<div class="dashboard-header sticky-header">
    <div class="content-left logo-section pull-left">
        <h1><a href="{{ url('/admin/dashboard') }}">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
        </a></h1>
    </div>
    <div class="heaer-content-right pull-right">
        <div class="search-field">
            <form>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search Now">
                    <a href="#"><span class="search_btn"><i class="fa fa-search"></i></span></a>
                </div>
            </form>
        </div>
        <div class="dropdown">
            <a class="dropdown-toggle" id="notifyDropdown" data-toggle="dropdown">
                <div class="dropdown-item"><i class="far fa-envelope"></i><span class="notify">3</span></div>
            </a>
            <div class="dropdown-menu notification-menu" aria-labelledby="notifyDropdown">
                <h4>3 Notifications</h4>
                <ul>
                    <li><a href="#"><div class="list-img"><img src="{{ asset('assets/images/comment.jpg') }}" alt=""></div><div class="notification-content"><p>You have a notification.</p><small>2 hours ago</small></div></a></li>
                    <li><a href="#"><div class="list-img"><img src="{{ asset('assets/images/comment2.jpg') }}" alt=""></div><div class="notification-content"><p>You have a notification.</p><small>2 hours ago</small></div></a></li>
                    <li><a href="#"><div class="list-img"><img src="{{ asset('assets/images/comment3.jpg') }}" alt=""></div><div class="notification-content"><p>You have a notification.</p><small>2 hours ago</small></div></a></li>
                </ul>
                <a href="#" class="all-button">See all messages</a>
            </div>
        </div>
        <div class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown">
                <div class="dropdown-item profile-sec">
                    <img src="{{ asset('assets/images/comment.jpg') }}" alt="">
                    <span>My Account</span>
                    <i class="fas fa-caret-down"></i>
                </div>
            </a>
            <div class="dropdown-menu account-menu">
                <ul>
                    <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
                    <li><a href="#"><i class="fas fa-user-tie"></i> Profile</a></li>
                    <li><a href="#"><i class="fas fa-key"></i> Password</a></li>
                    <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
