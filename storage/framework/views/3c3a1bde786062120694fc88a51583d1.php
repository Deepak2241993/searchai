<?php $__env->startSection('title'); ?>
    User Profile
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">User Profile</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Profile
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row"> <!--begin::Col-->

                <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('POST'); ?>

                    <div class="row mb-3">
                        <label for="name-input" class="col-sm-2 col-form-label">
                            <i class="fas fa-user"></i> Name
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control form-control-lg rounded-pill" type="text"
                                placeholder="Enter your name" id="name-input" name="name"
                                value="<?php echo e(old('name', $user->name)); ?>">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email-input" class="col-sm-2 col-form-label">
                            <i class="fas fa-envelope"></i> Email
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control form-control-lg rounded-pill" type="email"
                                placeholder="Enter your email" id="email-input" name="email"
                                value="<?php echo e(old('email', $user->email)); ?>">
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="address-input" class="col-sm-2 col-form-label">
                            <i class="fas fa-envelope"></i> Address
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control form-control-lg rounded-pill" type="address"
                                placeholder="Enter your address" id="address-input" name="address"
                                value="<?php echo e(old('phone', optional($user->customerAddress)->address)); ?>">
                            <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="alternate_address-input" class="col-sm-2 col-form-label">
                            <i class="fas fa-envelope"></i> Alternate Address
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control form-control-lg rounded-pill" type="alternate_address"
                                placeholder="Enter your alternate_address" id="alternate_address-input" name="alternate_address"
                                value="<?php echo e(old('phone', optional($user->customerAddress)->alternate_address)); ?>">
                            <?php $__errorArgs = ['alternate_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="phone-input" class="col-sm-2 col-form-label">
                            <i class="fas fa-phone"></i> Phone
                        </label>
                        <div class="col-sm-10">
                            <input type="hidden" id="countryCode" name="country_code">
                            <input class="form-control form-control-lg rounded-pill" type="tel" id="phone"
                                name="phone" placeholder="Phone Number" value="<?php echo e(old('phone', optional($user->customerAddress)->phone)); ?>">
                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="profile-pic" class="col-sm-2 col-form-label">
                            <i class="fas fa-image"></i> Profile Picture
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control-file" type="file" id="profile-pic" name="profile_pic">

                            <div class="mt-2">
                                <?php if($user->profile_pic): ?>
                                    <?php
                                        // Generate the public URL for the profile picture
                                        $profilePicUrl = asset('uploads/profile_pics/' . $user->profile_pic);
                                    ?>
                                    <!-- Display the image using the generated URL -->
                                    <img id="current-profile-pic" src="<?php echo e($profilePicUrl); ?>" alt="Profile Picture"
                                        class="img-thumbnail rounded-circle" width="100">
                                <?php else: ?>
                                    <!-- Display the default profile picture if none is set -->
                                    <img id="current-profile-pic" src="<?php echo e(asset('path_to_default_image')); ?>"
                                        alt="Default Profile Picture" class="img-thumbnail rounded-circle" width="100">
                                <?php endif; ?>
                            </div>

                            <?php $__errorArgs = ['profile_pic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-lg btn-primary rounded-pill px-5">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </form>



            </div> <!--end::Row--> <!--begin::Row-->

        </div> <!--end::Container-->
    </div> <!--end::App Content-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newsearchai\resources\views/auth/profile.blade.php ENDPATH**/ ?>