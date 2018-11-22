@component('mail::message')
# One more step before joining my app!

We need you to confirm your email.

@component('mail::button', ['url' => ''])
Confirm email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
