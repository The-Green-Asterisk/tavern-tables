<x-modals.modal>
<x-slot:title>Log In</x-slot:title>
<form action="{{ route('login') }}" id="login-form">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        <label for="remember-me">Remember Me</label>
        <input type="checkbox" id="remember_me" name="remember_me" {{ old('remember') ? 'checked' : '' }}>
    </div>
    <div class="form-group">
        <button type="submit">Log In</button>
    </div>
</form>
</x-modals.modal>