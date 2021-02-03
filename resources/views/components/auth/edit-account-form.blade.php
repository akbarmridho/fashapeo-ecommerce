<form action="{{ route('user-profile-information.update') }}" method="POST">
    @csrf
    @method('put')
    <p class="h5 mb-3">Edit User Info</p>
    <div class="row mb-4">
        <div class="col">
            <div class="form-outline">
                <input
                    name="first_name"
                    type="text"
                    id="registerFirstName"
                    class="form-control @error('first_name') is-invalid @enderror"
                    autocomplete="name"
                    autofocus
                    required
                    value="{{ $user->first_name }}"
                />
                <label class="form-label" for="registerFirstName"
                    >First Name</label
                >
                @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col">
            <div class="form-outline">
                <input
                    name="last_name"
                    type="text"
                    id="registerLastName"
                    class="form-control @error('last_name') is-invalid @enderror"
                    autocomplete="name"
                    autofocus
                    required
                    value="{{ $user->last_name }}"
                />
                <label class="form-label" for="registerLastName"
                    >Last Name</label
                >
                @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-outline mb-4">
        <input
            name="email"
            type="email"
            id="registerEmail"
            class="form-control @error('email') is-invalid @enderror"
            autocomplete="email"
            required
            value="{{ $user->email }}"
        />
        <label class="form-label" for="registerEmail">Email</label>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-outline mb-4">
        <input
            name="birthDate"
            type="text"
            id="dateOfBirth"
            class="form-control"
            style="background-color: white !important"
            required
            value="{{ $user->born_at }}"
        />
        <label class="form-label" for="dateOfBirth">Date of Birth</label>
    </div>

    <div class="form-outline mb-4">
        <input
            name="phone"
            type="number"
            id="phone"
            class="form-control"
            minlength="9"
            maxlength="15"
            value="{{ $user->phone }}"
        />
        <label class="form-label" for="phone">Phone Number</label>
    </div>

    <div class="mb-4 w-50">
        <select
            name="sex"
            class="form-select @error('email') is-invalid @enderror"
            required
        >
            <option value="" selected>Enter your sex</option>
            <option value="1"
            @if($user->sex == 1)
            selected
            @endif
            >Male</option>
            <option value="2"
            @if($user->sex == 2)
            selected
            @endif
            >Female</option>
            <option value="0"
            @if($user->sex == 0)
            selected
            @endif
            >Unknown</option>
            <option value="9"
            @if($user->sex == 9)
            selected
            @endif
            >Not applicable</option>
        </select>
        @error('sex')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary mb-1">Update Info</button>
</form>
<form action="{{ route('user-password.update') }}" method="POST" class="mt-5">
    @csrf
    @method('put')
    <p class="h5 mb-3">Update password</p>

    <div class="form-outline mb-4">
        <input name="current_password" type="password" id="oldPassword" class="form-control" />
        <label class="form-label" for="oldPassword">Old Password</label>
    </div>

    <div class="form-outline mb-4">
        <input name="password" type="password" id="newPassword" class="form-control" />
        <label class="form-label" for="newPassword">New Password</label>
    </div>

    <div class="form-outline mb-4">
        <input
            name="password_confirmation"
            type="password"
            id="registerRepeatPassword"
            class="form-control"
        />
        <label class="form-label" for="registerRepeatPassword"
            >Confirm password</label
        >
    </div>
    <button class="btn btn-primary" type="submit">Update Password</button>
</form>
