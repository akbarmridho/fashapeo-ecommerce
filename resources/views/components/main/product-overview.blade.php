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
                    Base price:
                    @if ($item->price_summary['price_cut'] == 0)
                        {{ $item->price_summary['price'] }}
                    @else
                        <del><span class="text-muted">{{ $item->price_summary['price'] }}</span></del>
                        {{ $item->price_summary['after_cut'] }}
                    @endif
                </p>
                <div class="card-text">
                    <p>
                        Quantity: {{ $item->quantity }} <br>
                        Notes: {{ $item->note }}</p>
                    <h6>Subtotal: {{ $item->quantity . 'x' . $item->price_summary['after_cut'] }} =
                        {{ $item->price_summary['final_price'] }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
