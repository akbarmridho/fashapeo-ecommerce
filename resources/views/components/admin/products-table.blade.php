<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">SKU</th>
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
            <td scope="row">{{ $product->sku }}</td>
            <td>
                {{ $product->name }}
            </td>
            @if($product->max_price === $product->min_price)
            <td>{{ $product->max_price }}</td>
            @else
            <td>{{ $product->min_price ' -- ' $product->max_price }}</td>
            @endif
            <td>{{ $product->stock }}</td>
            <td>
                <ul class="list-unstyled mb-0">
                    <li><i class="far fa-clock pe-1"></i>{{ $product->created_at }}</li>
                    <li><i class="fas fa-truck pe-1"></i>{{ $product->weight }}</li>
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
                            <a class="dropdown-item" href="#">View</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Archive</a>
                        </li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <a class="dropdown-item" href="#">Delete</a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
