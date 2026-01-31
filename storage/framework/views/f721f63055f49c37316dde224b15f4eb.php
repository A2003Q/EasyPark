<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <h3 class="text-center mt-4 mb-5">
        Welcome, <?php echo e(auth()->user()->name); ?>!
    </h3>

    <!-- Dashboard Cards -->
    <div class="dashboard-row">

        <!-- Users -->
       <?php if(auth()->user()->role === 'admin'): ?>
           <a href="<?php echo e(route('admin.users.index')); ?>" class="text-decoration-none">
           <div class="dashboard-card">
           <i class="fa fa-users"></i>
          <h4>Users</h4>
          <p><?php echo e($usersCount); ?></p>
       </div>
    </a>
<?php endif; ?>

        <!-- Active Subscriptions -->
        <?php if(auth()->user()->role === 'admin'): ?>
        <a href="<?php echo e(route('admin.subscriptions.index')); ?>" class="text-decoration-none">
            <div class="dashboard-card">
                <i class="fa fa-id-card"></i>
                <h4>Active Subscriptions</h4>
                <p><?php echo e($activeSubscriptions); ?></p>
            </div>
        </a>
        <?php endif; ?>

        <!-- Parkings -->
        
        <a href="<?php echo e(auth()->user()->role === 'owner' ? route('owner.parkings.index') : route('admin.parkings.index')); ?>" class="text-decoration-none">

            <div class="dashboard-card">
                <i class="fa fa-parking"></i>
                <h4>Parkings</h4>
                <p><?php echo e($parkingsCount); ?></p>
            </div>
        </a>

        <!-- Active Reservations -->
        <a href="<?php echo e(auth()->user()->role === 'owner' ? route('owner.reservations.index') : route('admin.reservations.index')); ?>" class="text-decoration-none">
            <div class="dashboard-card">
                <i class="fa fa-calendar-check"></i>
                <h4>Active Reservations</h4>
                <p><?php echo e($activeReservations); ?></p>
            </div>
        </a>

        <!-- Monthly Revenue -->
        <?php if(auth()->user()->role === 'admin'): ?>
        <div class="dashboard-card">
            <i class="fa fa-chart-line"></i>
            <h4>Monthly Revenue</h4>
            <p><?php echo e($monthlyRevenue); ?> JD</p>
        </div>
        <?php endif; ?>

        <!-- Total Revenue -->
        <?php if(auth()->user()->role === 'admin'): ?>
        <div class="dashboard-card">
            <i class="fa fa-dollar-sign"></i>
            <h4>Total Revenue</h4>
            <p><?php echo e($totalRevenue); ?> JD</p>
        </div>
        <?php endif; ?>
    </div>

    <!-- Charts Section -->
    <div class="dashboard-charts mt-5">

        <div class="row g-4">
  
  
            <!-- Smaller Charts Below -->
            <div class="col-lg-6">
                <div class="chart-card">
                    <h5 class="chart-title">Reservations Status</h5>
                    <canvas id="reservationsChart"></canvas>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="chart-card">
                    <h5 class="chart-title">Parking Availability</h5>
                    <canvas id="parkingChart"></canvas>
                </div>
            </div>
            <!-- Monthly Revenue Chart (Large Top) -->
            <?php if(auth()->user()->role === 'admin'): ?>
            <div class="col-lg-12">
                <div class="chart-card">
                    <h5 class="chart-title">Monthly Revenue</h5>
                    <canvas id="revenueChart"></canvas>
                </div>
                
            </div>
            <?php endif; ?>

        

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    /* ----------------------------- */
/* Reservations Status Chart     */
/* ----------------------------- */
const reservationsData = <?php echo json_encode($reservationStatusCounts, 15, 512) ?>; // e.g. ['Active'=>40,'Completed'=>25,'Cancelled'=>10]
new Chart(document.getElementById('reservationsChart'), {
    type: 'doughnut',
    data: {
        labels: Object.keys(reservationsData),
        datasets: [{
            data: Object.values(reservationsData),
            backgroundColor: ['#3a3a5e','#50507a','#6b6b98','#8585b6'],
            borderColor: '#3a3a5e',

        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } }
    }
});

/* ----------------------------- */
/* Parking Availability Chart    */
/* ----------------------------- */
const parkingData = <?php echo json_encode($parkingAvailability, 15, 512) ?>; // e.g. ['Available'=>120,'Occupied'=>80]
new Chart(document.getElementById('parkingChart'), {
    type: 'bar',
    data: {
        labels: Object.keys(parkingData),
        datasets: [{
            data: Object.values(parkingData),
           backgroundColor: ['#3a3a5e','#50507a','#6b6b98','#8585b6'],
          borderColor: '#3a3a5e',

        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});
/* ----------------------------- */
/* Monthly Revenue Chart (Line)  */
/* ----------------------------- */
const revenueData = <?php echo json_encode($monthlyRevenueByMonth, 15, 512) ?>; // e.g. ['Jan' => 1200, 'Feb'=>1500 ...]
new Chart(document.getElementById('revenueChart'), {
    type: 'line',
    data: {
        labels: Object.keys(revenueData),
        datasets: [{
            label: 'Revenue (JD)',
            data: Object.values(revenueData),
            backgroundColor: '#3a3a5e',
            borderColor: '#3a3a5e',
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#28a745',
            pointBorderColor: '#28a745'
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});


</script>
<?php $__env->stopSection(); ?>









<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\DELL\Downloads\Parking-Finder2-stage4-auth-flow\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>