<form action="
@admin
{{ route('admin.login') }}
@else
{{ route('login') }}
@endadmin
" method="POST">
    @csrf
    <p class="text-center">Login</p>

    <!-- Email input -->
    <div class="form-outline mb-4">
        <input name="email" type="email" id="loginName" 
        class="form-control @error('email') is-invalid @enderror" 
        required autofocus autocomplete="email" value="{{ old('email') }}"/>
        <label class="form-label" for="loginName">Email</label>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <input name="password" type="password" id="loginPassword" class="form-control 
        @error('email') is-invalid @enderror" required autocomplete="current-password"/>
        <label class="form-label" for="loginPassword">Password</label>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <!-- 2 column grid layout for inline styling -->
    <div class="row mb-4">
        <div class="col d-flex justify-content-center">
            <!-- Checkbox -->
            <div class="form-check">
                <input
                    class="form-check-input"
                    type="checkbox"
                    value="remember-me"
                    id="loginCheck"
                    {{ old("remember") ? "checked" : "" }}
                />
                <label class="form-check-label" for="loginCheck">
                    Remember me
                </label>
            </div>
        </div>

        <div class="col">
            <!-- Simple link -->
            <a href="{{ route('password.request') }}">Forgot password?</a>
        </div>
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4">
        Sign in
    </button>

    <!-- Register buttons -->
    <div class="text-center">
        @admin
        <p class="mb-1">Not a member? <a href="{{ route('admin.register') }}">Register</a></p>
        @else
        <p class="mb-1">Not a member? <a href="{{ route('register') }}">Register</a></p>
        @endadmin
    </div>
</form>
