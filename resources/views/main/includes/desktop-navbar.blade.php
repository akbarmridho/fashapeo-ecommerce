<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-2-strong">

    <div class="container">

        <button class="navbar-toggler" id="sidenavCollapse" type="button">
            <i class="fas fa-bars"></i>
        </button>


        <a class="navbar-brand" href="{{ route('home') }}"><img src="/img/thin.png" alt="" height="50" /></a>

        <a href="#" class="d-lg-none link-dark"><i class="fas fa-shopping-cart"></i><span
                class="badge bg-danger rounded-pill badge-notification">1</span></a>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item mx-2">
                    <a class="nav-link
                @if (request()->routeIs('home')) active @endif
                        " aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item dropdown mx-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-mdb-toggle="dropdown" aria-mdb-expanded="false">
                        Shop
                    </a>

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
                            @if ($customer->notification_count > 0 || $customer->order_count > 0)
                                <span class="badge bg-danger badge-dot"></span>
                            @endif
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('customer.dashboard') }}" class="dropdown-item">My Account</a>
                            <a href="{{ route('customer.notification') }}">Notifications <span
                                    class="badge rounded-pill bg-danger float-end">{{ $customer->notification_count }}</span></a>
                            <a href="{{ route('customer.orders') }}" class="dropdown-item">Orders<span
                                    class="badge rounded-pill bg-danger float-end">{{ $customer->order_count }}</span></a>
                            <a href="{{ route('customer.wishlists') }}" class="dropdown-item">Wishlist</a>
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
                        @auth('customer')
                            <span
                                class="badge bg-danger rounded-pill badge-notification">{{ $customer->cart_count }}</span>
                        @endauth
                    </a>
                </li>
                <li class="nav-item dropdown mx-3">
                    <a href="" class="nav-link" id="navbarDropdown" role="button" data-mdb-toggle="dropdown"
                        aria-mdb-expanded="false"><i class="fas fa-search"></i></a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <form class="px-4 py-3">
                            <div class="input-group input-group-sm" style="min-width: 200px">
                                <form action="{{ route('products.search') }}" method="get">
                                    <input name="query" type="text" class="form-control" placeholder="Seach" />
                                    <button class="btn btn-sm btn-outline-primary" type="button" id="button-addon2"
                                        data-mdb-ripple-color="dark">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    @include('main.modals.login-register-modal')
</nav>
