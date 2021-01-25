<!-- modal -->
  <div
    class="modal fade"
    id="loginRegister"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body p-4">
          <!-- Pills navs -->
          <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
              <a
                class="nav-link active"
                id="mdb-tab-login"
                data-mdb-toggle="pill"
                href="#pills-login"
                role="tab"
                aria-controls="pills-login"
                aria-selected="true"
                >Login</a
              >
            </li>
            <li class="nav-item" role="presentation">
              <a
                class="nav-link"
                id="mdb-tab-register"
                data-mdb-toggle="pill"
                href="#pills-register"
                role="tab"
                aria-controls="pills-register"
                aria-selected="false"
                >Register</a
              >
            </li>
          </ul>
          <!-- Pills navs -->

          <!-- Pills content -->
          <div class="tab-content">
            <div
              class="tab-pane fade show active"
              id="pills-login"
              role="tabpanel"
              aria-labelledby="mdb-tab-login"
            >
              <x-auth.login />
            </div>
            <div
              class="tab-pane fade"
              id="pills-register"
              role="tabpanel"
              aria-labelledby="mdb-tab-register"
            >
              <x-auth.register />
            </div>
          </div>
          <!-- Pills content -->
        </div>
      </div>
    </div>
  </div>
  <script src="{{ mix('/js/pages/auth/register.js')}}" defer></script>