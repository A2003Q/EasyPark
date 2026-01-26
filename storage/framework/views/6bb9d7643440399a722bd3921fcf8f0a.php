<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ParkEasy | Subscriptions</title>

  <link rel="stylesheet" href="<?php echo e(asset('landing/css/bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('landing/css/style.css')); ?>">
        <!-- font css -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body{ background:#f7f7fb; }
    .pe-title{ color:#3a3a5e; font-weight:900; }
    .pe-muted{ color:#6c6c86; }
    .plan-card{
      background:#fff;
      border-radius:18px;
      border:1px solid #eee;
      box-shadow:0 14px 40px rgba(0,0,0,.08);
      overflow:hidden;
      height:100%;
    }
    .plan-top{
      padding:18px 18px 10px;
      background:linear-gradient(135deg, rgba(58,58,94,.12), rgba(221,221,221,.15));
    }
    .plan-icon{
      width:54px; height:54px; border-radius:16px;
      display:flex; align-items:center; justify-content:center;
      font-size:26px; font-weight:900;
      background:#3a3a5e; color:#fff;
      box-shadow:0 10px 24px rgba(0,0,0,.10);
    }
    .plan-name{ font-size:20px; font-weight:900; color:#3a3a5e; }
    .plan-price{ font-size:34px; font-weight:900; color:#3a3a5e; line-height:1; }
    .plan-unit{ color:#6c6c86; font-weight:700; }
    .plan-body{ padding:18px; }
    .feat{ display:flex; gap:10px; align-items:flex-start; margin-bottom:10px; }
    .feat .dot{
      width:10px; height:10px; border-radius:50%;
      background:#3a3a5e; margin-top:6px;
    }
    .feat .txt{ color:#333; font-weight:700; }
    .feat .sub{ color:#6c6c86; font-size:13px; font-weight:600; margin-top:2px; }
    .pe-btn{
      background:#3a3a5e; color:#fff; border:0;
      border-radius:12px; font-weight:900;
      padding:12px 14px;
    }
    .pe-btn:hover{ background:#2f2f4f; color:#fff; }
    .badge-best{
      background:#3a3a5e; color:#fff;
      border-radius:999px; padding:6px 10px;
      font-weight:900; font-size:12px;
    }
  </style>
</head>
<body>
  <?php if(session('pending_reservation')): ?>
  <div class="alert alert-success">Pending reservation موجود ✅</div>
<?php else: ?>
  <div class="alert alert-danger">Pending reservation مش موجود ❌</div>
<?php endif; ?>

<?php echo $__env->make('user.partials.nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container user-page-wrap">
  <div class="row mb-4">
    <div class="col-md-8">
      <h2 class="pe-title mb-1">Choose Your Plan</h2>
      <p class="pe-muted mb-0">Subscription is required before reserving. Pick the plan that matches your parking needs.</p>
    </div>
  </div>

  <?php if(session('success')): ?>
    <script>Swal.fire({icon:'success', title:'Success', text:<?php echo json_encode(session('success'), 15, 512) ?>});</script>
  <?php endif; ?>
  <?php if(session('error')): ?>
    <script>Swal.fire({icon:'error', title:'Oops', text:<?php echo json_encode(session('error'), 15, 512) ?>});</script>
  <?php endif; ?>




  <div class="row g-4">
    
    <div class="col-md-6">
      <div class="plan-card">
        <div class="plan-top">
          <div class="d-flex justify-content-between align-items-start">
            <div class="d-flex gap-3 align-items-center">
              <div class="plan-icon">🕒</div>
              <div>
                <div class="plan-name">Basic</div>
                <div class="pe-muted">Best for daily short parking</div>
              </div>
            </div>
          </div>

          <div class="mt-3">
            <div class="plan-price">10<span class="fs-5">JOD</span></div>
            <div class="plan-unit">per month</div>
          </div>
        </div>

        <div class="plan-body">
          <div class="feat"><div class="dot"></div><div><div class="txt">Hourly reservations</div><div class="sub">Reserve spots by hours</div></div></div>
          <div class="feat"><div class="dot"></div><div><div class="txt">Smart availability</div><div class="sub">See available/reserved status instantly</div></div></div>
          <div class="feat"><div class="dot"></div><div><div class="txt">No day booking</div><div class="sub">Daily reservations are not included</div></div></div>

          <form method="POST" action="<?php echo e(route('user.subscriptions.store')); ?>" class="mt-3">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="plan" value="basic">
            <button class="pe-btn w-100" type="submit">Subscribe Basic</button>
          </form>
        </div>
      </div>
    </div>

    
    <div class="col-md-6">
      <div class="plan-card">
        <div class="plan-top">
          <div class="d-flex justify-content-between align-items-start">
            <div class="d-flex gap-3 align-items-center">
              <div class="plan-icon">⭐</div>
              <div>
                <div class="plan-name">Premium</div>
                <div class="pe-muted">For long stays & frequent users</div>
              </div>
            </div>
            <span class="badge-best">BEST</span>
          </div>

          <div class="mt-3">
            <div class="plan-price">25<span class="fs-5">JOD</span></div>
            <div class="plan-unit">per month</div>
          </div>
        </div>

        <div class="plan-body">
          <div class="feat"><div class="dot"></div><div><div class="txt">Hourly + Daily reservations</div><div class="sub">Reserve by hours or days</div></div></div>
          <div class="feat"><div class="dot"></div><div><div class="txt">Priority experience</div><div class="sub">Better flexibility for busy areas</div></div></div>
          <div class="feat"><div class="dot"></div><div><div class="txt">All Basic features</div><div class="sub">Everything included in Basic</div></div></div>

          <form method="POST" action="<?php echo e(route('user.subscriptions.store')); ?>" class="mt-3">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="plan" value="premium">
            <button class="pe-btn w-100" type="submit">Subscribe Premium</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="pe-card p-3 mt-4" style="border-radius:16px;">
    <div class="pe-muted" style="font-weight:700;">
      After subscribing, you’ll be redirected back to continue your reservation.
    </div>
  </div>
</div>

<script src="<?php echo e(asset('landing/js/bootstrap.bundle.min.js')); ?>"></script>
</body>
</html>


<?php /**PATH C:\Users\DELL\Downloads\Parking-Finder2-stage4-auth-flow\resources\views/user/subscriptions/index.blade.php ENDPATH**/ ?>