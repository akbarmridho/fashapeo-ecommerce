<div class="card mb-3">
    <div class="row g-0">
        <div class="col-3">
            <img src="{{ $item->image->url }}" alt="" class="img-fluid" />
        </div>
        <div class="col-9">
            <div class="card-body">
                <h5 class="card-title">{{ $item->name }}</h5>
                @isset($item->variant)
                    <h6 class="card-subtitle text-muted mb-3">Variant: {{ $item->variant }}</h6>
                @endisset
                <p class="card-text text-danger fw-bold h6 mb-3">
                    @if ($item->product_summary['price_cut'] == 0)
                        {{ $item->product_summary['final_price'] }}
                    @else
                        <del><span class="text-muted">{{ $item->product_summary['price'] }}</span></del>
                        {{ $item->product_summary['final_price'] }}
                    @endif
                </p>
                <p class="card-text">Quantity: {{ $item->quantity }}</p>
                <p class="card-text">Notes: {{ $item->note }}</p>
            </div>
        </div>
    </div>
</div>
