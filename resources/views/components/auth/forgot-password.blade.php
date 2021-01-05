<form action="{{ route('password.email') }}" method="POST">
    @csrf
    <div class="mb-3 form-outline">
        <label for="inputEmail" class="form-label">Email address</label>
        <input
            name="email"
            type="email"
            id="inputEmail"
            class="form-control @error('email') is-invalid @enderror"
            placeholder="Email address"
            required
            autocomplete="email"
            autofocus
            value=" {{ old('email') }}"
        />
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    
    <button class="text-center btn btn-lg btn-primary" type="submit">
        Send password reset link
    </button>
</form>