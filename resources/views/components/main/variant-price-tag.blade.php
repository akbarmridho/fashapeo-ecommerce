@if ($price['has_stock'])
    @if ($price['discount_value'] == 0)
        {{ $price['final_price'] }}
    @else
        <del><span class="text-muted">{{ $price['initial_price'] }}</span></del>
        {{ $price['final_price'] }}
    @endif
@else
    <del><span class="text-muted">{{ $price['initial_price'] }}</span></del>
    Out of stock
@endif
