<div class="col-12 mb-4">
    <h5 class="">Search by Category</h5>
    <hr class="divider" width="40%">
    <form action="">
        <div class="input-group my-3">
            <input name="term" type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                aria-describedby="search-addon" value="@if (request()->has('term')) {{ request()->term }} @endif"/>
            <button class="btn input-group-text border-0 shadow-0" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </form>
</div>

<div class="col-12 mb-4">
    <h5 class="">Categories</h5>
    <hr class="divider" width="40%">
    @foreach ($categories as $parent)
        <div>
            <a href="#{{ $parent->name }}" data-mdb-toggle="collapse" class="text-body">{{ $parent->name }}</a>
            <div class="collapse small" id="{{ $parent->name }}">
                <ul class="list-unstyled ps-3">
                    @foreach ($parent->children as $child)
                        <li>
                            <a href="{{ route('products.category', ['category' => $child]) }}"
                                class="text-body">{{ $child->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
</div>

<div class="col-12 mb-4">
    <form action="">
        <h5 class="">Filter by price range</h5>
        <hr class="divider" width="40%">
        <div class="input-group my-3">
            <input name="min" type="number" min="0" class="form-control" placeholder="Minimum price" />
            <span class="input-group-text" id="basic-addon2">Rp</span>
        </div>
        <div class="input-group mb-3">
            <input name="max" type="number" min="0" class="form-control" placeholder="Maximum price" />
            <span class="input-group-text" id="basic-addon2">Rp</span>
        </div>
        <button class="btn btn-danger" type="submit">Filter</button>
    </form>
</div>
