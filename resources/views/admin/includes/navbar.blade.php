<nav class="navbar navbar-expand navbar-light bg-light">
    <button class="btn shadow-0" id="sidenavCollapse" type="button">
        <i class="fas fa-bars"></i>
    </button>
    <div class="container-fluid">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink"
                    role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                    <img src="/images/avatar.png" class="rounded-circle" height="22" alt="" loading="lazy" />
                    @if (auth('admin')->user()->notification_count > 0)
                        <span class="badge bg-danger badge-dot"></span>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="{{ route('admin.my-account') }}">My profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.notification') }}">Notifications
                            <span
                                class="badge rounded-pill bg-danger float-end">{{ auth('admin')->user()->notification_count }}</span>
                        </a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="dropdown-item" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
