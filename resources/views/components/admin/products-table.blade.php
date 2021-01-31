<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Product Title</th>
            <th scope="col">Price Range</th>
            <th scope="col">Total Stock</th>
            <th scope="col">Info</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if($products->isEmpty())
        <tr><td colspan="5"><h4>No Product Found!</h4></td></tr>
        @else
        @foreach($products as $product)
        <tr>
            <td>
                {{ $product->name }}
            </td>
            @if($product->max_price === $product->min_price)
            <td>{{ $product->max_price }}</td>
            @else
            <td>{{ $product->min_price . ' -- ' . $product->max_price }}</td>
            @endif
            <td>{{ $product->stock }}</td>
            <td>
                <ul class="list-unstyled mb-0">
                    <li><i class="far fa-clock pe-1"></i>{{ $product->created_at }}</li>
                    <li><i class="fas fa-truck pe-1"></i>{{ $product->weight . 'gr'}}</li>
                    <li>
                        <i class="fas fa-shopping-basket pe-1"></i>Sold {{ $product->sold }}
                        times
                    </li>
                </ul>
            </td>
            <td>
                <div class="btn-group">
                    <button class="btn btn-primary btn-sm" type="button">
                        Actions
                    </button>
                    <button
                        type="button"
                        class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split"
                        data-mdb-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.products.edit', ['product' => $product->id]) }}">View</a>
                        </li>
                        <li>
                            <form action="{{ route('admin.products.archive', ['product' => $product->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="dropdown-item" type="submit">Archive</button>
                            </form>
                        </li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <form action="{{ route('admin.products.delete', ['product' => $product->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="dropdown-item" type="submit">Delete</button>
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
