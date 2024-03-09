<x-modals.modal>
<x-slot:title>Sign Up</x-slot:title>
<form action="{{ route('signup') }}" id="signup-form">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <div class="radio-group">
            <input type="radio" id="player_role" name="role" value="PL" required>
            <label for="role">Player</label>
        </div>
        <div class="radio-group">
            <input type="radio" id="gm_role" name="role" value="GM" required>
            <label for="role">Game Master</label>
        </div>
        <div class="radio-group">
            <input type="radio" id="tavernkeeper_role" name="role" value="TK" required>
            <label for="role">Tavernkeeper</label>
        </div>
    </div>
    <div id="tavern-code-box" class="form-group">
        <label for="tavern-code">Tavern Code</label>
        <input type="text" id="tavern-code" name="tavern_code" value="{{ old('tavern_code') }}">
    </div>
    <div class="form-group">
        <button type="submit">Sign Up</button>
    </div>
</form>
</x-modals.modal>