<header class="header_section user-header" id="top">
  <div class="container">
    <nav class="navbar navbar-expand-lg custom_nav-container user-nav">

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class=""></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('user.parkings.index') }}">Parkings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('user.subscriptions.index') }}">Subscriptions</a>
          </li>
          
          <!-- Logo in Center -->
          <li class="nav-item nav-logo-item">
            <a class="nav-link navbar-brand" href="{{ route('home') }}#top">
              <img src="{{ asset('landing/images/logo2.png') }}" alt="ParkIt Logo" class="nav-logo">
            </a>
          </li>

          @auth
            <li class="nav-item">
              <a class="nav-link" href="{{ route('user.profile') }}">Profile</a>
            </li>
            <li class="nav-item">
              <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="nav-link logout-link">Logout</button>
              </form>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Sign in</a>
            </li>
          @endauth
        </ul>
      </div>

    </nav>
  </div>
</header>
