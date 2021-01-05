<form action="{{ route('register') }}" method="POST">
    @csrf

    <p class="text-center">Register:</p>

    <div class="form-outline mb-4">
        <input name="name" type="text" id="registerName" class="form-control
            @error('name') 
            is-invalid
            @enderror
            "
            autocomplete="name" autofocus required/>
        <label class="form-label" for="registerName">Name</label>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-outline mb-4">
        <input name="email" type="email" id="registerEmail" class="form-control
            @error('email')
            is-invalid
            @enderror
            "
            autocomplete="email" required/>
        <label class="form-label" for="registerEmail">Email</label>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-outline mb-4">
        <input name="birthDate" type="text" id="dateOfBirth" class="form-control" 
            style="background-color: white !important;" required/>
        <label class="form-label" for="dateOfBirth">Date of Birth</label>
    </div>

    <div class="mb-4 w-50">
        <select name="sex" class="form-select 
            @error('email')
            is-invalid
            @enderror
            "
            required >
            <option value="" selected>Enter your sex</option>
            <option value="0">Unknown</option>
            <option value="1">Male</option>
            <option value="2">Female</option>
            <option value="9">Not applicable</option>
        </select>
        @error('sex')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-outline mb-4">
        <input name="password" type="password" id="registerPassword" class="form-control 
        @error('password')
        is-invalid
        @enderror
        "
        autocomplete="new-password" required/>
        <label class="form-label" for="registerPassword">Password</label>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-outline mb-4">
        <input
            name="password_confirmation"
            type="password"
            id="registerRepeatPassword"
            class="form-control"
            required
            autocomplete="new-password"
        />
        <label class="form-label" for="registerRepeatPassword"
            >Repeat password</label
        >
    </div>

    <div class="form-check d-flex justify-content-center mb-1">
        <p class="text-center small text-muted">By signing up, I agree with <br> terms & conditions and privacy policy</p>
    </div>

    <button type="submit" class="btn btn-primary btn-block mb-1">
        Register
    </button>
</form>
