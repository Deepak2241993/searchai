<!DOCTYPE html>
<html>
<head>
    <title>Token Purchase Details</title>
</head>
<body>
    <h1>Token Purchase Details</h1>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <h3>Tokens Purchased:</h3>
    <ul>
        @foreach ($tokens as $token)
            <li>Token: {{ $token->token }} | Service: {{ $token->service_type }} | Expiry: {{ $token->expires_at }}</li>
        @endforeach
    </ul>
</body>
</html>
