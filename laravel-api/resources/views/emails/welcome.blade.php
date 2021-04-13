@component('mail::message')

Welcome {{ $user->name }},
Thanks For beign Part of Our Comunity.

{{ config('app.name') }}
@endcomponent
