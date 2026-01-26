<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ParkEasy | Register</title>
        <!-- font css -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/style.css') }}">

  <style>
  body.auth_page{
    min-height: 100vh;
    overflow-x: hidden;
  }

  /* Landing hero background (blurred) */
  .auth_bg{
    position: fixed;
    inset: 0;
    background-image: url("{{ asset('landing/images/login-bg.jpg') }}");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    transform: scale(1.08);
    filter: blur(10px);
    z-index: 0;
  }

  .auth_bg::after{
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(58,58,94,0.55);
  }

  .auth_logo,
  .auth_logo span,
  .auth_logo span span{
    color: #3a3a5e !important;
  }

  .auth_page .container{
    position: relative;
    z-index: 2;
  }

  .auth_card{
    background: rgba(255,255,255,0.94);
    backdrop-filter: saturate(120%);
    border-radius: 16px  ;
    border: 5px solid #3a3a5e ;
    box-shadow: 0 18px 45px rgba(0,0,0,0.25);
  }

  .auth_page *,
  .auth_page *::before,
  .auth_page *::after{
    transition: none !important;
  }

  .auth_page .auth_form .form-group{
    display: block !important;
    width: 100% !important;
    margin: 0 0 16px 0 !important;
    float: none !important;
  }


  </style>
</head>
<body class="auth_page">

  <div class="auth_bg"></div>

  <div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
      <div class="col-md-6 col-lg-5">
        <div class="auth_card">
         <div class="auth_brand text-center">
    <a class="nav-link navbar-brand" href="#top" style="margin-bottom:0;padding-bottom:0;">
        <img src="{{ asset('landing/images/logo2.png') }}" alt="ParkIt Logo" class="nav-logo" style="margin-bottom:0;">
    </a>
    <p class="auth_subtitle text-center" style="margin-top:0;">Create your account</p>
</div>

          @if ($errors->any())
            <div class="alert alert-danger" role="alert">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('register') }}" class="auth_form" novalidate>
            @csrf

            <div class="form-group">
              <input
                type="text"
                class="form-control"
                name="name"
                value="{{ old('name') }}"
                placeholder="Full name"
                required
                autofocus
                autocomplete="name"
              >
            </div>

            <div class="form-group">
              <input
                type="email"
                class="form-control"
                name="email"
                value="{{ old('email') }}"
                placeholder="Email"
                required
                autocomplete="username"
              >
            </div>

            <div class="form-group">
              <input
                type="password"
                class="form-control"
                name="password"
                placeholder="Password"
                required
                autocomplete="new-password"
              >
            </div>

            <div class="form-group">
              <input
                type="password"
                class="form-control"
                name="password_confirmation"
                placeholder="Confirm password"
                required
                autocomplete="new-password"
              >
            </div>

            <button type="submit" class="btn auth_btn w-100">Sign up</button>

            <div class="text-center mt-3">
              <span class="small">Already have an account?</span>
              <a class="small" href="{{ route('login') }}">Login</a>
            </div>
          </form>

          <div class="auth_back">
            <a href="{{ route('home') }}#top">&larr; Back to Landing</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('landing/js/jquery.min.js') }}"></script>
  <script src="{{ asset('landing/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
