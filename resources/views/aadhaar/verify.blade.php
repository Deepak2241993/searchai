<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
</head>
<body>
    <h1>Verify OTP</h1>
    <form action="{{ route('aadhaar.submit') }}" method="POST">
        @csrf
        <input type="hidden" name="transaction_id" value="{{ $transactionId }}">
        <label for="otp">OTP:</label>
        <input type="text" name="otp" id="otp" required>
        <label for="share_code">Share Code:</label>
        <input type="text" name="share_code" id="share_code" value="{{ session('share_code') }}" maxlength="4" required>
        <button type="submit">Verify OTP</button>
    </form>
</body>
</html>
