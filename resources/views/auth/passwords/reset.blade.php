<form action="{{ route('password.update') }}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">

    <label for="password">New Password</label>
    <input type="password" name="password" required>

    <label for="password_confirmation">Confirm New Password</label>
    <input type="password" name="password_confirmation" required>

    <button type="submit">Reset Password</button>
</form>
