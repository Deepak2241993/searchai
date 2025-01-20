<?php $__env->startSection('title'); ?>
    <?php echo e(isset($pageTitle) ? $pageTitle : 'Banner Create'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><?php echo e(isset($pageTitle) ? $pageTitle : 'Banner Create'); ?></h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                        <?php echo e(isset($pageTitle) ? $pageTitle : 'Banner Create'); ?>

                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content py-4"> 
        <div class="container-fluid">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body d-flex justify-content-between align-items-center rounded">
                    <h4 class="card-title mb-0"><?php echo e(isset($pageTitle) ? $pageTitle : 'Banner Create'); ?></h4>
                    <a href="<?php echo e(route('admin.banner.index')); ?>" class="btn btn-warning ms-auto">Back</a>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo e(isset($pageTitle) ? $pageTitle : 'Banner Create'); ?></h3>
                        </div>
                        <?php if(session('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo e(session('error')); ?>

                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <?php if(isset($bannerData)): ?>
                                <form method="post" action="<?php echo e(route('admin.banner.update', $bannerData->id)); ?>"
                                    enctype="multipart/form-data">
                                    <?php echo method_field('PUT'); ?>
                                <?php else: ?>
                                    <form method="post" action="<?php echo e(route('admin.banner.store')); ?>" enctype="multipart/form-data">
                            <?php endif; ?>
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <!-- Title Field -->
                                <div class="mb-3 col-lg-6">
                                    <label for="title" class="form-label">Title</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="title" 
                                        name="title" 
                                        value="<?php echo e(isset($bannerData) ? $bannerData->title : ''); ?>" 
                                        placeholder="Enter title" 
                                        required>
                                </div>

                                <!-- Description Field -->
                                <div class="mb-3 col-lg-6">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea 
                                        class="form-control" 
                                        id="description" 
                                        name="description" 
                                        rows="5" 
                                        placeholder="Enter description" 
                                        required><?php echo e(isset($bannerData) ? $bannerData->description : ''); ?></textarea>
                                </div>

                                <!-- Image Upload Field -->
                                <div class="mb-3 col-lg-6">
                                    <label for="image" class="form-label">Image</label>
                                    <input 
                                        type="file" 
                                        class="form-control" 
                                        id="image" 
                                        name="image" 
                                        accept="image/*">
                                    <?php if(isset($bannerData) && $bannerData->image): ?>
                                        <div class="mt-2">
                                            <img src="<?php echo e(url('/').'/'.('storage/' . $bannerData->image)); ?>" alt="Image Preview" width="100">
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Status Field -->
                                <div class="mb-3 col-lg-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select 
                                        class="form-control" 
                                        id="status" 
                                        name="status">
                                        <option 
                                            value="1" <?php echo e(isset($bannerData->status) && $bannerData->status == 1 ? 'selected' : ''); ?>>
                                            Active
                                        </option>
                                        <option 
                                            value="0" <?php echo e(isset($bannerData->status) && $bannerData->status == 0 ? 'selected' : ''); ?>>
                                            Inactive
                                        </option>
                                    </select>
                                </div>

                                <!-- Order Field -->
                                <div class="mb-3 col-lg-6">
                                    <label for="order" class="form-label">Order</label>
                                    <input 
                                        type="number" 
                                        class="form-control" 
                                        id="order" 
                                        name="order" 
                                        value="<?php echo e(isset($bannerData) ? $bannerData->order : ''); ?>" 
                                        placeholder="Enter display order" 
                                        required>
                                </div>

                                <!-- Submit Button -->
                                <div class="mb-3 col-lg-6 mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <?php echo e(isset($bannerData) ? 'Update' : 'Submit'); ?>

                                    </button>
                                </div>
                            </div>

                            </form>
                            
                        </div> 
                        
                    </div>
                </div>
            </div>
        </div>
    </div>    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newsearchai\resources\views/admin/banner/create.blade.php ENDPATH**/ ?>