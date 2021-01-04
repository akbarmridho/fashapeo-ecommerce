<form>
    <div class="text-center mb-3">
        <p>Sign in with:</p>
        <button type="button" class="btn btn-primary btn-floating mx-1">
            <i class="fab fa-facebook-f"></i>
        </button>

        <button type="button" class="btn btn-primary btn-floating mx-1">
            <i class="fab fa-google"></i>
        </button>

        <button type="button" class="btn btn-primary btn-floating mx-1">
            <i class="fab fa-twitter"></i>
        </button>

        <button type="button" class="btn btn-primary btn-floating mx-1">
            <i class="fab fa-github"></i>
        </button>
    </div>

    <p class="text-center">or:</p>

    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" id="loginName" class="form-control" />
        <label class="form-label" for="loginName">Email</label>
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="password" id="loginPassword" class="form-control" />
        <label class="form-label" for="loginPassword">Password</label>
    </div>

    <!-- 2 column grid layout for inline styling -->
    <div class="row mb-4">
        <div class="col d-flex justify-content-center">
            <!-- Checkbox -->
            <div class="form-check">
                <input
                    class="form-check-input"
                    type="checkbox"
                    value=""
                    id="loginCheck"
                    checked
                />
                <label class="form-check-label" for="loginCheck">
                    Remember me
                </label>
            </div>
        </div>

        <div class="col">
            <!-- Simple link -->
            <a href="#!">Forgot password?</a>
        </div>
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4">
        Sign in
    </button>

    <!-- Register buttons -->
    <div class="text-center">
        <p class="mb-1">Not a member? <a href="#!">Register</a></p>
    </div>
</form>
