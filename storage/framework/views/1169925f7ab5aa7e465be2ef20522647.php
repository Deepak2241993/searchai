<?php $__env->startSection('title'); ?>
    User List
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">User List</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            User List
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content"> 
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">User Table</h3>
                        </div>
                        <?php if(session('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo e(session('success')); ?>

                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <?php if(session('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo e(session('error')); ?>

                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Profile</th>
                                        <th style="width: 40px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $userResult; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="align-middle">
                                            <td style="width: 5%;"><?php echo e($loop->iteration + ($userResult->currentPage() - 1) * $userResult->perPage()); ?></td>
                                            <td style="width: 25%;"><?php echo e($user->name); ?></td>
                                            <td style="width: 30%;"><?php echo e($user->email); ?></td>
                                            <td style="width: 15%;"><?php echo e($user->is_admin ? 'Admin' : 'User'); ?></td>
                                            <td style="width: 25%;">
                                                <a href="<?php echo e(route('admin.user.edit', $user->id)); ?>" class="btn btn-sm btn-info">Edit</a>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="deleteUser(<?php echo e($user->id); ?>)">Delete</a>
                                            </td>
                                        </tr>                                    
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="5">No data found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div> <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-end">
                                <?php echo e($userResult->links('pagination::bootstrap-4')); ?>

                            </ul>
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
        // Find all alert messages
        var alerts = document.querySelectorAll('.alert');

        // Loop through each alert
        alerts.forEach(function(alert) {
            // Set a timeout to remove the alert after 2 seconds (2000 milliseconds)
            setTimeout(function() {
                var bootstrapAlert = new bootstrap.Alert(alert);
                bootstrapAlert.close();
            }, 2000);
        });
    });
</script>
<script>
    function deleteUser(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            fetch(`<?php echo e(url('admin/user-delete')); ?>/${userId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload(); // Reload the page or update the UI dynamically
                } else {
                    alert(data.message || 'Something went wrong!');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newsearchai\resources\views/admin/user/index.blade.php ENDPATH**/ ?>