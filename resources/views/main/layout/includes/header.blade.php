<div class="container">
    
    <a href="/" class="navbar-brand">
        <img style="width: 100px;" src="{{ asset('images/main/mainlayout/logo_light.png') }}" alt="">
        <span>Covid Vaccination and Tracking Management System</span>
    </a>
    <!-- responsive -->
    <div class="nav-switch">
        <i class="fa fa-bars"></i>
        
    </div>
    {{-- <h1>{{ Request::is('/')? "Home":"Not Home" }}</h1> --}}
    <!-- Main Menu -->
    <ul class="main-menu">
        <li class="{{ (Request::is('/') ? 'active' : '') }}"><a href="/">Home</a></li>
        <li class="register-style"><a href="/registerp" class="register-style">Register</a></li>

        @auth
        <li class="dashboard-style"><a href="{{ route('dashboard', ['type' => Auth::user()->type])}}">Dashboard</a></li>
        <li class="logout-style"><a class="logout-style" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a></li>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @else
        <li class="login-style"><a href="/login">Sign In</a></li>
        @endauth
    </ul>
</div>