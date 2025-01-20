<!-- Start Navbar -->

<style>
    .btn.btn-success.btn-sm.position-relative.ms-2:hover {
        background-color: #ED760D;
    }

    .btn.btn-success.btn-sm.position-relative.ms-2 {
        background-color: #ED760D;
    }

    .btn.btn-outline-light.btn-sm {
        background-color: #ED760D;
    }

    .btn.btn-outline-light.btn-sm:hover {
        background-color: #ED760D;
    }

    i.bi.bi-house-door {
        color: #ffffff;
    }

    i.bi.bi-gear {
        color: #ffffff;
    }

    i.bi.bi-cart4 {
        color: #ffffff;
    }
    i.bi.bi-box-arrow-in-right {

        color: #ffffff;
    }
    i.bi.bi-person-plus {
        color: #ffffff;
    }
    a.btn.btn-outline-success.btn-sm.ms-2 {
        background-color: #ED760D;
    }


    span.navbar-text.me-3.text-white {
        display: contents;
    }
</style>


<header class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(0, 69, 85, 1);">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="<?php echo e(route('home')); ?>">
            <amp-img src="<?php echo e(url('/front-assets')); ?>/images/footer_logo.png" width="200" height="40" layout="fixed" alt="Helpers near me"></amp-img>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="about-us.html">About<br />Helpers Near Me</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="hnm.html">Join us as a Helper /<br />सहायक के रूप में हमसे जुड़ें</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="verifications.html">Verify your<br />Worker, Legally</a>
                </li>
                <li class="nav-item">
                    <?php if(auth()->guard()->check()): ?>
                    <a class="btn btn-outline-light btn-sm" href="<?php echo e(route('home')); ?>">
                        <span class="navbar-text me-3 text-white">
                            <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1)) . strtoupper(substr(strrchr(Auth::user()->name, ' '), 1, 1))); ?>

                        </span>
                    </a>

                    <a class="btn btn-outline-light btn-sm" href="<?php echo e(route('dashboard')); ?>">
                        <i class="bi bi-house-door"></i>
                    </a>
                    <a class="btn btn-outline-light btn-sm ms-2" href="<?php echo e(route('settings')); ?>">
                        <i class="bi bi-gear"></i>
                    </a>
                    <a class="btn btn-success btn-sm position-relative ms-2" href="<?php echo e(route('cart.index')); ?>">
                        <i class="bi bi-cart4"></i>
                        <span class="badge position-absolute top-0 start-100 translate-middle bg-danger rounded-circle">
                            <?php echo e(getTotalCartItems()); ?>

                        </span>
                    </a>
                    <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-link ms-2 text-white">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form>
                    <?php else: ?>
                    <a class="btn btn-outline-light btn-sm ms-2" href="<?php echo e(route('login')); ?>">
                        <i class="bi bi-box-arrow-in-right"></i> 
                    </a>
                    <a class="btn btn-outline-success btn-sm ms-2" href="<?php echo e(route('register')); ?>">
                        <i class="bi bi-person-plus"></i> 
                    </a>
                    <?php endif; ?>

                </li>
            </ul>
        </div>
    </div>
</header>
<!-- End Navbar --><?php /**PATH C:\xampp\htdocs\newsearchai\resources\views/components/front/header.blade.php ENDPATH**/ ?>