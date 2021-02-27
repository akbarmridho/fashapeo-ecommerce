@component('mail::message')
    An email from {{ $content['name'] }}:

    {{ $content['message'] }}

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
