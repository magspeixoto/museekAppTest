@component('mail::message')
# Contact Successful

Dear {{ $user['name'] }},

Thank you for reaching out to us. We will take care of your order as soon as possible.

Thanks,<br>
{{ config('app.name') }}
@endcomponent