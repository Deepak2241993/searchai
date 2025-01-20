<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our Platform</title>
</head>
<body>
    <h1>Hello, {{ $name }}!</h1>
    <p>Thank you for registering with SearchAI. Here are your login details:</p>
    <ul>
        <li><strong>Email:</strong> {{ $email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>
    <p>Please keep this information safe. You can log in to your account <a href="{{ url('/login') }}">here</a>.</p>
    <p>Thank you,</p>
    <p>The Search AI Team</p>
</body>
</html>
