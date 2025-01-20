<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our Platform</title>
</head>
<body>
    <h1>Hello, <?php echo e($name); ?>!</h1>
    <p>Thank you for registering with SearchAI. Here are your login details:</p>
    <ul>
        <li><strong>Email:</strong> <?php echo e($email); ?></li>
        <li><strong>Password:</strong> <?php echo e($password); ?></li>
    </ul>
    <p>Please keep this information safe. You can log in to your account <a href="<?php echo e(url('/login')); ?>">here</a>.</p>
    <p>Thank you,</p>
    <p>The Search AI Team</p>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\newsearchai\resources\views/emails/registration.blade.php ENDPATH**/ ?>