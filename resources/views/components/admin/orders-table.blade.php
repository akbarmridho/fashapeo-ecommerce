<div class="table-responsive">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col" style="min-width:120px">Order Id</th>
      <th scope="col">Products</th>
      <th scope="col">Total price</th>
      <th scope="col">Date</th>
      <th scope="col">Status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @if($orders->isEmpty())
    <tr>
        <td colspan="6">
            <h4>No orders found!</h4>
        </td>
    </tr>
    @else
    @foreach($orders as $order)
    <tr class="">
      <th scope="row">{{ $order->order_number }}</th>
      <td>
          @foreach($order->items as $item)
            {{ $item->name . ', ' $item->variant . $item->quantity .' pcs'}} <br>
            Note: {{ $item->note }}
          @endforeach
      </td>
      <td>Rp1.000.000</td>
      <td>
          Created at: {{ $order->created_at }} <br>
          Updated at: {{ $order->updated_at }} <br>
          @if($order->is_success !== null)
          Completed at: {{ $order->competed_at}}
          @endif
      </td>
      <td>{{ $order->recent_status->name }}</td>
      <td>
          <div class="btn-group">
            <a href="{{ route('admin.order.detail', ['product' => $order->id]) }}" class="btn btn-primary btn-sm" type="button">Detail</a>
                <button
                    type="button"
                    class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split"
                    data-mdb-toggle="dropdown"
                    aria-expanded="false"
                >
                <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    @if($order->is_success === null)
                    <li>
                        <form action="{{ route('admin.order.complete', ['order' => $order->id]) }}" method="POST">
                        @csrf
                        @method('put')
                            <button class="dropdown-item" type="submit">Force Complete</button>
                        </form>
                    </li>
                    <li>
                        <form action="{{ route('admin.order.cancel', ['order' => $order->id]) }}" method="POST">
                        @csrf
                        @method('put')
                            <button class="dropdown-item" type="submit">Force Cancel</button>
                        </form>
                    </li>
                    @endif
                    <li>
                        <form action="{{ route('admin.order.delete', ['order' => $order->id]) }}" method="POST">
                        @csrf
                        @method('delete')
                            <button class="dropdown-item" type="submit">Force Delete</button>
                        </form>
                    </li>
                    </ul>
                </div>
      </td>
    </tr>
    @endforeach
    @endif
  </tbody>
</table>
</div>