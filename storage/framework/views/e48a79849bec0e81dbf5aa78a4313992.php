<!DOCTYPE html>
<html>
<head>
    <title>Token Purchase Details</title>
</head>
<body>
    <h1>Token Purchase Details</h1>
    <p><strong>Name:</strong> <?php echo e($user->name); ?></p>
    <p><strong>Email:</strong> <?php echo e($user->email); ?></p>

    <h3>Tokens Purchased:</h3>
    <ul>
        <?php $__currentLoopData = $tokens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $token): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>Token: <?php echo e($token->token); ?> | Service: <?php echo e($token->service_type); ?> | Expiry: <?php echo e($token->expires_at); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\newsearchai\resources\views/emails/tokens.blade.php ENDPATH**/ ?>