<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ParkEasy | Login</title>
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
    transform: scale(1.08); /* عشان ما يبين حواف مع البلور */
    filter: blur(10px);     /* blur متوسط */
    z-index: 0;
  }

  /* Blue overlay فوق الخلفية */
  .auth_bg::after{
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(58,58,94,0.55); /* #3a3a5e */
  }
  /* Force auth logo to brand blue */
.auth_logo,
.auth_logo span,
.auth_logo span span{
  color: #3a3a5e !important;
}


  /* خلي كل محتوى الصفحة فوق الخلفية */
  .auth_page .container{
    position: relative;
    z-index: 2;
  }

  /* إذا حبيتي بوكس اللوجين يكون أوضح شوي */
  .auth_card{
    background: rgba(255,255,255,0.94);
    backdrop-filter: saturate(120%);
    border-radius: 16px;
    border: 5px solid #3a3a5e ;
    box-shadow: 0 18px 45px rgba(0,0,0,0.25);
  }

  /* ===== Fix landing CSS overrides inside auth page ===== */

/* Stop global transitions from making elements "jump" */
.auth_page *,
.auth_page *::before,
.auth_page *::after{
  transition: none !important;
}

/* Cancel the template .form-group rules for auth forms */
.auth_page .auth_form .form-group{
  display: block !important;
  width: 100% !important;
  margin: 0 0 16px 0 !important;
  float: none !important;
}

/* Make remember + forgot align perfectly */
.auth_page .auth_form .d-flex{
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  gap: 12px !important;
}

.auth_page .auth_form .form-check{
  display: flex !important;
  align-items: center !important;
  gap: 8px !important;
  margin: 0 !important;
}

.auth_page .auth_form .form-check-input{
  margin-top: 0 !important;   /* يمنع نزول الـ checkbox */
}

.auth_page .auth_form .form-check-label{
  margin: 0 !important;
  line-height: 1.2 !important;
}

.auth_page .auth_form a.small{
  display: inline-block !important;
  white-space: nowrap !important;
  margin: 0 !important;
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
            <a href="{{ route('home') }}#top" class="auth_logo"><span>EasyPark</span></a>
            <p class="auth_subtitle text-center">Sign in to continue</p>
          </div>

          @if (session('status'))
            <div class="alert alert-success" role="alert">{{ session('status') }}</div>
          @endif

          @if ($errors->any())
            <div class="alert alert-danger" role="alert">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('login') }}" class="auth_form" novalidate>
            @csrf

            <div class="form-group">
              <input
                type="email"
                class="form-control"
                name="email"
                value="{{ old('email') }}"
                placeholder="Email"
                required
                autofocus
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
                autocomplete="current-password"
              >
            </div>

            <div class="d-flex align-items-center justify-content-between mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                <label class="form-check-label" for="remember_me">Remember me</label>
              </div>

              @if (Route::has('password.request'))
                <a class="small" href="{{ route('password.request') }}">Forgot password?</a>
              @endif
            </div>

            <button type="submit" class="btn auth_btn w-100">Login</button>

            <div class="text-center mt-3">
              <span class="small">Don't have an account?</span>
              <a class="small" href="{{ route('register') }}">Sign up</a>
            </div>
          </form>

          <div class="auth_back">
            <a href="{{ route('home') }}">&larr; Back to Landing</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('landing/js/jquery.min.js') }}"></script>
  <script src="{{ asset('landing/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
