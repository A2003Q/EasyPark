<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ParkIt | Choose Your Plan</title>

  <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}">
  <!-- font css -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body { 
      background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
      font-family: 'Poppins', sans-serif;
      min-height: 100vh;
    }

    /* Main Container */
    .user-page-wrap {
      padding: 40px 15px;
      max-width: 1200px;
      margin: 0 auto;
      padding-top: 100px;
    }

    /* Page Header */
    .page-header-section {
      text-align: center;
      margin-bottom: 50px;
      animation: fadeInDown 0.6s ease;
    }

    .pe-title { 
      color: #3a3a5e; 
      font-weight: 800; 
      font-size: 2.5rem;
      margin-bottom: 16px;
      line-height: 1.2;
    }

    .pe-subtitle {
      color: #6c6c86;
      font-size: 1.15rem;
      font-weight: 400;
      max-width: 700px;
      margin: 0 auto;
    }

    /* Plan Cards Container */
    .plans-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 30px;
      margin-bottom: 40px;
    }

    /* Plan Card */
    .plan-card {
      background: #fff;
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 10px 40px rgba(0,0,0,.08);
      border: 2px solid transparent;
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      position: relative;
      animation: fadeInUp 0.6s ease;
      height: 100%;
      display: flex;
      flex-direction: column;
    }

    .plan-card:hover {
      transform: translateY(-12px);
      box-shadow: 0 25px 60px rgba(0,0,0,.15);
      border-color: #87CEEB;
    }

    /* Premium Badge */
    .best-badge {
      position: absolute;
      top: 20px;
      right: 20px;
      background: linear-gradient(135deg, #87CEEB 0%, #87CEEB 100%);
      color: #fff;
      padding: 8px 16px;
      border-radius: 20px;
      font-weight: 800;
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 1px;
      box-shadow: 0 4px 15px #87CEEB ;
      z-index: 5;
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }

    /* Plan Top Section */
    .plan-top {
      padding: 40px 30px 30px;
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      position: relative;
      overflow: hidden;
    }

    .plan-top::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(135, 206, 235, 0.08) 0%, transparent 70%);
      animation: rotate 20s linear infinite;
    }

    @keyframes rotate {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    .plan-icon-wrapper {
      position: relative;
      z-index: 1;
    }

    .plan-icon {
      width: 70px;
      height: 70px;
      border-radius: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 32px;
      background: linear-gradient(135deg, #3a3a5e 0%, #2d2d4a 100%);
      color: #fff;
      box-shadow: 0 10px 30px rgba(58, 58, 94, 0.3);
      margin-bottom: 20px;
      transition: all 0.3s ease;
    }

    .plan-card:hover .plan-icon {
      transform: scale(1.1) rotate(5deg);
    }

    .plan-name {
      font-size: 28px;
      font-weight: 800;
      color: #3a3a5e;
      margin-bottom: 8px;
      position: relative;
      z-index: 1;
    }

    .plan-description {
      color: #6c6c86;
      font-size: 15px;
      font-weight: 500;
      position: relative;
      z-index: 1;
    }

    .plan-pricing {
      margin-top: 24px;
      position: relative;
      z-index: 1;
    }

    .plan-price {
      font-size: 48px;
      font-weight: 900;
      color: #3a3a5e;
      line-height: 1;
      display: flex;
      align-items: baseline;
      gap: 8px;
    }

    .plan-price .currency {
      font-size: 24px;
      font-weight: 700;
      color: #6c6c86;
    }

    .plan-unit {
      color: #6c6c86;
      font-weight: 600;
      font-size: 14px;
      margin-top: 6px;
    }

    /* Plan Body */
    .plan-body {
      padding: 30px;
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .features-list {
      flex: 1;
      margin-bottom: 24px;
    }

    .feat {
      display: flex;
      gap: 14px;
      align-items: flex-start;
      margin-bottom: 18px;
      animation: fadeIn 0.6s ease;
    }

    .feat-icon {
      width: 24px;
      height: 24px;
      border-radius: 50%;
      background: linear-gradient(135deg, #87CEEB 0%, #5dade2 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      margin-top: 2px;
      box-shadow: 0 4px 12px rgba(135, 206, 235, 0.3);
    }

    .feat-icon i {
      color: #fff;
      font-size: 12px;
    }

    .feat-content {
      flex: 1;
    }

    .feat-title {
      color: #3a3a5e;
      font-weight: 700;
      font-size: 15px;
      margin-bottom: 4px;
    }

    .feat-subtitle {
      color: #6c6c86;
      font-size: 13px;
      font-weight: 500;
      line-height: 1.5;
    }

    /* Subscribe Button */
    .pe-btn {
      background: linear-gradient(135deg, #3a3a5e 0%, #2d2d4a 100%);
      color: #fff;
      border: 0;
      border-radius: 14px;
      font-weight: 800;
      padding: 16px 24px;
      font-size: 16px;
      transition: all 0.3s ease;
      box-shadow: 0 6px 20px rgba(58, 58, 94, 0.3);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      width: 100%;
    }

    .pe-btn:hover {
      background: linear-gradient(135deg, #2d2d4a 0%, #1a1a2e 100%);
      color: #fff;
      transform: translateY(-3px);
      box-shadow: 0 10px 30px rgba(58, 58, 94, 0.4);
    }

    .pe-btn i {
      font-size: 18px;
    }

    /* Premium Plan Highlight */
    .plan-card.premium {
      border-color: #87CEEB;
      box-shadow: 0 15px 50px #87CEEB;
    }

    .plan-card.premium .plan-top {
      background: linear-gradient(135deg, #87CEEB 0%, #a9c6d2 100%);
    }

    .plan-card.premium .plan-icon {
      background: linear-gradient(135deg, #87CEEB 0%, #87CEEB 100%);
      box-shadow: 0 10px 30px #87CEEB;
    }

    /* Info Card */
    .info-card {
      background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
      border: 2px solid #87CEEB;
      border-radius: 20px;
      padding: 24px 30px;
      display: flex;
      align-items: center;
      gap: 16px;
      animation: fadeIn 0.6s ease;
      box-shadow: 0 6px 20px rgba(135, 206, 235, 0.2);
    }

    .info-card-icon {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .info-card-icon i {
      color: #87CEEB;
      font-size: 24px;
    }

    .info-card-text {
      color: #3a3a5e;
      font-weight: 600;
      font-size: 15px;
      line-height: 1.6;
    }

    /* Animations */
    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    /* Responsive */
    @media (max-width: 768px) {
      .pe-title {
        font-size: 2rem;
      }

      .pe-subtitle {
        font-size: 1rem;
      }

      .plans-container {
        grid-template-columns: 1fr;
        gap: 24px;
      }

      .plan-top {
        padding: 30px 24px 24px;
      }

      .plan-body {
        padding: 24px;
      }

      .plan-price {
        font-size: 40px;
      }

      .info-card {
        flex-direction: column;
        text-align: center;
        padding: 20px;
      }
    }

    @media (max-width: 576px) {
      .user-page-wrap {
        padding: 30px 15px;
      
      }

      .pe-title {
        font-size: 1.75rem;
      }

      .plan-name {
        font-size: 24px;
      }

      .plan-price {
        font-size: 36px;
      }
    }

    /* Staggered Animation */
    .plan-card:nth-child(1) {
      animation-delay: 0.1s;
    }

    .plan-card:nth-child(2) {
      animation-delay: 0.2s;
    }

    .feat:nth-child(1) { animation-delay: 0.1s; }
    .feat:nth-child(2) { animation-delay: 0.2s; }
    .feat:nth-child(3) { animation-delay: 0.3s; }
  </style>
</head>
<body>

@include('user.partials.nav')

<div class="container user-page-wrap">
  <!-- Page Header -->
  <div class="page-header-section">
    <h1 class="pe-title">
      <i class="fas fa-crown" style="color: #87CEEB;"></i>
      Choose Your Perfect Plan
    </h1>
    <p class="pe-subtitle">
      Subscription is required before reserving. Pick the plan that matches your parking needs and enjoy hassle-free parking.
    </p>
  </div>

  <!-- Plans Grid -->
  <div class="plans-container">
    <!-- BASIC PLAN -->
    <div class="plan-card">
      <div class="plan-top">
        <div class="plan-icon-wrapper">
          <div class="plan-icon">
            <i class="fas fa-clock"></i>
          </div>
          <div class="plan-name">Basic</div>
          <div class="plan-description">Best for daily short parking</div>
        </div>

        <div class="plan-pricing">
          <div class="plan-price">
            10
            <span class="currency">JOD</span>
          </div>
          <div class="plan-unit">per month</div>
        </div>
      </div>

      <div class="plan-body">
        <div class="features-list">
          <div class="feat">
            <div class="feat-icon">
              <i class="fas fa-check"></i>
            </div>
            <div class="feat-content">
              <div class="feat-title">Hourly Reservations</div>
              <div class="feat-subtitle">Reserve parking spots by the hour</div>
            </div>
          </div>

          <div class="feat">
            <div class="feat-icon">
              <i class="fas fa-check"></i>
            </div>
            <div class="feat-content">
              <div class="feat-title">Smart Availability</div>
              <div class="feat-subtitle">See available/reserved status instantly</div>
            </div>
          </div>

          <div class="feat">
            <div class="feat-icon">
              <i class="fas fa-times"></i>
            </div>
            <div class="feat-content">
              <div class="feat-title">No Daily Booking</div>
              <div class="feat-subtitle">Daily reservations not included</div>
            </div>
          </div>
        </div>

        <form method="POST" action="{{ route('user.subscriptions.store') }}">
          @csrf
          <input type="hidden" name="plan" value="basic">
          <button class="pe-btn" type="submit">
            <i class="fas fa-rocket"></i>
            Subscribe to Basic
          </button>
        </form>
      </div>
    </div>

    <!-- PREMIUM PLAN -->
    <div class="plan-card premium">
      <span class="best-badge">
        <i class="fas fa-star"></i> BEST VALUE
      </span>

      <div class="plan-top">
        <div class="plan-icon-wrapper">
          <div class="plan-icon">
            <i class="fas fa-gem"></i>
          </div>
          <div class="plan-name">Premium</div>
          <div class="plan-description">For long stays & frequent users</div>
        </div>

        <div class="plan-pricing">
          <div class="plan-price">
            25
            <span class="currency">JOD</span>
          </div>
          <div class="plan-unit">per month</div>
        </div>
      </div>

      <div class="plan-body">
        <div class="features-list">
          <div class="feat">
            <div class="feat-icon">
              <i class="fas fa-check"></i>
            </div>
            <div class="feat-content">
              <div class="feat-title">Hourly + Daily Reservations</div>
              <div class="feat-subtitle">Reserve by hours or full days</div>
            </div>
          </div>

          <div class="feat">
            <div class="feat-icon">
              <i class="fas fa-check"></i>
            </div>
            <div class="feat-content">
              <div class="feat-title">Priority Experience</div>
              <div class="feat-subtitle">Better flexibility for busy areas</div>
            </div>
          </div>

          <div class="feat">
            <div class="feat-icon">
              <i class="fas fa-check"></i>
            </div>
            <div class="feat-content">
              <div class="feat-title">All Basic Features</div>
              <div class="feat-subtitle">Everything included in Basic plan</div>
            </div>
          </div>
        </div>

        <form method="POST" action="{{ route('user.subscriptions.store') }}">
          @csrf
          <input type="hidden" name="plan" value="premium">
          <button class="pe-btn" type="submit">
            <i class="fas fa-crown"></i>
            Subscribe to Premium
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Info Card -->
  <div class="info-card">
    <div class="info-card-icon">
      <i class="fas fa-info-circle"></i>
    </div>
    <div class="info-card-text">
      After subscribing, you'll be automatically redirected back to continue your reservation. Your subscription will be active immediately.
    </div>
  </div>
</div>

@if(session('success'))
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: @json(session('success')),
      confirmButtonColor: '#87CEEB',
      timer: 3000
    });
  </script>
@endif

@if(session('error'))
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Oops!',
      text: @json(session('error')),
      confirmButtonColor: '#3a3a5e'
    });
  </script>
@endif

<script src="{{ asset('landing/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>


