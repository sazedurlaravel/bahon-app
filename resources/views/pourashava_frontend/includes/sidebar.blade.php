<nav class="navbar navbar-inverse sidebar" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header" style="background-color: #086534;">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#bs-sidebar-navbar-collapse-1" style="background-color: #086534;">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1" style="background-color: #086534;">
            <ul class="nav navbar-nav" style="background-color: #086534;">
                <li><a href="#" class="text-white">ড্যাশবোর্ড</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle text-white" data-toggle="dropdown"
                        style="background-color: #086534;">সেটিংস <span class="caret"></span></a>
                    <ul class="dropdown-menu forAnimate" role="menu" style="background-color: #086534;">
                        <li><a href="#" class="text-white">পাসওয়ার্ড পরিবর্তন</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('pourashava_frontend.user.wallet', $pourashava_slug) }}" class="text-white">মাই ওয়ালেট</a>
                </li>



                <li style="padding: 12px;">
                    <form method="POST" action="{{ route('pourashava_frontend.user.logout', $pourashava_slug) }}">
                        @csrf
                        <a style="color: #fff; text-decoration: none;" href="#" class="dropdown-item" onclick="event.preventDefault();
                                    this.closest('form').submit();">লগআউট
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
