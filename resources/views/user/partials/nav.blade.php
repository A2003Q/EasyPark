<header class="header_section" id="top">
  <div class="container">
    <nav class="navbar navbar-expand-lg custom_nav-container" >

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class=""></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" style="color: #3a3a5e" href="{{ route('user.parkings.index') }}">Parkings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"style="color: #3a3a5e" href="{{ route('user.subscriptions.index') }}">Subscriptions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link navbar-brand" style="color: #3a3a5e" href="{{ route('home') }}#top">
              <span>EasyPark</span>
            </a>
          </li>

          @auth
            <li class="nav-item">
              <a class="nav-link"style="color: #3a3a5e" href="{{ route('user.profile') }}">Profile</a>
            </li>
            <li class="nav-item" style="color: #3a3a5e">
              <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="nav-link"  style="background:none;border:0;" style="color: #3a3a5e">Logout</button>
              </form>
            </li>
          @else
            <li class="nav-item" style="color: #3a3a5e">
              <a class="nav-link" href="{{ route('login') }}">Sign in</a>
            </li>
          @endauth
        </ul>
      </div>

    </nav>
  </div>
</header>
