<nav class="navbar navbar-expand navbar-light bg-light">
          <button class="btn shadow-0" id="sidenavCollapse" type="button">
            <i class="fas fa-bars"></i>
          </button>
          <div class="container-fluid">
            <ul class="navbar-nav ms-auto">
              <!-- Notification dropdown -->
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle hidden-arrow"
                  href="#"
                  id="1"
                  role="button"
                  data-mdb-toggle="dropdown"
                  aria-expanded="false"
                >
                  <i class="fas fa-bell"></i>
                  <span class="badge rounded-pill badge-notification bg-danger"
                    >1</span
                  >
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="1">
                  <li><a class="dropdown-item" href="#">Some news</a></li>
                  <li><a class="dropdown-item" href="#">Another news</a></li>
                  <li>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle d-flex align-items-center"
                  href="#"
                  id="navbarDropdownMenuLink"
                  role="button"
                  data-mdb-toggle="dropdown"
                  aria-expanded="false"
                >
                  <img
                    src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg"
                    class="rounded-circle"
                    height="22"
                    alt=""
                    loading="lazy"
                  />
                </a>
                <ul
                  class="dropdown-menu dropdown-menu-end"
                  aria-labelledby="navbarDropdownMenuLink"
                >
                  <li><a class="dropdown-item" href="#">My profile</a></li>
                  <li><a class="dropdown-item" href="#">Settings</a></li>
                  <li>
                    <form action="{{ route('logout') }}" method="post">
                      @csrf
                      <button class="dropdown-item" type="submit">Logout</button>
                    </form>
                  </li>
                </ul>
              </li>
              <!-- Notification dropdown -->
            </ul>
          </div>
        </nav>