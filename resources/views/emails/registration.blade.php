<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .email-header img {
            max-height: 50px;
            margin-bottom: 10px;
        }
        .email-body {
            padding: 20px;
        }
        .email-body h1 {
            font-size: 24px;
            color: #4CAF50;
            margin-bottom: 10px;
        }
        .email-body p {
            font-size: 16px;
            line-height: 1.6;
        }
        .email-body ul {
            padding-left: 20px;
        }
        .email-body ul li {
            margin-bottom: 10px;
        }
        .email-footer {
            background-color: #f4f4f4;
            padding: 15px;
            text-align: center;
            font-size: 14px;
            color: #888;
            border-top: 1px solid #dddddd;
        }
        .email-footer a {
            color: #4CAF50;
            text-decoration: none;
        }
        .cta-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            border-radius: 4px;
        }
        .cta-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="email-header">
            <img src="{{url('/front-assets/images/logo.png')}}" alt="SearchAI">
            <h2>Welcome to SearchAI</h2>
        </div>
        <!-- Body Section -->
        <div class="email-body">
            <h1>Hello, {{ $name }}!</h1>
            <p>Thank you for registering with SearchAI. Here are your login details:</p>
            <ul>
                <li><strong>Email:</strong> {{ $email }}</li>
                <li><strong>Password:</strong> {{ $password }}</li>
            </ul>
            <p>Please keep this information safe. You can log in to your account using the button below:</p>
            <a href="{{ url('/login') }}" class="cta-button">Log In</a>
            <p>Thank you,</p>
            <p>The SearchAI Team</p>
        </div>
        <!-- Footer Section -->
        <div class="email-footer">
            <p>If you have any questions, feel free to <a href="mailto:support@searchai.space">contact us</a>.</p>
            <p>&copy; {{date('Y')}} SearchAI. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
