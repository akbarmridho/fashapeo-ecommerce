<form action="{{ route('password.update') }}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ $request->route('token') }}">
    <div class="mb-3">
        <input name="email" hidden type="email" class="form-control" @error('email')
        is-invalid @enderror value="{{ $request->email ?? old("email") }}" required
        autocomplete="email"/> 
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="mb-3 form-outline">
        <label for="inputPassword" class="form-label">Password</label>
        <input
            type="password"
            id="inputPassword"
            name="password"
            class="form-control"
            placeholder="Password"
            required
            autocomplete="new-pasword"
        />
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="mb-3 form-outline">
        <label for="inputPassword" class="form-label">Confirm password</label>
        <input
            name="password_confirmation"
            type="password"
            id="inputPassword"
            class="form-control"
            placeholder="Password"
            required
            autocomplete="new-password"
        />
    </div>

    <button class="text-center btn btn-lg btn-primary" type="submit">
        Reset Password
    </button>
</form>