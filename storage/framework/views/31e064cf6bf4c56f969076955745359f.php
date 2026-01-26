<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ParkEasy | <?php echo e($parking->name); ?></title>

  <link rel="stylesheet" href="<?php echo e(asset('landing/css/bootstrap.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('landing/css/style.css')); ?>">
        <!-- font css -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body { background:#f7f7fb; }
    .pe-title{ color:#3a3a5e; font-weight:800; }
    .pe-muted{ color:#6c6c86; }
    .pe-card{ background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 14px 40px rgba(0,0,0,.08); border:1px solid #eee; }
    .pe-btn{ background:#3a3a5e; color:#fff; border:0; border-radius:10px; font-weight:700; }
    .pe-btn:hover{ background:#2f2f4f; color:#fff; }
    .pe-btn-outline{ background:#fff; color:#3a3a5e; border:2px solid #3a3a5e; border-radius:10px; font-weight:800; }
    .pe-btn-outline:hover{ background:#ddd; color:#3a3a5e; }
    .pe-pill{ display:inline-block; padding:6px 10px; border-radius:999px; font-weight:800; font-size:12px; }
    .pe-pill-ava{ background:#ddd; color:#3a3a5e; }
    .pe-pill-busy{ background:#bdbdbd; color:#3a3a5e; }
    .modal-backdrop.show{ opacity:.75; }
    .modal-content{ border-radius:18px; border:0; overflow:hidden; }
    .modal-header{ background:#3a3a5e; color:#fff; }
  </style>
</head>
<body>

<?php
  $sub = auth()->check() ? auth()->user()->subscriptions()->latest()->first() : null;
?>

<?php echo $__env->make('user.partials.nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container user-page-wrap">
  <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
    <div>
      <h2 class="pe-title mb-1"><?php echo e($parking->name); ?></h2>
      <div class="pe-muted"><?php echo e(optional($parking->city)->name); ?> • <?php echo e($parking->address); ?></div>
      <div class="pe-muted">Price: <b><?php echo e($parking->price_per_hour); ?> JOD / hour</b></div>
    </div>
    <a href="<?php echo e(route('user.parkings.index')); ?>" class="btn pe-btn-outline">Back</a>
  </div>

  <div class="pe-card p-3 mb-3">
    <div class="row g-3 align-items-center">
      <div class="col-md-4">
        <img src="<?php echo e($parking->image_url ? $parking->image_url : asset('landing/images/img-5.png')); ?>"
             alt="parking" style="width:100%;height:220px;object-fit:cover;border-radius:14px;">
      </div>
      <div class="col-md-8">
        <div class="d-flex flex-wrap gap-2">
          <span class="pe-pill pe-pill-ava">Available: <?php echo e($parking->spots->where('status','available')->count()); ?></span>
          <span class="pe-pill pe-pill-busy">Reserved: <?php echo e($parking->spots->where('status','reserved')->count()); ?></span>
        </div>
        <div class="mt-3 pe-muted">Tap a spot to see details. Available spots are clickable.</div>
      </div>
    </div>
  </div>

  <div class="pe-card p-3">
    <div class="spots-grid">
      <?php $__currentLoopData = $parking->spots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $res = $activeReservations->get($s->id);
          $isActive = (bool)$res;
          $isMine = $isActive && auth()->check() && ($res->user_id ?? null) === auth()->id();

          $statusText = $isMine ? 'Reserved by you' : ($isActive ? 'Reserved' : 'Available');
          $cardClass = $isMine ? 'spot-taxi mine' : ($isActive ? 'spot-taxi reserved' : 'spot-taxi available');
        ?>

        <button type="button"
          class="<?php echo e($cardClass); ?>"
          data-spot-id="<?php echo e($s->id); ?>"
          data-spot-number="<?php echo e($s->spot_number); ?>"
          data-status="<?php echo e($statusText); ?>"
          data-res-start="<?php echo e($res?->start_time); ?>"
          data-res-end="<?php echo e($res?->end_time); ?>"
          onclick="openSpot(this)"
          <?php if($isActive && !$isMine): ?> disabled <?php endif; ?>
        >
          <div class="spot-num">#<?php echo e($s->spot_number); ?></div>

          <div class="taxi-svg-wrap">
            <svg viewBox="0 0 220 110" class="taxi-svg" aria-hidden="true">
              <rect x="24" y="54" rx="18" ry="18" width="172" height="40" class="car-body"/>
              <path d="M70 54 L92 30 H142 L160 54 Z" class="car-roof"/>
              <rect x="102" y="22" width="36" height="10" rx="4" class="taxi-sign"/>
              <circle cx="64" cy="96" r="12" class="wheel"/>
              <circle cx="164" cy="96" r="12" class="wheel"/>
              <circle cx="64" cy="96" r="5" class="wheel-inner"/>
              <circle cx="164" cy="96" r="5" class="wheel-inner"/>
              <rect x="98" y="40" width="52" height="12" rx="6" class="window"/>
              <rect x="84" y="58" width="52" height="18" rx="6" class="window"/>
              <circle cx="184" cy="74" r="6" class="headlight"/>
            </svg>
          </div>

          <div class="spot-status"><?php echo e($statusText); ?></div>
        </button>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="spot-legend taxi-legend">
      <div class="legend-item"><span class="legend-mini available"></span> Available</div>
      <div class="legend-item"><span class="legend-mini reserved"></span> Reserved</div>
      <div class="legend-item"><span class="legend-mini mine"></span> Reserved by you</div>
    </div>
  </div>
</div>

<div class="modal fade" id="spotModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content taxi-modal">
      <div class="modal-header taxi-modal-header">
        <h5 class="modal-title" id="spotTitle">Spot</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body taxi-modal-body text-center">
        <div class="taxi-modal-status mt-3">
          <span class="badge taxi-badge" id="spotStatus">Available</span>
        </div>

        <p class="pe-muted mt-2 mb-0" id="spotTime"></p>
        <hr class="my-3">

        <?php if(auth()->guard()->guest()): ?>
          <a href="<?php echo e(route('login')); ?>" class="btn pe-btn w-100">Login to Reserve</a>
          <div class="mt-2 pe-muted" style="font-size:13px;">
            Don’t have an account?
            <a href="<?php echo e(route('register')); ?>" style="font-weight:900;color:#3a3a5e;">Sign up</a>
          </div>
        <?php endif; ?>

        <?php if(auth()->guard()->check()): ?>
  <form id="reserveForm" method="POST" action="<?php echo e(route('user.reservations.store')); ?>">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="parking_id" value="<?php echo e($parking->id); ?>">
    <input type="hidden" name="spot_id" id="spotIdInput" required>
    <input type="hidden" name="unit" value="hours">
    <input type="hidden" name="value" value="1">
    <button type="submit" class="btn pe-btn w-100">Reserve</button>
  </form>
<?php endif; ?>

      </div>
    </div>
  </div>
</div>

<?php if(session('success')): ?>
  <script>
    Swal.fire({icon:'success', title:'Success', text:<?php echo json_encode(session('success'), 15, 512) ?>});
  </script>
<?php endif; ?>
<?php if(session('error')): ?>
  <script>
    Swal.fire({icon:'error', title:'Oops', text:<?php echo json_encode(session('error'), 15, 512) ?>});
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

    document.getElementById('spotTitle').textContent = `Spot #${spotNumber}`;

    const badge = document.getElementById('spotStatus');
    badge.textContent = status || 'Unknown';

    if ((status || '').includes('Available')) {
      badge.style.background = '#ddd';
      badge.style.color = '#3a3a5e';
    } else {
      badge.style.background = '#3a3a5e';
      badge.style.color = '#fff';
    }

    const timeEl = document.getElementById('spotTime');
    if (start && end) timeEl.textContent = `Reserved from ${start} to ${end}`;
    else timeEl.textContent = (status.includes('Available')) ? 'Available now' : '';


    const reserveForm = document.getElementById('reserveForm');
    const isReserved = status.includes('Reserved');
    if (reserveForm) {
      reserveForm.style.display = (!isReserved) ? 'block' : 'none';
    }

    spotModal.show();
  }
</script>

</body>
</html>
<?php /**PATH C:\Users\DELL\Downloads\Parking-Finder2-stage4-auth-flow\resources\views/user/parkings/show.blade.php ENDPATH**/ ?>