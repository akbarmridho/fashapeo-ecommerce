<div class="card mb-3 product-cart" data-id="{{ $product->id }}">
    <div class="row g-0">
        <div class="col-3">
            <img src="{{ $product->master->main_image->url }}" alt="" class="img-fluid" />
        </div>
        <div class="col-9">
            <div class="card-body">
                <button class="btn btn-sm px-2 rounded-3 shadow-0 btn-danger float-end cart-delete"><i
                        class="fas fa-trash"></i></button>
                <a class="card-title h5 link-dark"
                    href="{{ route('product', ['product' => $product->master]) }}">{{ $product->product_name }}</a>
                @isset($product->variant_name)
                    <h6 class="card-subtitle text-muted mb-3">Variant: {{ $product->variant_name }}</h6>
                @endisset
                <p class="card-text text-danger fw-bold h6">
                    <x-main.variant-price-tag :price="$product->final_price" />
                </p>
                <div class="row mt-3">
                    <div class="col-8">
                        <div class="form-outline">
                            <input name="note" type="text" id="formControlSm"
                                class="form-control form-control-sm cart-note" value="{{ $product->pivot->note }}" />
                            <label class="form-label" for="formControlSm">Note</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group input-group-sm">
                            <button type="button" class="btn btn-sm btn-outline-primary decrement">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" class="form-control text-center quantity"
                                value="{{ $product->pivot->quantity }}" min="1" max="{{ $product->stock }}" />
                            <button type="button" class="btn btn-sm btn-outline-primary increment">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
