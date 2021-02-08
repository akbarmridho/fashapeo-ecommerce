<div class="d-flex align-items-center">
    <div class="d-inline-flex">
        <button class="btn 
          @if (request()->routeIs('customer.order.shipment'))
            btn-primary
          @else
            btn-outline-primary
          @endif
            btn-floating btn-lg">1</button>
        <p class="fw-bold px-2 pt-2">Shipment Options</p>
    </div>
    <div class="flex-fill">
        <hr />
    </div>
    <div class="d-inline-flex">
        <button class="btn 
        @if (request()->routeIs('customer.order.transaction'))
            btn-primary
          @else
            btn-outline-primary
          @endif
        btn-floating btn-lg mr-2">
            2
        </button>
        <p class="fw-bold px-2 pt-2">Payments</p>
    </div>
    <div class="flex-fill">
        <hr />
    </div>
    <div class="d-inline-flex">
        <button class="btn 
        @if (request()->routeIs('customer.order.status.*'))
            btn-primary
          @else
            btn-outline-primary
          @endif
        btn-floating btn-lg mr-2">
            3
        </button>
        <p class="fw-bold px-2 pt-2">Order status</p>
    </div>
</div>
