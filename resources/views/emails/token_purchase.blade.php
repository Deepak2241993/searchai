<!DOCTYPE html>
<html>
<head>
    <title>Your Token Purchase Details</title>
</head>
<body>
    <h1>Hello {{ $user->name }}</h1>
    <p>Thank you for your purchase. Please find the PDF attached with the details of the tokens you purchased.</p>
</body>
</html>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Confirmation - SearchAPI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 200px;
        }
        .content {
            color: #333333;
            line-height: 1.6;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777777;
        }
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="logo">
            <img src="{{url('/front-assets/images/logo.png')}}" alt="SearchAPI Logo">
        </div>
        <div class="content">
            <p>Dear <strong>{{ $user->name }}</strong>,</p>
            <p>Thank you for choosing <strong>SearchAPI</strong>. We are excited to assist you in ensuring trust and safety with our efficient and secure process.</p>
            <h3>Purchase Details:</h3>
            <ul>
                <li><strong>Order ID:</strong> {{$order->razorpay_order_id}}</li>
                <li><strong>Number of Tokens Purchased:</strong> {{$order->tokens_purchased}}</li>
                <li><strong>Total Amount:</strong> ₹{{$order->amount}}</li>
                <li><strong>Date of Purchase:</strong> {{ $order->updated_at->format('d-m-Y') }}</li>
            </ul>
            <h3>Next Steps:</h3>
            <p>You can now use your tokens to initiate background verification. Simply follow these steps:</p>
            <ol>
                <li>Log in to your account at <a href="{{url('/')}}">{{url('/')}}</a>.</li>
                <li>Enter the Aadhaar number or relevant details for verification.</li>
                <li>Submit the request.</li>
            </ol>
            <p>Once the verification is complete, you will receive a detailed report in PDF format via email.</p>
            <p>If you have any questions or need assistance, feel free to contact our support team at <a href="mailto:care@searchai.space">care@searchai.space</a>.</p>
            <p>Thank you for trusting us with your background verification needs.</p>
            <p>Best regards,</p>
            <p><strong>SearchAPI Team</strong></p>
        </div>
        <div class="footer">
            &copy; {{date('Y')}} SearchAPI. All rights reserved.
        </div>
    </div>
</body>
</html>
