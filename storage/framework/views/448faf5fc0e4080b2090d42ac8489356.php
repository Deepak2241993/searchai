
<?php $__env->startSection('title'); ?>
Total Orders List
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="app-content-header bg-light py-3 shadow-sm">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0">Faqs List</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Total Orders List</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="app-content py-4">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body d-flex justify-content-between align-items-center rounded">
                <h4 class="card-title mb-0">Manage Orders List</h4>
                
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
                                        <!-- <th>ID</th> -->
                                        <th>User Name</th>
                                        <th>Razorpay Order ID</th>
                                        <th>Amount</th>
                                        <!-- <th>Currency</th> -->
                                        <th>Status</th>
                                        <th>Service Name</th>
                                        <th>Created At</th>
                                        <th>Tokens View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td> <!-- Row number -->
                                        <!-- <td><?php echo e($order->id); ?></td> -->
                                        <td><?php echo e($order->user->name ?? 'N/A'); ?></td>
                                        <td><?php echo e($order->razorpay_order_id); ?></td>
                                        <td>Rs.<?php echo e(number_format($order->amount, 2)); ?></td>
                                        <!-- <td><?php echo e(strtoupper($order->currency)); ?></td> -->
                                        <td><?php echo e(ucfirst($order->status)); ?></td>
                                        <td><?php echo e($order->serviceName ?? 'N/A'); ?></td>
                                        <td><?php echo e($order->created_at ? $order->created_at->format('d-m-Y H:i') : 'N/A'); ?></td>
                                        <td>
                                            <button class="btn btn-primary btn-sm view-order-btn" data-id="<?php echo e($order->id); ?>" data-bs-toggle="modal" data-bs-target="#orderDetailsModal">
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="10" class="text-center text-muted">No data found.</td>
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


<!-- Modal -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Order details will be dynamically loaded here -->
                <div id="orderDetailsContent">
                    <p class="text-center">Loading...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const modalContent = document.getElementById('orderDetailsContent');
    const buttons = document.querySelectorAll('.view-order-btn');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const orderId = this.dataset.id;

            // Clear previous content and show a loading indicator
            modalContent.innerHTML = '<p class="text-center">Loading...</p>';

            // Fetch order details via AJAX
            fetch(`/orders/${orderId}`)
                .then(response => response.json())
                .then(data => {
                    // Populate modal with order details
                    modalContent.innerHTML = `
                        <h5>Order ID: ${data.id}</h5>
                        <p><strong>User:</strong> ${data.user.name ?? 'N/A'}</p>
                        <p><strong>Total Tokens:</strong> ${data.tokens_total ?? 'N/A'}</p>
                        <h6>Tokens:</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Token ID</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${data.tokens.map(token => `
                                    <tr>
                                        <td>${token.id}</td>
                                        <td>${token.quantity}</td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    `;
                })
                .catch(error => {
                    modalContent.innerHTML = `<p class="text-danger">Failed to load order details. Please try again.</p>`;
                });
        });
    });
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newsearchai\resources\views/admin/ordersdetails/list.blade.php ENDPATH**/ ?>