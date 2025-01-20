<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="<?php echo e(route('home')); ?>" class="brand-link"> <!--begin::Brand Image--> <img src="<?php echo e(url('/')); ?>/admin-assets/assets/img/searchai.png" alt="search ai logo" class="brand-image opacity-75 shadow"> <span class="brand-text fw-light"></span> </a> </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <?php if(auth()->user() && auth()->user()->isAdmin()): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link active">
                        <i class="nav-icon fa fa-circle"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.user-list')); ?>" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>User Management</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.coupon.list')); ?>" class="nav-link">
                        <i class="nav-icon fa fa-barcode"></i>
                        <p>Coupon Management</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.faq.index')); ?>" class="nav-link">
                        <i class="bi bi-blockquote-left"></i>
                        <p>FAQs Management</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.banner.index')); ?>" class="nav-link">
                        <i class="bi bi-layout-sidebar"></i>
                        <p>Banner Management</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.service.index')); ?>" class="nav-link">
                        <i class="bi bi-gear-wide-connected"></i>
                        <p>Service Management</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.blog.index')); ?>" class="nav-link">
                        <i class="bi bi-gear-wide-connected"></i>
                        <p>Blogs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.ordersDetails')); ?>" class="nav-link">
                        <i class="bi bi-calendar2-minus"></i>
                        <p>Orders Details</p>
                    </a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('dashboard')); ?>" class="nav-link active">
                        <i class="nav-icon fa fa-circle"></i>
                        <p>User Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('token.index')); ?>" class="nav-link">
                        <i class="nav-icon fa fa-circle"></i>
                        <p>Tokens</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('orders')); ?>" class="nav-link">
                        <i class="nav-icon fa fa-circle"></i>
                        <p>Orders</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('profile')); ?>" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>My Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('settings')); ?>" class="nav-link">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>Settings</p>
                    </a>
                </li>
                <?php endif; ?>

                
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--><?php /**PATH C:\xampp\htdocs\newsearchai\resources\views/components/admin/sidebar.blade.php ENDPATH**/ ?>