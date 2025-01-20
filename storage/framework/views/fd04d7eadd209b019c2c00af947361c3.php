<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aadhaar Details <?php echo e($aadhaarData['reference_id']); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        .content {
            margin-top: 20px;
        }
        .content p {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h1>Aadhaar Details</h1>
    <h1>Aadhaar Details</h1>
    
    <div class="content">
        <p><strong>Aadhaar Number:</strong> <?php echo e($aadhaarData['reference_id']); ?></p> 
        <p><strong>Name:</strong> <?php echo e($aadhaarData['name']); ?></p>
        <p><strong>Date of Birth:</strong> <?php echo e($aadhaarData['date_of_birth']); ?></p>
        <p><strong>Gender:</strong> <?php echo e($aadhaarData['gender']); ?></p>
        <p><strong>Mobile:</strong> <?php echo e($aadhaarData['mobile']); ?></p>
        <p><strong>Full Address:</strong> 
            <?php echo e($aadhaarData['care_of']); ?>, 
            <?php echo e($aadhaarData['house']); ?>,
            <?php echo e($aadhaarData['street']); ?>,
            <?php echo e($aadhaarData['district']); ?>,
            <?php echo e($aadhaarData['sub_district']); ?>,
            <?php echo e($aadhaarData['locality']); ?>,
            <?php echo e($aadhaarData['post_office_name']); ?>,
            <?php echo e($aadhaarData['state']); ?>,
            <?php echo e($aadhaarData['pincode']); ?>,
            <?php echo e($aadhaarData['country']); ?>,
            <?php echo e($aadhaarData['vtc_name']); ?>

        </p>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\newsearchai\resources\views/pdf/aadhaar-pdf.blade.php ENDPATH**/ ?>