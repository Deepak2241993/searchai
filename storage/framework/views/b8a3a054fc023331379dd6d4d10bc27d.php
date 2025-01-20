<!DOCTYPE html>
<html>
<head>
    <title>Background Verification Report</title>
</head>
<body>
    <p>Dear <?php echo e($customerName); ?>,</p>

    <p>Thank you for choosing SearchAPI! We are pleased to inform you that your verification process is complete, and the detailed report is now available.</p>

    <p>Please find your Background Verification Report attached to this email.</p>

    <h3>Key Details:</h3>
    <ul>
        <li><strong>Name:</strong> <?php echo e($customerName); ?></li>
        <li><strong>Token ID:</strong> <?php echo e($tokenId); ?></li>
        <li><strong>Verification Type:</strong> <?php echo e($service_type); ?></li>
    </ul>

    <p>If you have any questions regarding the report or require further assistance, please do not hesitate to reach out to us.</p>

    <p>Thank you for trusting us with your verification needs. We look forward to serving you again!</p>

    <p>Best regards,<br>SearchAPI Support Team</p>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\newsearchai\resources\views/emails/aadhaar-success.blade.php ENDPATH**/ ?>