<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" style="min-width:120px">Order Number</th>
                <th scope="col">Products</th>
                <th scope="col">Total price</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($orders->isEmpty())
                <tr>
                    <td colspan="6">
                        <h4>No orders found!</h4>
                    </td>
                </tr>
            @else
                @foreach ($orders as $order)
                    <tr class="">
                        <th scope="row">#{{ $order->order_number }}</th>
                        <td>
                            @foreach ($order->items as $item)
                                {{ $item->name }},
                                @isset($item->variant)
                                    {{ ' ' . $item->variant }},
                                @endisset
                                {{ $item->quantity . 'pcs' }}
                                <br>
                                Note: {{ $item->note }}
                            @endforeach
                        </td>
                        <td>
                            @isset($order->transaction)
                                {{ $order->transaction->transaction_total }}
                            @else
                                -
                            @endisset
                        </td>
                        <td>
                            Created at: {{ $order->created_at }} <br>
                            Updated at: {{ $order->updated_at }} <br>
                            @if ($order->is_success !== null)
                                Completed at: {{ $order->competed_at }}
                            @endif
                        </td>
                        <td>{{ $order->recent_status->name }}</td>
                        <td>
                            <a href="{{ route('customer.orders.show', ['order' => $order]) }}"
                                class="btn btn-primary btn-sm" type="button">Detail</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
