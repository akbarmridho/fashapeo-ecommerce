<form>
     <p class="h5 mb-3">Edit User Info</p>
    <!-- Name input -->
    <div class="form-outline mb-4">
        <input type="text" id="registerName" class="form-control" />
        <label class="form-label" for="registerName">Name</label>
    </div>

    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" id="registerEmail" class="form-control" />
        <label class="form-label" for="registerEmail">Email</label>
    </div>

    <div class="form-outline mb-4">
        <input type="text" id="dateOfBirth" class="form-control" style="background-color: white !important;"/>
        <label class="form-label" for="dateOfBirth">Date of Birth</label>
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary mb-1">
        Update Info
    </button>
</form>
<form action="" class="mt-5">
    <p class="h5 mb-3">Update password</p>

    <div class="form-outline mb-4">
        <input type="password" id="oldPassword" class="form-control" />
        <label class="form-label" for="oldPassword">Old Password</label>
    </div>

        <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="password" id="newPassword" class="form-control" />
        <label class="form-label" for="newPassword">New Password</label>
    </div>
 
    <!-- Repeat Password input -->
    <div class="form-outline mb-4">
        <input
            type="password"
            id="registerRepeatPassword"
            class="form-control"
        />
        <label class="form-label" for="registerRepeatPassword"
            >Confirm password</label
        >
    </div>
    <button class="btn btn-primary">Update Password</button>
</form>
