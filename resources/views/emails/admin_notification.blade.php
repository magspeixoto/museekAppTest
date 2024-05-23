@component('mail::message')
# New Order Received

**User Details:**
- Name: {{ $user['name'] }}
- Email: {{ $user['email'] }}


**Product:**
- Name: {{ $product->name }}
- Description: {{ $product->description }}
- Price: {{ $product->price }}



Thanks,<br>
{{ config('app.name') }}
@endcomponent