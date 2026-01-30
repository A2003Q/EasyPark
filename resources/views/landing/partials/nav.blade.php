<header class="header_section landing-header" id="top">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container landing-nav">

            <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class=""></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav landing-navlist">

    {{-- LEFT SIDE --}}
    @guest
        <li class="nav-item">
            <a class="nav-link" href="#home">Home</a>
        </li>
    @endguest

    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.parkings.index') }}">Parkings</a>
    </li>

    @guest
        <li class="nav-item">
            <a class="nav-link" href="#about">About</a>
        </li>
    @endguest

    @auth
        @if(auth()->user()->role !== 'admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.subscriptions.index') }}">Subscriptions</a>
            </li>
        @endif
    @endauth

    <!-- LOGO CENTER -->
    <li class="nav-item nav-logo-item">
        <a class="nav-link navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('landing/images/logo2.png') }}" alt="ParkIt Logo" class="nav-logo">
        </a>
    </li>

    {{-- RIGHT SIDE --}}
    @guest
        <li class="nav-item">
            <a class="nav-link" href="#testimonials">Reviews</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Sign In</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#footer">Contact</a>
        </li>
    @endguest

    @auth
        @if(auth()->user()->role === 'admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.profile') }}">Profile</a>
            </li>
        @endif

        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="nav-link logout-link">Logout</button>
            </form>
        </li>
    @endauth

</ul>


            </div>
        </nav>
    </div>
</header>

