<div class="container">
    

    <!-- responsive -->
    <div class="nav-switch">
        <i class="fa fa-bars"></i>
    </div>
    {{-- <h1>{{ Request::is('/')? "Home":"Not Home" }}</h1> --}}
    <!-- Main Menu -->
    <ul class="main-menu">
        <li class="{{ (Request::is('/') ? 'active' : '') }}"><a href="/">Home</a></li>
        <li class="{{ (Request::is('about') ? 'active' : '') }}"><a href="/about">About</a></li>
        <li class="{{ (Request::is('search-product') ? 'active' : '') }}"><a href="/search-product">Shop</a></li>
       
        <li class="{{ (Request::is('contact') ? 'active' : '') }}"><a href="/contact2">Contact</a></li>
        <!-- <li><a href="elements.html"><i class="flaticon-020-decay"></i></a></li> -->
        @auth
        <li class="dashboard-style"><a href="{{'/patient'}}">Dashboard</a></li>
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