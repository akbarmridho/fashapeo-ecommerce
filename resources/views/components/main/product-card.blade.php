<div class="col-6 col-md-4 col-lg-3">
    <div class="card h-100">
        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
            <img src="{{ $product->main_image->url }}" class="img-fluid" />
            <a href="{{ route('product', ['product' => $product]) }}">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
            </a>
        </div>
        <div class="card-body">
            <a href="{{ route('product', ['product' => $product]) }}"
                class="text-body card-title h5">{{ $product->name }}</a>
            <p class="card-text">
                <x-main.product-price-tag :price="$product->price" />
            </p>
        </div>
    </div>
</div>
