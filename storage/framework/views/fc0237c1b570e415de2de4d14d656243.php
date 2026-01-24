<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - <?php echo $__env->yieldContent('title', 'Dashboard'); ?></title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your Admin CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">

    <?php echo $__env->yieldContent('head'); ?> <!-- Optional per-page head -->
</head>
<body>

<div id="wrapper">
    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <!-- Brand -->
        <a class="sidebar-brand" href="<?php echo e(route('admin.dashboard')); ?>">
            <i class="fa-solid fa-user-shield me-2"></i>
            Admin Dashboard
        </a>

        <hr class="sidebar-divider">

        <!-- Admin Profile -->
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('profile.edit')); ?>">
                <i class="fa-solid fa-id-badge me-2"></i>
                <span>Admin Profile</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <!-- Users Management -->
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('admin.users.index')); ?>">
                <i class="fa-solid fa-users me-2"></i>
                <span>User Management</span>
            </a>
        </li>

        <!-- Cities Management -->
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('admin.cities.index')); ?>">
                <i class="fa-solid fa-city me-2"></i>
                <span>Cities</span>
            </a>
        </li>

        <!-- Parkings Management -->
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('admin.parkings.index')); ?>">
                <i class="fa-solid fa-parking me-2"></i>
                <span>Parkings</span>
            </a>
        </li>

        <!-- Reservations -->
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('admin.reservations.index')); ?>">
                <i class="fa-solid fa-calendar-check me-2"></i>
                <span>Reservations</span>
            </a>
        </li>

        <!-- Subscriptions -->
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('admin.subscriptions.index')); ?>">
                <i class="fa-solid fa-id-card me-2"></i>
                <span>Subscriptions</span>
            </a>
        </li>

        <!-- Revenue -->
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('admin.revenue.index')); ?>">
                <i class="fa-solid fa-dollar-sign me-2"></i>
                <span>Revenue</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <!-- Logout -->
<li class="nav-item">
 <form id="logout-form" method="POST" action="<?php echo e(route('logout')); ?>" class="d-none">
    <?php echo csrf_field(); ?>
</form>
 <a class="nav-link text-danger" href="#"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fa-solid fa-right-from-bracket me-2"></i>
    <span>Logout</span>
</a>

</li>
    </ul>

    <!-- Main Content -->
    <div id="content">
        <?php echo $__env->yieldContent('content'); ?> <!-- Each page injects its content here -->
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php echo $__env->yieldContent('scripts'); ?> <!-- Optional per-page JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>


<?php /**PATH C:\Users\DELL\Downloads\Parking-Finder2-stage4-auth-flow\resources\views/admin/layout.blade.php ENDPATH**/ ?>