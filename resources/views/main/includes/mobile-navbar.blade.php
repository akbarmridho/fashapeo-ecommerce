<div class="sidenav-overlay"></div>
<nav class="bg-white navbar navbar-light d-flex align-items-start" id="sidenav">
    <ul class="navbar-nav ps-4">
        <li class="nav-item"></li>
        <li class="nav-item my-5">
            <form action="{{ route('products.search') }}" method="get">
                <div class="input-group input-group-sm pe-4">
                    <input name="term" type="text" class="form-control" placeholder="Seach" />
                    <button class="btn btn-sm btn-outline-primary" type="submit" data-mdb-ripple-color="dark">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </li>
        <li class="nav-item">
            <a class="nav-link
            @if (request()->routeIs('home')) active @endif
                " aria-current="page" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="collapse"
                data-mdb-target="#mobileCategories" aria-mdb-expanded="false">
                Shop
            </a>
            <div class="collapse list-group list-group-flush pe-4 small" id="mobileCategories">
                <x-main.category-menu-mobile :categories="$categories" />
            </div>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link">Promo</a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link">About</a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link">How to Order</a>
        </li>

        @auth('customer')
            <li class="nav-item
                                    @if (request()->routeIs('customer.dashboard')) active @endif
                ">
                <a href="{{ route('customer.dashboard') }}" class="nav-link">My Account</a>
            </li>
            <li class="nav-item"><a href="{{ route('customer.notification') }}" class="nav-link">Notifications <span
                        class="badge rounded-pill bg-danger float-end">{{ $customer->notification_count }}</span></a></li>
            <li class="nav-item"><a href="{{ route('customer.orders') }}" class="nav-link">Orders <span
                        class="badge rounded-pill bg-danger float-end">{{ $customer->order_count }}</span></a></li>
            <li class="nav-item"><a href="{{ route('customer.carts') }}" class="nav-link">Cart <span
                        class="badge rounded-pill bg-danger float-end">{{ $customer->cart_count }}</span></a></li>
            <li class="nav-item"><a href="{{ route('customer.wishlists') }}" class="nav-link">Wishlist</a></li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link border-0" style="background-color: white;">Logout</button>
                </form>
            </li>
        @else
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link">Login</a>
            </li>
        @endauth
    </ul>
</nav>
