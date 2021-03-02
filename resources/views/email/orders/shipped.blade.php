@component('mail::message')
    Your order {{ '#' . $content['order_number'] }} has been shipped.

    Your order is currently shipped with service
    {{ $content['shipment'][0]['courier'] . ' ' . $content['shipment'][0]['service'] }} and tracking number
    {{ $content['shipment'][0]['tracking_number'] }}.

    Don't forget to complete your order in orders menu if it is already arrived.

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
