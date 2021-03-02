@component('mail::message')
    Your order {{ '#' . $content['order_number'] }} payment has been confirmed.

    Your transaction summary:
    Transaction number: {{ $transaction['transaction_number'] }}
    Payment method: {{ $transaction['payment_method'] }}
    Total: {{ config('payment.currency_symbol') . $transaction['total'] }}
    Date completion: {{ $transaction['completed_at'] }}

    Thank you for your order. We will process your order immediately.

    Sincerely,<br>
    {{ config('app.name') }}
@endcomponent
