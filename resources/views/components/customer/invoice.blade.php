<div class="mt-3">
    <p class="h4 fw-bold">Order #{{ $order->order_number }}</p>
    <dl class="row">
        <dt class="col-sm-3">Order Date</dt>
        <dd class="col-sm-9">
            <p>{{ $order->created_at }}</p>
        </dd>
        <dt class="col-sm-3">Product details:</dt>
        <dd class="col-sm-9">
            @foreach ($order->items as $item)
                <p>{{ $item->name }},
                    @isset($item->variant)
                        {{ $item->variant }} ,
                    @endisset
                    {{ $item->quantity }} pcs
                </p>
            @endforeach
        </dd>
        <dt class="col-sm-3">Products</dt>
        <dd class="col-sm-9">{{ $order->subtotal['sym'] }}</dd>
        <dt class="col-sm-3">Shipment</dt>
        <dd class="col-sm-9">{{ $order->shipment->shipment_price }}</dd>
        <dt class="col-sm-3">Total</dt>
        <dd class="col-sm-9">{{ $order->transaction->transaction_total }}</dd>
    </dl>
    <div class="text-center">
        <button class="btn btn-primary" id="pay-button">Pay Now</button>
    </div>
</div>
