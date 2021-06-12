<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- User Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-user mr-1"></i> {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu">
                {{-- <a href="" class="dropdown-item">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="dropdown-item-title"><i class="fas fa-lock mr-1"></i> পাসওয়ার্ড পরিবর্তন </h3>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div> --}}
                <form method="POST" action="{{ route('pourashava_frontend.user.logout', Request::route('pourashava_slug')) }}">
                    @csrf

                    <a href="{{ route('pourashava_frontend.user.logout', Request::route('pourashava_slug')) }}" class="dropdown-item" 
                        onclick="event.preventDefault();
                                this.closest('form').submit();">
                        <!-- Logout -->
                        <div class="media">
                            <div class="media-body">
                                <h3 class="dropdown-item-title"><i class="fas fa-sign-out-alt mr-1"></i> লগআউট </h3>
                            </div>
                        </div>
                        <!-- Logout End -->
                    </a>
                </form>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->