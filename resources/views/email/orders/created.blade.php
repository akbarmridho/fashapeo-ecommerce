@component('mail::message')
    Your order {{ '#' . $content['order_number'] }} has been created.

    Your order summary:

    @component('mail::table')
        | Order Item | Quantity | Price | Total |
        |:-----------|:---------|:------|:------|
        @foreach ($content['items'] as $key => $item)
            |{{ $item['name'] . $item['variant'] }} <br> {{ 'Note:' . $item['note'] }}|{{ $item['quantity'] }}|
            {{ config('payment.currency_symbol') . $item['price'] }} @isset($item['price_cut']) <br>
                {{ '-' . config('payment.currency_symbol') . $item['price_cut'] }}
            @endisset|{{ config('payment.currency_symbol') . $item['final_price'] }}|
        @endforeach
        |{{ $content['shipment'][0]['courier'] . ' ' . $content['shipment'][0]['service'] }}|1|
        {{ config('payment.currency_symbol') . $content['shipment'][0]['price'] }}|
        {{ config('payment.currency_symbol') . $content['shipment'][0]['price'] }}|
        | | | Total:| {{ config('payment.currency_symbol') . $content['transaction'][0]['total'] }}|
    @endcomponent

    Please complete your payment accordingly.

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
