<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-2-strong">
    <!-- Container wrapper -->
    <div class="container">
        <!-- Toggle button -->
        <button class="navbar-toggler" id="sidenavCollapse" type="button">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navbar brand -->
        <a class="navbar-brand" href="{{ route('home') }}"><img src="/img/thin.png" alt="" height="50" /></a>

        <a href="#" class="d-lg-none link-dark"><i class="fas fa-shopping-cart"></i><span
                class="badge bg-danger rounded-pill badge-notification">1</span></a>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left links -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item mx-2">
                    <a class="nav-link
                @if (request()->routeIs('home')) active @endif
                        " aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <!-- Navbar dropdown -->
                <li class="nav-item dropdown mx-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-mdb-toggle="dropdown" aria-mdb-expanded="false">
                        Shop
                    </a>
                    <!-- Dropdown menu -->
                    <div class="dropdown-menu" id="categoriesMenu">
                        <x-main.category-menu :categories="$categories" />
                    </div>
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
                @auth('customer')
                    <li class="nav-item dropdown mx-3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-mdb-toggle="dropdown" aria-mdb-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('customer.dashboard') }}" class="dropdown-item">My Account</a>
                            <a href="" class="dropdown-item">Orders</a>
                            <a href="" class="dropdown-item">Wishlist</a>
                            <hr class="dropdown-divider" />
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item mx-3">
                        <a role="button" class="nav-link" data-mdb-toggle="modal" data-mdb-target="#loginRegister">
                            <i class="fas fa-user"></i>
                        </a>
                    </li>
                @endauth
                <li class="nav-item mx-3">
                    <a href="{{ route('customer.carts') }}" class="nav-link"><i class="fas fa-shopping-cart"></i>
                        {{-- <span class="badge bg-danger rounded-pill badge-notification"
                    >1</span
                  > --}}
                    </a>
                </li>
                <li class="nav-item dropdown mx-3">
                    <a href="" class="nav-link" id="navbarDropdown" role="button" data-mdb-toggle="dropdown"
                        aria-mdb-expanded="false"><i class="fas fa-search"></i></a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <form class="px-4 py-3">
                            <div class="input-group input-group-sm" style="min-width: 200px">
                                <input type="text" class="form-control" placeholder="Seach" />
                                <button class="btn btn-sm btn-outline-primary" type="button" id="button-addon2"
                                    data-mdb-ripple-color="dark">
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
    @include('main.modals.login-register-modal')
</nav>
