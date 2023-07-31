@component('mail::message')
# New User Registered!

{{$name}} is registered on yoiur site. <br>
Email Address: {{ $email }}

{{ config('app.name') }}
@endcomponent
