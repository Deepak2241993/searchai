<!DOCTYPE html>
<html>
<head>
    <title>Aadhaar OTP Generation</title>
</head>
<body>
    <h1>Generate OTP</h1>
    <form action="{{ route('aadhaar.generate') }}" method="POST">
        @csrf
        <label for="aadhaar_number">Aadhaar Number:</label>
        <input type="text" name="aadhaar_number" id="aadhaar_number" required>
        <label for="share_code">Share Code (4 characters):</label>
        <input type="text" name="share_code" id="share_code" maxlength="4" required>
        <button type="submit">Generate OTP</button>
    </form>
</body>
</html>
