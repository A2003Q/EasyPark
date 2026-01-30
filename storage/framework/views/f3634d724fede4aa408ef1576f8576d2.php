<header class="header_section landing-header" id="top">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container landing-nav">

            <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class=""></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav landing-navlist">

    
    <?php if(auth()->guard()->guest()): ?>
        <li class="nav-item">
            <a class="nav-link" href="#home">Home</a>
        </li>
    <?php endif; ?>

    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('user.parkings.index')); ?>">Parkings</a>
    </li>

    <?php if(auth()->guard()->guest()): ?>
        <li class="nav-item">
            <a class="nav-link" href="#about">About</a>
        </li>
    <?php endif; ?>

    <?php if(auth()->guard()->check()): ?>
        <?php if(auth()->user()->role !== 'admin'): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('user.subscriptions.index')); ?>">Subscriptions</a>
            </li>
        <?php endif; ?>
    <?php endif; ?>

    <!-- LOGO CENTER -->
    <li class="nav-item nav-logo-item">
        <a class="nav-link navbar-brand" href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e(asset('landing/images/logo2.png')); ?>" alt="ParkIt Logo" class="nav-logo">
        </a>
    </li>

    
    <?php if(auth()->guard()->guest()): ?>
        <li class="nav-item">
            <a class="nav-link" href="#testimonials">Reviews</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('login')); ?>">Sign In</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#footer">Contact</a>
        </li>
    <?php endif; ?>

    <?php if(auth()->guard()->check()): ?>
        <?php if(auth()->user()->role === 'admin'): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
            </li>
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('user.profile')); ?>">Profile</a>
            </li>
        <?php endif; ?>

        <li class="nav-item">
            <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="nav-link logout-link">Logout</button>
            </form>
        </li>
    <?php endif; ?>

</ul>


            </div>
        </nav>
    </div>
</header>

<?php /**PATH C:\Users\DELL\Downloads\Parking-Finder2-stage4-auth-flow\resources\views/landing/partials/nav.blade.php ENDPATH**/ ?>