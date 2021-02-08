<div class="card">
    <div class="card-header fw-bold bg-light">Order Summary</div>
    <div class="card-body small">
        <div class="d-flex justify-content-between">
            <p class="card-text">Total items</p>
            <p class="card-text">{{ $summary['items'] }}</p>
        </div>
        @if ($summary['discount'] !== 0)
            <div class="d-flex justify-content-between">
                <p class="card-text">Discount</p>
                <p class="card-text">-{{ $summary['discount'] }}</p>
            </div>
        @endif
        <div class="d-flex justify-content-between fw-bold">
            <p class="card-text">Total</p>
            <p class="card-text">{{ $summary['total'] }}</p>
        </div>
    </div>
    <div class="card-footer text-center">
        <form action="{{ route('customer.order.create') }}" method="POST">
            <button class="btn btn-primary" type="submit"><i class="fas fa-shopping-cart me-3"></i>Checkout</button>
        </form>
    </div>
</div>
