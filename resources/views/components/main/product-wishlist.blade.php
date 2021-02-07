<div class="card mb-3">
    <div class="row g-0">
        <div class="col-3">
            <img src="{{ $product->main_image->url }}" alt="" class="img-fluid" />
        </div>
        <div class="col-9">
            <div class="card-body">
                <a class="h5 card-title link-dark"
                    href="{{ route('product', ['product' => $product]) }}">{{ $product->name }}</a>
                <p class="card-text text-danger fw-bold h6 mb-3">
                    <x-main.product-price-tag :price="$product->price" />
                </p>
                <button class="btn btn-secondary btn-rounded" id="wishlist" data-state="selected"
                    data-id="{{ $product->id }}">
                    <i class="fas fa-heart mr-2"></i>
                </button>
            </div>
        </div>
    </div>
</div>
