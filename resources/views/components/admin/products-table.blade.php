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
            <td>{{ $product->price_range }}</td>
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
                    <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}" class="btn btn-primary btn-sm" type="button">Edit</a>
                    <button
                        type="button"
                        class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split"
                        data-mdb-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        @if($product->trashed())
                        <li>
                            <form action="{{ route('admin.products.restore', ['product' => $product->id]) }}" method="POST">
                                @csrf
                                @method('put')
                                <button class="dropdown-item" type="submit">Restore</button>
                            </form>
                        </li>
                        @else
                        <li>
                            <form action="{{ route('admin.products.archive', ['product' => $product->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="dropdown-item" type="submit">Archive</button>
                            </form>
                        </li>
                        @endif
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
