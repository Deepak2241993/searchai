<?php $__env->startSection('title'); ?>
All Coupon List
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="app-content-header bg-light py-3 shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Coupon List</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Coupon List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content py-4">
        <div class="container-fluid">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body d-flex justify-content-between align-items-center rounded">
                    <h4 class="card-title mb-0">Manage Coupons</h4>
                    <a href="<?php echo e(route('admin.coupon.create')); ?>" class="btn btn-warning ms-auto">Add New Coupon</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm">
                        <?php if(session('message')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i> <?php echo e(session('message')); ?>

                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-hover table-striped align-middle mb-0">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Discount</th>
                                            <th>Code</th>
                                            <th>Created At</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($coupon->title); ?></td>
                                                <td><?php echo e($coupon->discount_type == 'amount' ? '$ ' . $coupon->discount_rate : $coupon->discount_rate . ' %'); ?></td>
                                                <td><?php echo e($coupon->coupon_code); ?></td>
                                                <td><?php echo e($coupon->created_at); ?></td>
                                                <td> <?php echo e($coupon->status == 1 ? 'Active' : 'Inactive'); ?></td>
                                                <td class="text-center">
                                                    <a href="<?php echo e(route('admin.coupon.edit', $coupon->id)); ?>" class="btn btn-sm btn-info me-2">Edit</a>
                                                    <button class="btn btn-sm btn-danger" onclick="deleteUser(<?php echo e($coupon->id); ?>)">Delete</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">No data found.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <nav>
                                <?php echo e($data->links('pagination::bootstrap-4')); ?>

                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                var bootstrapAlert = new bootstrap.Alert(alert);
                bootstrapAlert.close();
            }, 2000);
        });
    });
</script>
<script>
    function deleteUser(coupon_id) {
    if (confirm('Are you sure you want to delete this coupon?')) {
        fetch(`<?php echo e(url('admin/coupon-delete')); ?>/${coupon_id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Something went wrong!');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the coupon.');
        });
    }
}

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newsearchai\resources\views/admin/coupon/list.blade.php ENDPATH**/ ?>