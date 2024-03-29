<div class="navbar-dark bg-dark pt-5" id="admin-sidenav">
    <ul class="navbar-nav ps-4">
        <li class="nav-item">
            <a class="nav-link
            @if (request()->routeIs('admin.dashboard')) active @endif
                " aria-current="page" href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Analytics</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="collapse"
                data-mdb-target="#orders" aria-mdb-expanded="false">
                Orders
            </a>
            <div class="collapse
            @if (request()->routeIs('admin.orders.*')) show @endif
                list-group list-group-flush pe-4 small" id="orders">
                <div class="dropdown-menu-dark">
                    <a class="list-group-item dropdown-item bg-dark
                    @if (request()->routeIs('admin.orders.active')) active @endif
                        " href="{{ route('admin.orders.active') }}">Active
                        Orders</a>
                    <a class="list-group-item dropdown-item bg-dark
                    @if (request()->routeIs('admin.orders.completed')) active @endif"
                        href="{{ route('admin.orders.completed') }}">Completed
                        Orders</a>
                    <a class="list-group-item dropdown-item bg-dark
                    @if (request()->routeIs('admin.orders.cancelled')) active @endif
                        "
                        href="{{ route('admin.orders.cancelled') }}">Cancelled
                        Orders</a>
                </div>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="collapse"
                data-mdb-target="#products" aria-mdb-expanded="false">
                Products
            </a>
            <!-- Dropdown menu -->
            <div class="collapse list-group pe-4 small
            @if (request()->routeIs('admin.products') ||
                request()->routeIs('admin.products.create') || request()->routeIs('admin.variants')) show @endif
                " id="products">
                <div class="dropdown-menu-dark">
                    <a class="list-group-item bg-dark dropdown-item" href="{{ route('admin.products') }}">View
                        Products</a>
                    <a class="list-group-item bg-dark dropdown-item"
                        href="{{ route('admin.variants') }}">Variations</a>
                    <a class="list-group-item dropdown-item bg-dark" href="{{ route('admin.products.create') }}">Add
                        Product</a>
                </div>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="collapse"
                data-mdb-target="#discounts" aria-mdb-expanded="false">
                Discounts
            </a>
            <!-- Dropdown menu -->
            <div class="collapse list-group list-group-flush pe-4 small" id="discounts">
                <div class="dropdown-menu-dark">
                    <a class="list-group-item dropdown-item bg-dark" href="#">Product Discounts</a>
                    <a class="list-group-item dropdown-item bg-dark" href="#">Add Discount</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link
            @if (request()->routeIs('admin.warehouse')) active @endif
                " aria-current="page" href="{{ route('admin.warehouse') }}">Warehouses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link
            @if (request()->routeIs('admin.categories')) active @endif
                " aria-current="page" href="{{ route('admin.categories') }}">Categories</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="collapse"
                data-mdb-target="#pages" aria-mdb-expanded="false">
                Pages
            </a>
            <!-- Dropdown menu -->
            <div class="collapse list-group list-group-flush pe-4 small" id="pages">
                <div class="dropdown-menu-dark">
                    <a class="list-group-item dropdown-item bg-dark" href="#">View all pages</a>

                    <a class="list-group-item dropdown-item bg-dark" href="#">Add pages</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Customers</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="collapse"
                data-mdb-target="#admin" aria-mdb-expanded="false">
                Setting
            </a>
            <!-- Dropdown menu -->
            <div class="collapse list-group list-group-flush pe-4 small @if (request()->
                routeIs('setting.*')) show @endif" id="admin">
                <div class="dropdown-menu-dark">
                    <a class="list-group-item dropdown-item bg-dark @if (request()->routeIs('admin.setting.site')) active @endif"
                        href="{{ route('admin.setting.site') }}">Site
                        Setting</a>
                    <a class="list-group-item dropdown-item bg-dark" href="#">Carousel</a>
                </div>
            </div>
        </li>
    </ul>
</div>
