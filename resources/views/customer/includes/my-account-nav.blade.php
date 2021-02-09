<div class="p-4 shadow-1">
    <div class="row mb-4 p-2">
        <div class="col-4">
            <img src="/img/avatar.png" alt="" class="img-fluid rounded-circle">
        </div>
        <div class="col-8 d-flex align-items-center">
            <p class="fw-bold h5">{{ $customer->name }}</p>
        </div>
    </div>
    <div class="list-group">
        <a href="{{ route('customer.dashboard') }}" class="list-group-item list-group-item-action
  @if (request()->routeIs('customer.dashboard')) active @endif
            " aria-current="true">
            Dashboard
        </a>
        <a href="{{ route('customer.notification') }}" class="list-group-item list-group-item-action
  @if (request()->routeIs('customer.notification')) active @endif
            ">Notifications</a>
        <a href="{{ route('customer.orders') }}" class="list-group-item list-group-item-action
  @if (request()->routeIs('customer.orders')) active @endif
            ">Orders</a>
        <a href="{{ route('customer.address') }}" class="list-group-item list-group-item-action
  @if (request()->routeIs('customer.address.*') || request()->routeIs('customer.address')) active @endif
            ">Address</a>
        <a href="{{ route('customer.profile') }}" class="list-group-item list-group-item-action
  @if (request()->routeIs('customer.profile')) active @endif
            ">Edit Account</a>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="list-group-item list-group-item-action" type="submit">Logout</button>
        </form>
    </div>
</div>
