<form action="{{ route('customer.order.shipment.finalize', ['order' => $order]) }}" method="post">
    @csrf
    <div class="mt-5">
        <p class="h4 fw-bold">Order #{{ $order->order_number }}</p>
        <dl class="row">
            <dt class="col-sm-3">Order Date</dt>
            <dd class="col-sm-9">
                <p>{{ $order->created_at }}</p>
            </dd>
        </dl>
        <p class="h4">Product details:</p>
        @foreach ($order->items as $item)
            <x-main.product-overview :item="$item" />
        @endforeach
        <hr class="divider">
        <p class="h4">Address details:</p>
        <div class="col-12 col-md-8 col-lg-6 my-4">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Delivery Address</h5>
                    <p class="card-text">
                        {{ $order->shipment->destination_name . ', ' . $order->shipment->phone }} <br>
                        {{ $order->shipment->destination_delivery . ' ' . $order->shipment->destination_district . ', ' . $order->shipment->postal_code }}
                        <br>
                        {{ $order->shipment->destination_city . ', ' . $order->shipment->destination_province }}
                    </p>
                </div>
            </div>
        </div>
        <p class="h4">Shipment Options:</p>
        <div class="row my-3">
            <select class="select-description" name="shipment" id="shipmentOption">
                @foreach ($shipments as $shipment)
                    <optgroup label="{{ $shipment['name'] }}">
                        @foreach ($shipment['costs'] as $service)
                            <option data-price="{{ $service['cost']['value'] }}"
                                data-description="{{ config('payment.currency_symbol') . $service['cost']['value'] . '(' . $service['cost']['etd'] . ' days)' }}"
                                value="{{ implode(':', [$shipment['name'], $service['service']]) }}">
                                {{ $service['service'] }}</option>
                        @endsection
                </optgroup>
            @endforeach
        </select>
    </div>
</div>
<p class="h4">Overview</p>
<dl class="row">
    <dt class="col-sm-3">Products</dt>
    <dd class="col-sm-9"><span id="subtotal"
            data-subtotal="{{ $order->subtotal['int'] }}">{{ $order->subtotal['sym'] }}</span></dd>
    <dt class="col-sm-3">Shipment</dt>
    <dd class="col-sm-9">
        {{ config('payment.currency_symbol') }} <span id="shipmentCost">0</span>
    </dd>
    <dt class="col-sm-3">Total</dt>
    <dd class="col-sm-9">Rp <span id="orderTotal">0</span></dd>
</dl>
<button class="btn btn-primary float-end" type="submit">Proceed to Payment</button>
</form>
