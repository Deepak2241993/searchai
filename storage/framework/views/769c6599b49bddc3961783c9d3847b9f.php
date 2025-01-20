<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Search AI | User Login </title><!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Search AI | User Login ">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="Search Ai">
    <meta name="keywords" content="At SearchAI we provide a compliant and robust background screening process to help large enterprises, small businesses, start-ups and individuals to build successful relationships based on trust and safety.">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/admin-assets/css/adminlte.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">


</head>

<body class="login-page bg-body-secondary" style="background-color: #ED8D35 !important">
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <div class="login-logo">
                    <a href="#">
                        <img src="<?php echo e(url('/')); ?>/admin-assets/assets/img/searchai.png" alt="Search AI Logo" />
                    </a>
                </div>
                <p class="login-box-msg">Sign In</p>

                <?php if($errors->any()): ?>
                <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert" style="background-color: #1981BA; color: white;">
                    <ul class="mb-0 mt-2">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>
                <form action="<?php echo e(route('login')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo e(old('email')); ?>" required>
                        <div class="input-group-text">
                            <span class="bi bi-envelope"></span>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" onclick="location.href='<?php echo e(url('/')); ?>'">Home</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-4 text-center">
                    <p class="mb-3">
                        <a href="<?php echo e(route('password.request')); ?>" class="text-decoration-none text-primary fw-bold" style="font-size: 1.1rem;">
                            <i class="fas fa-key me-1"></i> Forgot Password?
                        </a>
                    </p>
                    <p class="mb-0 mt-2">
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-primary btn-sm px-4 py-2 rounded-pill shadow-sm">
                            <i class="fas fa-user-plus me-1"></i> Register a New Membership
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </div> <!-- /.login-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="<?php echo e(url('/')); ?>/admin-assets/js/adminlte.js"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const errorAlert = document.getElementById('error-alert');

            if (errorAlert) {

                setTimeout(() => {
                    errorAlert.classList.remove('show');
                    errorAlert.classList.add('fade');
                    setTimeout(() => {
                        errorAlert.remove();
                    }, 500);
                }, 3000);
            }
        });
    </script>
</body>

</html><?php /**PATH C:\xampp\htdocs\newsearchai\resources\views/auth/login.blade.php ENDPATH**/ ?>