<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <a class="navbar-brand" href="{{ '/' }}" rel="tooltip" data-placement="bottom">
            <img src="{{ asset('images/logo.png') }}" alt="" style="width: 100px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item mx-2">
                    <a class="nav-link" aria-current="page" href="{{ '/' }}">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ url('servicepage') }}">Services</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ url('aboutpage') }}">About Us</a>
                </li>
                @auth
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ url('profilekendaraan') }}">Kendaraan</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ url('profiletransaksi') }}">Transaksi</a>
                    </li>
                @endauth
            </ul>
            <div class="kanan navbar-nav ml-auto">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-lg login btn-outline-primary mx-2">Login</a>
                    {{-- <a href="{{ route('') }}" class="btn btn-lg signup mx-2">Sign Up</a> --}}
                @endguest
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            @auth
                                {{ Auth::user()->name }}
                            @endauth
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('showDetailProfileUser', Auth::user()->id) }}">Profile User</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ '/logout' }}">Logout</a>
                            </li>
                        </ul>
                    </li>
                @endauth
            </div>
        </div>
    </div>
</nav>
