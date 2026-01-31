<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ParkIt | <?php echo e($parking->name); ?></title>

  <link rel="stylesheet" href="<?php echo e(asset('landing/css/bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('landing/css/style.css')); ?>">
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

    /* Main Content */
    .user-page-wrap {
      padding: 40px 15px;
      max-width: 1400px;
      margin: 0 auto;
      padding-top: 100px;
    }

    /* Page Header with Gradient */
    .page-header-details {
      background: linear-gradient(135deg, #3a3a5e 0%, #2d2d4a 100%);
      border-radius: 20px;
      padding: 30px;
      margin-bottom: 30px;
      box-shadow: 0 20px 60px rgba(58, 58, 94, 0.3);
      animation: fadeInDown 0.6s ease;
      position: relative;
      overflow: hidden;
    }

    .page-header-details::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(135, 206, 235, 0.1) 0%, transparent 70%);
      animation: rotate 20s linear infinite;
    }

    .pe-title { 
      color: #fff; 
      font-weight: 800; 
      font-size: 2rem;
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      gap: 12px;
      position: relative;
      z-index: 1;
    }

    .pe-title i {
      color: #fff;
      font-size: 1.8rem;
    }

    .pe-muted { 
      color: rgba(255, 255, 255, 0.9);
      font-size: 1rem;
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 8px;
      position: relative;
      z-index: 1;
    }

    .pe-muted i {
      color: #fff;
      font-size: 14px;
    }

    .price-highlight {
      background-color: #fff;
      color: #3a3a5e ;
      padding: 10px 18px;
      border-radius: 12px;
      font-weight: 700;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      margin-top: 12px;
      box-shadow: 0 4px 15px rgba(135, 206, 235, 0.4);
      position: relative;
      z-index: 1;
    }

    .pe-btn-outline-white { 
      background: rgba(255, 255, 255, 0.15); 
      color: #fff; 
      border: 2px solid rgba(255, 255, 255, 0.5); 
      border-radius: 12px; 
      font-weight: 700;
      padding: 10px 24px;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      backdrop-filter: blur(10px);
      position: relative;
      z-index: 1;
    }

    .pe-btn-outline-white:hover { 
      background: rgba(255, 255, 255, 0.25); 
      color: #fff;
      border-color: rgba(255, 255, 255, 0.8);
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
    }

    .pe-card { 
      background: #3a3a5e; 
      border-radius: 20px; 
      overflow: hidden; 
      box-shadow: 0 10px 40px rgba(0,0,0,.08);
      border: none;
      animation: fadeInUp 0.6s ease;
      margin-bottom: 30px;
    }

    .parking-image-wrapper {
      position: relative;
      overflow: hidden;
      border-radius: 16px;
      height: 260px;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .parking-image-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .parking-image-wrapper:hover img {
      transform: scale(1.1);
    }

    .image-overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
      padding: 20px;
      color: #fff;
    }

    /* Enhanced Buttons */
    .pe-btn { 
      background: linear-gradient(135deg, #9595c3 0%, #3a3a5e 100%);
      color: #fff; 
      border: 0; 
      border-radius: 12px; 
      font-weight: 700;
      padding: 12px 28px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(135, 206, 235, 0.4);
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .pe-btn:hover { 
      background: linear-gradient(135deg, #5dade2 0%, #3498db 100%);
      color: #fff;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(135, 206, 235, 0.5);
    }

    .pe-btn-outline { 
      background: #fff; 
      color: #3a3a5e; 
      border: 2px solid #3a3a5e; 
      border-radius: 12px; 
      font-weight: 700;
      padding: 10px 24px;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .pe-btn-outline:hover { 
      background: #3a3a5e; 
      color: #fff;
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(58, 58, 94, 0.3);
    }

    /* Stats Cards */
    .stats-container {
      display: flex;
      gap: 16px;
      flex-wrap: wrap;
      margin-top: 20px;
    }

    .stat-card {
      flex: 1;
      min-width: 140px;
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      padding: 20px;
      border-radius: 16px;
      text-align: center;
      border: 2px solid #fff;
      transition: all 0.3s ease;
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0,0,0,.1);
    }

    .stat-card.available {
       background-color: #3a3a5e;
       border-color: #3a3a5e;
    }

    .stat-card.reserved {
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      border-color: #3a3a5e;
    }

    .stat-icon {
      font-size: 32px;
      margin-bottom: 10px;
    }

    .stat-card.available .stat-icon {
      color: #3a3a5e;
    }

    .stat-card.reserved .stat-icon {
      color: #3a3a5e;
    }

    .stat-number {
      font-size: 32px;
      font-weight: 800;
      color: #3a3a5e;
      line-height: 1;
      margin-bottom: 8px;
    }

    .stat-label {
      font-size: 14px;
      color: #3a3a5e;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    /* Info Alert */
    .info-alert {
      background: linear-gradient(135deg, #ffffff 0%, #f1f3f5 100%);
      border: 2px solid #3a3a5e;
      border-radius: 16px;
      padding: 16px 20px;
      margin-top: 20px;
      display: flex;
      align-items: center;
      gap: 12px;
      animation: fadeIn 0.6s ease;
    }

    .info-alert i {
      color: #3a3a5e;
      font-size: 24px;
    }

    .info-alert-text {
      color: #3a3a5e;
      font-weight: 600;
      font-size: 15px;
    }

    /* Enhanced Pills */
    .pe-pill { 
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px; 
      border-radius: 20px; 
      font-weight: 700; 
      font-size: 12px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      box-shadow: 0 2px 10px rgba(0,0,0,.1);
      margin-right: 10px;
    }

    .pe-pill-ava { 
      background: linear-gradient(135deg, #9595c3 0%, #3a3a5e 100%);
      color: #fff;
    }

    .pe-pill-busy { 
      background: linear-gradient(135deg, #bdbdbd 0%, #9e9e9e 100%);
      color: #fff;
    }

    /* Spots Grid - Enhanced Taxi Design */
    .spots-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
      gap: 20px;
      padding: 30px;
    }

    .spot-taxi {
      background: #fff;
      border: 3px solid #e0e0e0;
      border-radius: 18px;
      padding: 20px 16px;
      cursor: pointer;
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      position: relative;
      overflow: hidden;
      text-align: center;
    }

    .spot-taxi::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: transparent;
      transition: all 0.3s ease;
    }

    .spot-taxi:hover {
      transform: translateY(-8px) scale(1.02);
      box-shadow: 0 15px 40px rgba(0,0,0,.15);
    }

    /* Car Icon Styling */
    .car-icon-wrap {
      margin: 16px 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 80px;
    }

    .car-icon {
      font-size: 52px;
      transition: all 0.3s ease;
    }

    .spot-taxi:hover .car-icon {
      transform: scale(1.15);
    }

    /* Available State */
    .spot-taxi.available {
      border-color: #3a3a5e;
      background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 100%);
    }

    .spot-taxi.available::before {
      background: linear-gradient(90deg, #87CEEB 0%, #5dade2 100%);
    }

    .spot-taxi.available:hover {
      border-color: #5dade2;
      box-shadow: 0 15px 50px rgba(135, 206, 235, 0.4);
    }

    .spot-taxi.available .car-icon {
      color: #3a3a5e;
    }

    /* Reserved State */
    .spot-taxi.reserved {
      border-color: #bdbdbd;
      background: linear-gradient(135deg, #fafafa 0%, #f5f5f5 100%);
      opacity: 0.7;
      cursor: not-allowed;
    }

    .spot-taxi.reserved::before {
      background: linear-gradient(90deg, #bdbdbd 0%, #9e9e9e 100%);
    }

    .spot-taxi.reserved .car-icon {
      color: #9e9e9e;
    }

    .spot-taxi.reserved:hover {
      transform: none;
      box-shadow: none;
    }

    .spot-taxi.reserved:hover .car-icon {
      transform: scale(1);
    }

    /* Mine State */
    .spot-taxi.mine {
      border-color: #3a3a5e;
      background: linear-gradient(135deg, #ffffff 0%, #e8e8f5 100%);
    }

    .spot-taxi.mine::before {
      background: linear-gradient(90deg, #3a3a5e 0%, #2d2d4a 100%);
    }

    .spot-taxi.mine:hover {
      border-color: #2d2d4a;
      box-shadow: 0 15px 50px rgba(58, 58, 94, 0.3);
    }

    .spot-taxi.mine .car-icon {
      color: #3a3a5e;
    }

    /* Spot Elements */
    .spot-num {
      font-size: 20px;
      font-weight: 800;
      color: #3a3a5e;
      margin-bottom: 12px;
    }

    .taxi-svg-wrap {
      margin: 12px 0;
      display: flex;
      justify-content: center;
    }

    .taxi-svg {
      width: 100%;
      max-width: 120px;
      height: auto;
      transition: transform 0.3s ease;
    }

    .spot-taxi:hover .taxi-svg {
      transform: scale(1.1);
    }

    .spot-status {
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: #6c6c86;
      margin-top: 8px;
    }

    .spot-taxi.available .spot-status {
      color: #5dade2;
    }

    .spot-taxi.mine .spot-status {
      color: #3a3a5e;
    }

    /* Legend */
    .taxi-legend {
      display: flex;
      justify-content: center;
      gap: 30px;
      flex-wrap: wrap;
      margin-top: 30px;
      padding: 20px;
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      border-radius: 16px;
    }

    .legend-item {
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 600;
      color: #3a3a5e;
      font-size: 14px;
    }

    .legend-mini {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      border: 3px solid #e0e0e0;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    .legend-mini::before {
      content: '';
      width: 20px;
      height: 20px;
      border-radius: 4px;
    }

    .legend-mini.available {
      border-color: #87CEEB;
      background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 100%);
    }

    .legend-mini.available::before {
      background: #87CEEB;
    }

    .legend-mini.reserved {
      border-color: #bdbdbd;
      background: linear-gradient(135deg, #fafafa 0%, #f5f5f5 100%);
    }

    .legend-mini.reserved::before {
      background: #9e9e9e;
    }

    .legend-mini.mine {
      border-color: #3a3a5e;
      background: linear-gradient(135deg, #ffffff 0%, #e8e8f5 100%);
    }

    .legend-mini.mine::before {
      background: #3a3a5e;
    }

    .legend-item:hover .legend-mini {
      transform: scale(1.1);
    }

    /* Enhanced Modal */
    .modal-backdrop.show { 
      opacity: .75; 
      backdrop-filter: blur(5px);
    }

    .modal-content { 
      border-radius: 20px; 
      border: 0; 
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(0,0,0,.3);
    }

    .taxi-modal-header {
      background: linear-gradient(135deg, #3a3a5e 0%, #2d2d4a 100%);
      color: #fff;
      padding: 24px 30px;
      border: none;
    }

    .modal-title {
      font-weight: 800;
      font-size: 1.5rem;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .modal-title i {
      color: #87CEEB;
    }

    .taxi-modal-body {
      padding: 35px 30px;
      background: #fff;
    }

    .taxi-modal-status {
      margin: 20px 0;
    }

    .taxi-badge {
      padding: 12px 24px;
      border-radius: 20px;
      font-size: 14px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 1px;
      box-shadow: 0 4px 15px rgba(0,0,0,.1);
    }

    .modal-body hr {
      border-color: #e0e0e0;
      opacity: 0.3;
    }

    .modal-body .pe-muted {
      font-size: 14px;
      justify-content: center;
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
      .spots-grid {
        grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
        gap: 15px;
        padding: 20px;
      }

      .pe-title {
        font-size: 1.5rem;
      }

      .stats-container {
        flex-direction: column;
      }

      .stat-card {
        min-width: 100%;
      }

      .taxi-legend {
        flex-direction: column;
        gap: 15px;
      }

      .page-header-details {
        padding: 20px;
      }
    }

    @media (max-width: 576px) {
      .spots-grid {
        grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
        gap: 12px;
        padding: 15px;
      }

      .spot-num {
        font-size: 16px;
      }

      .taxi-svg {
        max-width: 90px;
      }
    }

    /* Loading State */
    .loading-spots {
      text-align: center;
      padding: 60px 20px;
    }

    .loading-spots i {
      font-size: 60px;
      color: #87CEEB;
      animation: spin 2s linear infinite;
    }

    @keyframes spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }
  </style>
</head>
<body>

<?php
  $sub = auth()->check() ? auth()->user()->subscriptions()->latest()->first() : null;
?>

<?php echo $__env->make('landing.partials.nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container user-page-wrap">
  <!-- Enhanced Page Header with Gradient -->
  <div class="page-header-details">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
      <div>
        <h2 class="pe-title">
          <i class="fas fa-parking"></i>
          <?php echo e($parking->name); ?>

        </h2>
        <div class="pe-muted">
          <i class="fas fa-map-marker-alt"></i>
          <?php echo e(optional($parking->city)->name); ?> • <?php echo e($parking->address); ?>

        </div>
        <div class="price-highlight">
          <i class="fas fa-tag"></i>
          <?php echo e($parking->price_per_hour); ?> JOD / hour
        </div>
      </div>
      <a href="<?php echo e(route('user.parkings.index')); ?>" class="btn pe-btn-outline-white">
        <i class="fas fa-arrow-left"></i>
        Back to Parkings
      </a>
    </div>
  </div>

  <!-- Enhanced Info Card -->
  <div class="pe-card p-4">
    <div class="row g-4 align-items-center">
      <div class="col-md-5">
        <div class="parking-image-wrapper">
          <img src="<?php echo e($parking->image_url ? $parking->image_url : asset('landing/images/img-5.png')); ?>"
               alt="parking">
        </div>
      </div>
      <div class="col-md-7">
        <div class="stats-container">
          <div class="stat-card available">
            <div class="stat-icon">
              <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-number"><?php echo e($parking->spots->where('status','available')->count()); ?></div>
            <div class="stat-label">Available</div>
          </div>
          <div class="stat-card reserved">
            <div class="stat-icon">
              <i class="fas fa-lock"></i>
            </div>
            <div class="stat-number"><?php echo e($parking->spots->where('status','reserved')->count()); ?></div>
            <div class="stat-label">Reserved</div>
          </div>
        </div>
        
        <div class="info-alert">
          <i class="fas fa-info-circle"></i>
          <div class="info-alert-text">
            Click on any available spot below to view details and make a reservation
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Enhanced Spots Grid -->
  <div class="pe-card">
    <div class="spots-grid">
      <?php $__currentLoopData = $parking->spots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $res = $activeReservations->get($s->id);
          $isReservedByAdmin = ($s->status === 'reserved');
          $isActive = $isReservedByAdmin || (bool)$res;
          $isMine = (bool)$res && auth()->check() && (($res->user_id ?? null) === auth()->id());
          $statusText = $isMine ? 'Reserved by you' : ($isActive ? 'Reserved' : 'Available');
          $cardClass = $isMine ? 'spot-taxi mine' : ($isActive ? 'spot-taxi reserved' : 'spot-taxi available');
          $disableBtn = $isActive && !$isMine;
        ?>

        <button type="button"
          class="<?php echo e($cardClass); ?>"
          data-spot-id="<?php echo e($s->id); ?>"
          data-spot-number="<?php echo e($s->spot_number); ?>"
          data-status="<?php echo e($statusText); ?>"
          data-res-start="<?php echo e($res?->start_time); ?>"
          data-res-end="<?php echo e($res?->end_time); ?>"
          onclick="openSpot(this)"
          <?php if($disableBtn): ?> disabled <?php endif; ?>
        >
          <div class="spot-num">#<?php echo e($s->spot_number); ?></div>

          <div class="car-icon-wrap">
            <i class="fas fa-car car-icon"></i>
          </div>

          <div class="spot-status"><?php echo e($statusText); ?></div>
        </button>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="taxi-legend">
      <div class="legend-item">
        <span class="legend-mini available"></span> 
        Available Spots
      </div>
      <div class="legend-item">
        <span class="legend-mini reserved"></span> 
        Reserved Spots
      </div>
      <div class="legend-item">
        <span class="legend-mini mine"></span> 
        Your Reservations
      </div>
    </div>
  </div>
</div>

<!-- Enhanced Modal -->
<div class="modal fade" id="spotModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content taxi-modal">
      <div class="modal-header taxi-modal-header">
        <h5 class="modal-title" id="spotTitle">
          <i class="fas fa-parking"></i>
          Spot Details
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body taxi-modal-body text-center">
        <div class="taxi-modal-status mt-3">
          <span class="badge taxi-badge" id="spotStatus">Available</span>
        </div>

        <p class="pe-muted mt-3 mb-0" id="spotTime"></p>
        <hr class="my-4">

        <?php if(auth()->guard()->guest()): ?>
          <a href="<?php echo e(route('login')); ?>" class="btn pe-btn w-100 mb-3">
            <i class="fas fa-sign-in-alt"></i>
            Login to Reserve
          </a>
          <div class="pe-muted" style="font-size:14px;">
            Don't have an account?
            <a href="<?php echo e(route('register')); ?>" style="font-weight:800;color:#3a3a5e;text-decoration:none;">
              <i class="fas fa-user-plus"></i> Sign up here
            </a>
          </div>
        <?php endif; ?>

        <?php if(auth()->guard()->check()): ?>
          <form id="reserveForm" method="POST" action="<?php echo e(route('user.reservations.store')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="parking_id" value="<?php echo e($parking->id); ?>">
            <input type="hidden" name="spot_id" id="spotIdInput" required>
            <input type="hidden" name="unit" value="hours">
            <input type="hidden" name="value" value="1">
            <button type="submit" class="btn pe-btn w-100">
              <i class="fas fa-check-circle"></i>
              Reserve This Spot
            </button>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php if(session('success')): ?>
  <script>
    Swal.fire({
      icon:'success', 
      title:'Success!', 
      text:<?php echo json_encode(session('success'), 15, 512) ?>,
      confirmButtonColor: '#87CEEB',
      timer: 3000
    });
  </script>
<?php endif; ?>
<?php if(session('error')): ?>
  <script>
    Swal.fire({
      icon:'error', 
      title:'Oops!', 
      text:<?php echo json_encode(session('error'), 15, 512) ?>,
      confirmButtonColor: '#3a3a5e'
    });
  </script>
<?php endif; ?>

<script src="<?php echo e(asset('landing/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('landing/js/bootstrap.bundle.min.js')); ?>"></script>

<script>
  const IS_AUTH = <?php echo json_encode(auth()->check(), 15, 512) ?>;

  const modalEl = document.getElementById('spotModal');
  const spotModal = new bootstrap.Modal(modalEl);

  function openSpot(el){
    const spotId = el.dataset.spotId || '';
    const spotIdInput = document.getElementById('spotIdInput');
    if (spotIdInput) spotIdInput.value = spotId;

    const spotNumber = el.dataset.spotNumber || '';
    const status = el.dataset.status || '';
    const start = el.dataset.resStart || '';
    const end = el.dataset.resEnd || '';

    document.getElementById('spotTitle').innerHTML = `<i class="fas fa-parking"></i> Spot #${spotNumber}`;

    const badge = document.getElementById('spotStatus');
    badge.textContent = status || 'Unknown';

    if ((status || '').includes('Available')) {
      badge.style.background = 'linear-gradient(135deg, #87CEEB 0%, #5dade2 100%)';
      badge.style.color = '#fff';
    } else if ((status || '').includes('by you')) {
      badge.style.background = 'linear-gradient(135deg, #3a3a5e 0%, #2d2d4a 100%)';
      badge.style.color = '#fff';
    } else {
      badge.style.background = 'linear-gradient(135deg, #bdbdbd 0%, #9e9e9e 100%)';
      badge.style.color = '#fff';
    }

    const timeEl = document.getElementById('spotTime');
    if (start && end) {
      timeEl.innerHTML = `<i class="fas fa-clock"></i> Reserved from ${start} to ${end}`;
    } else {
      timeEl.innerHTML = (status.includes('Available')) ? '<i class="fas fa-check-circle"></i> Available now - Ready to reserve!' : '';
    }

    const reserveForm = document.getElementById('reserveForm');
    const isReserved = status.includes('Reserved');
    if (reserveForm) {
      reserveForm.style.display = (!isReserved) ? 'block' : 'none';
    }

    spotModal.show();
  }

  // Add animation on page load
  document.addEventListener('DOMContentLoaded', function() {
    const spots = document.querySelectorAll('.spot-taxi');
    spots.forEach((spot, index) => {
      spot.style.animation = `fadeInUp 0.6s ease ${index * 0.03}s`;
      spot.style.animationFillMode = 'both';
    });
  });
</script>

</body>
</html>
<?php /**PATH C:\Users\DELL\Downloads\Parking-Finder2-stage4-auth-flow\resources\views/user/parkings/show.blade.php ENDPATH**/ ?>