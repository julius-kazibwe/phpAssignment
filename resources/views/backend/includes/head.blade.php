<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-5">
    <div class="container">
        <!-- Navbar content -->
        <a href="{{ route('dashboard', ['type' => Auth::user()->type])}}" class="navbar-brand">
            <img style="width: 100px;" src="{{ asset('images/main/mainlayout/logo_light.png') }}" alt="">
        </a>

        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/patients/all') }}">Appointments</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{url('/home_treat')}}">Vaccination Record</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{url('/home_prescription')}}">Prescription</a>
                </li>

                @yield('nav-items')


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <input type="submit" class="dropdown-item" value="Logout">
                        </form>
                    </div>
                </li>


            </ul>
        </div>
    </div>
</nav>