@component('mail::message')
    Your order {{ '#' . $content['order_number'] }} has been completed. Thank you for your order and we hope you would
    like to in visit us again.

    Please rate and leave any feedback for every product you had bought

    Sincerely,<br>
    {{ config('app.name') }}
@endcomponent

{{-- button untuk review dan rating --}}
