<form>
    <div class="text-center mb-3">
        <p>Sign up with:</p>
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

    <!-- Name input -->
    <div class="form-outline mb-4">
        <input type="text" id="registerName" class="form-control" />
        <label class="form-label" for="registerName">Name</label>
    </div>

    <!-- Username input -->
    <!-- <div class="form-outline mb-4">
                  <input
                    type="text"
                    id="registerUsername"
                    class="form-control"
                  />
                  <label class="form-label" for="registerUsername"
                    >Username</label
                  >
                </div> -->

    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" id="registerEmail" class="form-control" />
        <label class="form-label" for="registerEmail">Email</label>
    </div>

    <div class="form-outline mb-4">
        <input type="text" id="dateOfBirth" class="form-control" style="background-color: white !important;"/>
        <label class="form-label" for="dateOfBirth">Date of Birth</label>
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="password" id="registerPassword" class="form-control" />
        <label class="form-label" for="registerPassword">Password</label>
    </div>

    <!-- Repeat Password input -->
    <div class="form-outline mb-4">
        <input
            type="password"
            id="registerRepeatPassword"
            class="form-control"
        />
        <label class="form-label" for="registerRepeatPassword"
            >Repeat password</label
        >
    </div>
    <!-- Checkbox -->
    <div class="form-check d-flex justify-content-center mb-1">
        {{-- <input
            class="form-check-input me-2"
            type="checkbox"
            value=""
            id="registerCheck"
            checked
            aria-describedby="registerCheckHelpText"
        />
        <label class="form-check-label" for="registerCheck">
            I have read and agree to the terms
        </label> --}}
        <p class="text-center small text-muted">By signing up, I agree with <br> terms & conditions and privacy policy</p>
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-1">
        Sign in
    </button>
</form>
<link rel="stylesheet" href="/css/flatpickr.css">
<script src="/js/flatpickr.js"></script>
<script>
    flatpickr('#dateOfBirth', {maxDate: '1/1/2010', dateFormat: 'j/m/Y'});
</script>
