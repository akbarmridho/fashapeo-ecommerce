<p class="h4 fw-bold">Order #{{ $order->order_number }}</p>
<dl class="row">
    <dt class="col-sm-3">Order Status</dt>
    <dd class="col-sm-9">{{ $order->recent_status->name }}
    </dd>

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
<p class="h5 mb-3 text-danger fw-bold">Total:
    @isset($order->transaction)
        {{ $order->transaction->transaction_total }}
    @else
        -
    @endisset
</p>
<p class="h4">Order details:</p>
<dl class="row">
    @isset($order->transaction)
        <dt class="col-sm-3 fw-normal">Payment method</dt>
        <dd class="col-sm-9">{{ $order->transaction->payment_method }}</dd>
    @endisset
    @isset($order->shipment)
        <dt class="col-sm-3 fw-normal">Courier service</dt>
        <dd class="col-sm-9">{{ $order->shipment->courier . ' ' . $order->shipment->service }}</dd>

        <dt class="col-sm-3 fw-normal">Tracking Number</dt>
        <dd class="col-sm-9">
            {{ $order->shipment->tracking_number }}
        </dd>
        <dt class="col-sm-3 fw-normal">Delivery Address</dt>
        <dd class="col-sm-9">
            {{ $order->shipment->destination_name . ', ' . $order->shipment->phone }} <br>
            {{ $order->shipment->destination_delivery . ' ' . $order->shipment->destination_district . ', ' . $order->shipment->postal_code }}
            <br>
            {{ $order->shipment->destination_city . ', ' . $order->shipment->destination_province }}
        </dd>
    @endisset
</dl>
<p class="h4">Order history:</p>
<dl class="row">
    @foreach ($order->status->sortBy('pivot.id') as $status)
        <dt class="col-sm-3 fw-normal">{{ $status->pivot->created_at }}</dt>
        <dd class="col-sm-9">{{ $status->name }} <br> {{ $status->description }}</dd>
    @endforeach
</dl>

@isset($order->shipment->tracking_number)
    <div class="row">
        <form action="{{ route('customer.orders.complete', ['order' => $order]) }}" method="post">
            @csrf
            <button class="btn btn-primary need-confirm" type="submit">Mark As Completed</button>
        </form>
    </div>
@endisset
