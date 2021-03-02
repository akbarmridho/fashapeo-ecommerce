@component('mail::message')
    Your order {{ '#' . $content['order_number'] }} has been cancelled. If you think something went wrong, please contact
    our customer support.

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
