<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ParkEasy | Login</title>
  
  <!-- Enhanced Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('landing/css/bootstrap.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('landing/css/style.css')); ?>">
  
  <style>
  :root {
    --primary: #3a3a5e;
    --primary-light: #4a4a7e;
    --primary-dark: #2a2a4e;
    --accent: #6366f1;
    --accent-glow: rgba(99, 102, 241, 0.3);
    --text-dark: #1a1a2e;
    --text-muted: #6b7280;
    --success: #10b981;
    --danger: #ef4444;
    --white: #ffffff;
    --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
    --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.12);
    --shadow-lg: 0 20px 50px rgba(0, 0, 0, 0.2);
    --shadow-glow: 0 0 40px var(--accent-glow);
  }

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body.auth_page {
    min-height: 100vh;
    overflow-x: hidden;
    font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
    position: relative;
  }

  /* Enhanced background with animated gradient overlay */
  .auth_bg {
    position: fixed;
    inset: 0;
    background-image: url("<?php echo e(asset('landing/images/login-bg.jpg')); ?>");
    background-size: cover;
    background-position: center;
    backg,vcround-repeat: no-repeat;
    \xnm. bb
    filter: blur(3px) brightness(0.85);
    z-index: 0;
  }

  .auth_bg::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, 
      rgba(58, 58, 94, 0.75) 0%, 
      rgba(99, 102, 241, 0.45) 50%,
      rgba(58, 58, 94, 0.75) 100%);
    animation: gradientShift 15s ease infinite;
  }

  @keyframes gradientShift {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.85; }
  }

  /* Floating particles effect */
  .auth_bg::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image: 
      radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
      radial-gradient(circle at 80% 70%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
      radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
    animation: particleFloat 20s ease-in-out infinite;
    z-index: 1;
  }

  @keyframes particleFloat {
    0%, 100% { transform: translateY(0) scale(1); }
    50% { transform: translateY(-20px) scale(1.05); }
  }

  .auth_page .container {
    position: relative;
    z-index: 2;
  }

  /* Enhanced card with glassmorphism */
  .auth_card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px) saturate(150%);
    border-radius: 24px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 
      var(--shadow-lg),
      0 0 0 1px rgba(99, 102, 241, 0.1),
      inset 0 1px 0 rgba(255, 255, 255, 0.8);
    padding: 48px 40px;
    position: relative;
    overflow: hidden;
    animation: cardFadeIn 0.6s ease-out;
  }

  @keyframes cardFadeIn {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Decorative elements */
  .auth_card::before {
    content: "";
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
    opacity: 0.3;
    animation: decorPulse 8s ease-in-out infinite;
  }

  @keyframes decorPulse {
    0%, 100% { transform: scale(1); opacity: 0.3; }
    50% { transform: scale(1.2); opacity: 0.5; }
  }

  /* Logo and branding */
  .auth_brand {
    margin-bottom: 32px;
    animation: brandSlideIn 0.8s ease-out 0.2s both;
  }
  
  .auth_brand .navbar-brand {
    margin-bottom: 4px !important;
  }

  @keyframes brandSlideIn {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .nav-link.navbar-brand {
    display: inline-block;
    margin-bottom: 8px !important;
    padding-bottom: 0 !important;
    transition: transform 0.3s ease;
  }

  .nav-link.navbar-brand:hover {
    transform: scale(1.05);
  }

  .nav-logo {
    max-height: 100px;
    width: auto;
    margin-bottom: 0 !important;
    filter: drop-shadow(0 4px 12px rgba(58, 58, 94, 0.2));
  }

  .auth_subtitle {
    font-family: 'DM Sans', sans-serif;
    font-size: 15px;
    font-weight: 500;
    color: var(--text-muted);
    margin-top: 4px !important;
    letter-spacing: 0.3px;
  }

  /* Alert styles */
  .alert {
    border-radius: 12px;
    border: none;
    padding: 14px 18px;
    margin-bottom: 24px;
    font-size: 14px;
    font-weight: 500;
    animation: alertSlideIn 0.4s ease-out;
  }

  @keyframes alertSlideIn {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .alert-success {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.05));
    color: var(--success);
    border-left: 4px solid var(--success);
  }

  .alert-danger {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05));
    color: var(--danger);
    border-left: 4px solid var(--danger);
  }

  .alert ul {
    margin-bottom: 0;
    padding-left: 20px;
  }

  /* Form styles */
  .auth_form {
    position: relative;
    z-index: 1;
  }

  .form-group {
    display: block !important;
    width: 100% !important;
    margin: 0 0 20px 0 !important;
    float: none !important;
    animation: formItemSlideIn 0.5s ease-out both;
  }

  .form-group:nth-child(1) { animation-delay: 0.3s; }
  .form-group:nth-child(2) { animation-delay: 0.4s; }

  @keyframes formItemSlideIn {
    from {
      opacity: 0;
      transform: translateX(-20px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  .form-control {
    height: 52px;
    padding: 12px 18px;
    font-size: 15px;
    font-family: 'DM Sans', sans-serif;
    font-weight: 500;
    color: var(--text-dark);
    background: rgba(248, 250, 252, 0.8);
    border: 2px solid rgba(203, 213, 225, 0.5);
    border-radius: 12px;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
  }

  .form-control::placeholder {
    color: var(--text-muted);
    font-weight: 400;
  }

  .form-control:focus {
    outline: none;
    background: rgba(255, 255, 255, 0.95);
    border-color: var(--accent);
    box-shadow: 
      0 0 0 4px var(--accent-glow),
      0 4px 12px rgba(0, 0, 0, 0.08);
    transform: translateY(-1px);
  }

  /* Remember me & Forgot password */
  .d-flex {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 12px !important;
    margin-bottom: 24px !important;
    animation: formItemSlideIn 0.5s ease-out 0.5s both;
  }

  .form-check {
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    margin: 0 !important;
  }

  .form-check-input {
    width: 18px;
    height: 18px;
    margin-top: 0 !important;
    border: 2px solid rgba(203, 213, 225, 0.8);
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .form-check-input:checked {
    background-color: var(--accent);
    border-color: var(--accent);
  }

  .form-check-input:focus {
    box-shadow: 0 0 0 3px var(--accent-glow);
  }

  .form-check-label {
    margin: 0 !important;
    line-height: 1.2 !important;
    font-size: 14px;
    font-weight: 500;
    color: var(--text-dark);
    cursor: pointer;
    user-select: none;
  }

  a.small {
    display: inline-block !important;
    white-space: nowrap !important;
    margin: 0 !important;
    font-size: 14px;
    font-weight: 600;
    color: var(--accent);
    text-decoration: none;
    position: relative;
    transition: all 0.3s ease;
  }

  a.small::after {
    content: "";
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: var(--accent);
    transition: width 0.3s ease;
  }

  a.small:hover {
    color: var(--primary);
  }

  a.small:hover::after {
    width: 100%;
  }

  /* Login button */
  .auth_btn {
    height: 52px;
    padding: 14px 32px;
    font-family: 'Outfit', sans-serif;
    font-size: 16px;
    font-weight: 600;
    letter-spacing: 0.5px;
    color: var(--white);
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    border: none;
    border-radius: 12px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    box-shadow: 
      var(--shadow-md),
      0 0 20px rgba(58, 58, 94, 0.3);
    transition: all 0.3s ease;
    animation: formItemSlideIn 0.5s ease-out 0.6s both;
  }

  .auth_btn::before {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: width 0.6s ease, height 0.6s ease;
  }

  .auth_btn:hover {
    transform: translateY(-2px);
    box-shadow: 
      var(--shadow-lg),
      0 0 30px rgba(58, 58, 94, 0.4);
    background: linear-gradient(135deg, var(--primary-light) 0%, var(--accent) 100%);
  }

  .auth_btn:hover::before {
    width: 300px;
    height: 300px;
  }

  .auth_btn:active {
    transform: translateY(0);
  }

  /* Sign up text */
  .text-center.mt-3 {
    margin-top: 24px !important;
    font-size: 14px;
    animation: formItemSlideIn 0.5s ease-out 0.7s both;
  }

  .text-center.mt-3 .small:first-child {
    color: var(--text-muted);
    font-weight: 500;
    margin-right: 6px;
  }

  .text-center.mt-3 a.small {
    font-weight: 700;
  }

  /* Back to landing */
  .auth_back {
    margin-top: 28px;
    text-align: center;
    animation: formItemSlideIn 0.5s ease-out 0.8s both;
  }

  .auth_back a {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
    font-weight: 600;
    color: var(--text-muted);
    text-decoration: none;
    padding: 8px 16px;
    border-radius: 8px;
    transition: all 0.3s ease;
  }

  .auth_back a:hover {
    color: var(--primary);
    background: rgba(58, 58, 94, 0.05);
    transform: translateX(-4px);
  }

  /* Responsive design */
  @media (max-width: 768px) {
    .auth_card {
      padding: 36px 28px;
      border-radius: 20px;
    }

    .nav-logo {
      max-height: 50px;
    }

    .form-control,
    .auth_btn {
      height: 48px;
    }

    .d-flex {
      flex-direction: column;
      align-items: flex-start !important;
      gap: 12px !important;
    }

    .form-check {
      width: 100%;
    }

    a.small {
      width: 100%;
      text-align: left;
    }
  }

  @media (max-width: 480px) {
    .auth_card {
      padding: 28px 20px;
    }

    .auth_subtitle {
      font-size: 14px;
    }

    .form-control {
      font-size: 14px;
    }
  }

  /* Disable problematic transitions from landing CSS */
  .auth_page *,
  .auth_page *::before,
  .auth_page *::after {
    transition-property: transform, opacity, background, color, border-color, box-shadow !important;
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
            <a class="nav-link navbar-brand" href="#top">
              <img src="<?php echo e(asset('landing/images/logo2.png')); ?>" alt="ParkIt Logo" class="nav-logo">
            </a>
            <p class="auth_subtitle">Sign in to continue</p>
          </div>

          <?php if(session('status')): ?>
            <div class="alert alert-success" role="alert"><?php echo e(session('status')); ?></div>
          <?php endif; ?>

          <?php if($errors->any()): ?>
            <div class="alert alert-danger" role="alert">
              <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </div>
          <?php endif; ?>

          <form method="POST" action="<?php echo e(route('login')); ?>" class="auth_form" novalidate>
            <?php echo csrf_field(); ?>

            <div class="form-group">
              <input
                type="email"
                class="form-control"
                name="email"
                value="<?php echo e(old('email')); ?>"
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

              <?php if(Route::has('password.request')): ?>
                <a class="small" href="<?php echo e(route('password.request')); ?>">Forgot password?</a>
              <?php endif; ?>
            </div>

            <button type="submit" class="btn auth_btn w-100">Login</button>

            <div class="text-center mt-3">
              <span class="small">Don't have an account?</span>
              <a class="small" href="<?php echo e(route('register')); ?>">Sign up</a>
            </div>
          </form>

          <div class="auth_back">
            <a href="<?php echo e(route('home')); ?>">&larr; Back to Landing</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="<?php echo e(asset('landing/js/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(asset('landing/js/bootstrap.bundle.min.js')); ?>"></script>
</body>
</html><?php /**PATH C:\Users\DELL\Downloads\Parking-Finder2-stage4-auth-flow\resources\views/auth/login.blade.php ENDPATH**/ ?>