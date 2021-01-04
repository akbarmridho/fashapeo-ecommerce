<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-2-strong">
        <!-- Container wrapper -->
        <div class="container">
          <!-- Toggle button -->
          <button class="navbar-toggler" id="sidenavCollapse" type="button">
            <i class="fas fa-bars"></i>
          </button>

          <!-- Navbar brand -->
          <a class="navbar-brand" href="#"
            ><img src="/img/thin.png" alt="" height="50"
          /></a>

          <a href="#" class="d-lg-none link-dark"
            ><i class="fas fa-shopping-cart"></i
            ><span class="badge bg-danger rounded-pill badge-notification"
              >1</span
            ></a
          >

          <!-- Collapsible wrapper -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left links -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item mx-2">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <!-- Navbar dropdown -->
              <li class="nav-item dropdown mx-2">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-mdb-toggle="dropdown"
                  aria-mdb-expanded="false"
                >
                  Shop
                </a>
                <!-- Dropdown menu -->
                <div class="dropdown-menu" id="categoriesMenu">
                  <div class="d-flex small">
                    <div class="flex-fill px-3 my-3" style="min-width: 175px">
                      <a href="" class="dropdown-item fw-bold">SHIRTS</a>
                      <hr class="dropdown-divider" />
                      <a href="" class="dropdown-item">Flannel Shirt</a>
                      <a href="" class="dropdown-item">Plain Shirt</a>
                      <a href="" class="dropdown-item">Polo Shirt</a>
                      <a href="" class="dropdown-item">Overshirt</a>
                    </div>
                    <div class="flex-fill px-3 my-3" style="min-width: 175px">
                      <a href="" class="dropdown-item fw-bold"
                        >OUTWEAR/JACKETS</a
                      >
                      <hr class="dropdown-divider" />
                      <a href="" class="dropdown-item">Bomber Jacket</a>
                      <a href="" class="dropdown-item">Leather Jacket</a>
                      <a href="" class="dropdown-item">Suede Jacket</a>
                      <a href="" class="dropdown-item">Hoodie</a>
                    </div>
                    <div class="flex-fill px-3 my-3" style="min-width: 175px">
                      <a href="" class="dropdown-item fw-bold"
                        >TROUSERS & JEANS</a
                      >
                      <hr class="dropdown-divider" />
                      <a href="" class="dropdown-item">Chinos</a>
                      <a href="" class="dropdown-item">Denim</a>
                      <a href="" class="dropdown-item">Ankle Pants</a>
                      <a href="" class="dropdown-item">Cargo Pants</a>
                      <a href="" class="dropdown-item">Short Pants</a>
                    </div>
                    <div class="flex-fill px-3 my-3" style="min-width: 175px">
                      <a href="" class="dropdown-item fw-bold">SHOES</a>
                      <hr class="dropdown-divider" />
                      <a href="" class="dropdown-item">Sneakers</a>
                      <a href="" class="dropdown-item">Boots</a>
                      <a href="" class="dropdown-item">Loafer</a>
                    </div>
                  </div>
                </div>
                <!-- <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider" /></li>
                  <li>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </li>
                </ul> -->
              </li>
              <li class="nav-item mx-2">
                <a href="" class="nav-link">Promo</a>
              </li>
              <li class="nav-item mx-2">
                <a href="" class="nav-link">About</a>
              </li>
              <li class="nav-item mx-2">
                <a href="" class="nav-link">How to Order</a>
              </li>
              <li class="nav-item dropdown mx-3">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-mdb-toggle="dropdown"
                  aria-mdb-expanded="false"
                >
                  <i class="fas fa-user"></i
                  >
                </a>
                <div class="dropdown-menu">
                  <a href="" class="dropdown-item">My Account</a>
                  <a href="" class="dropdown-item">Orders</a>
                  <a href="" class="dropdown-item">Wishlist</a>
                  <hr class="dropdown-divider" />
                  <a href="" class="dropdown-item">Logout</a>
                </div>
              </li>
              <li class="nav-item mx-3">
                <a
                  role="button"
                  class="nav-link"
                  data-mdb-toggle="modal"
                  data-mdb-target="#loginRegister"
                >
                  <i class="fas fa-user"></i
                  ><span class="badge bg-danger rounded-pill badge-notification"
                    >1</span
                  >
                </a>
              </li>
              <li class="nav-item mx-3">
                <a href="#" class="nav-link"
                  ><i class="fas fa-shopping-cart"></i
                  ><span class="badge bg-danger rounded-pill badge-notification"
                    >1</span
                  ></a
                >
              </li>
              <li class="nav-item dropdown mx-3">
                <a
                  href=""
                  class="nav-link"
                  id="navbarDropdown"
                  role="button"
                  data-mdb-toggle="dropdown"
                  aria-mdb-expanded="false"
                  ><i class="fas fa-search"></i
                ></a>
                <div class="dropdown-menu dropdown-menu-end">
                  <form class="px-4 py-3">
                    <div
                      class="input-group input-group-sm"
                      style="min-width: 200px"
                    >
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Seach"
                      />
                      <button
                        class="btn btn-sm btn-outline-primary"
                        type="button"
                        id="button-addon2"
                        data-mdb-ripple-color="dark"
                      >
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </form>
                </div>
              </li>
            </ul>
            <!-- Left links -->

            <!-- Search form -->
          </div>
          <!-- Collapsible wrapper -->
        </div>
        <!-- Container wrapper -->
        @include('customer.modals.login-register-modal')
      </nav>