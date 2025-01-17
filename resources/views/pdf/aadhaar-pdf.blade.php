<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aadhaar Details {{ $aadhaarData['reference_id'] }}</title>
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
        <p><strong>Aadhaar Number:</strong> {{ $aadhaarData['reference_id'] }}</p> 
        <p><strong>Name:</strong> {{ $aadhaarData['name'] }}</p>
        <p><strong>Date of Birth:</strong> {{ $aadhaarData['date_of_birth'] }}</p>
        <p><strong>Gender:</strong> {{ $aadhaarData['gender'] }}</p>
        <p><strong>Mobile:</strong> {{ $aadhaarData['mobile'] }}</p>
        <p><strong>Full Address:</strong> 
            {{ $aadhaarData['care_of'] }}, 
            {{ $aadhaarData['house'] }},
            {{ $aadhaarData['street'] }},
            {{ $aadhaarData['district'] }},
            {{ $aadhaarData['sub_district'] }},
            {{ $aadhaarData['locality'] }},
            {{ $aadhaarData['post_office_name'] }},
            {{ $aadhaarData['state'] }},
            {{ $aadhaarData['pincode'] }},
            {{ $aadhaarData['country'] }},
            {{ $aadhaarData['vtc_name'] }}
        </p>
    </div>
</body>
</html>
