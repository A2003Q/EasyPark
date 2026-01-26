<header class="header_section landing-header" id="top">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container landing-nav">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#home">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.parkings.index') }}">Parkings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    
                    <!-- Logo in Center -->
                    <li class="nav-item nav-logo-item">
                        <a class="nav-link navbar-brand" href="#top">
                            <img src="{{ asset('landing/images/logo2.png') }}" alt="ParkIt Logo" class="nav-logo">
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Reviews</a>
                    </li>
                    
                    {{-- إذا المستخدم مش مسجّل دخول --}}
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Sign In</a>
                        </li>
                    @endguest

                    {{-- إذا المستخدم مسجّل دخول --}}
                    @auth
                        {{-- إذا Admin --}}
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                        @else
                            {{-- User عادي --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.profile') }}">Profile</a>
                            </li>
                        @endif

                        {{-- Logout --}}
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="nav-link logout-link">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @endauth

                    <li class="nav-item">
                        <a class="nav-link" href="#footer">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>