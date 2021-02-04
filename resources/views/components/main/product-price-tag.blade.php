@if($price['has_stock'])
    @if($price['min_price'] === $price['max_price'])
        @if($price['max_discount'] == 0 && $price['min_discount'] == 0)
            {{ $price['min_final'] }}
        @else
            {{ $price['min_final'] }}
        @endif
    @else
        @if($price['max_discount'] == 0 && $price['min_discount'] == 0)
            {{ $price['min_final'] . ' -- ' . $price['max_final']}}
        @elseif($price['min_discount'] > 0 && $price['max_discount'] > 0)
            <del><span class="text-muted">{{ $price['min_price'] }}</span></del>
            {{ $price['min_final'] . ' -- '}}
            <del><span class="text-muted">{{ $price['max_price'] }}</span></del>
            {{ $price['max_final'] }}
        @elseif($price['min_discount'] > 0)
            <del><span class="text-muted">{{ $price['min_price'] }}</span></del>
            {{ $price['min_final'] . ' -- '}}
            {{ $price['max_final'] }}
        @elseif($price['max_discount'] > 0)
            {{ $price['min_final'] . ' -- '}}
            <del><span class="text-muted">{{ $price['max_price'] }}</span></del>
            {{ $price['max_final'] }}
        @endif
    @endif
@else
    <del><span class="text-muted">{{ $price['min_price'] }}</span></del>
    Out of stock
@endif