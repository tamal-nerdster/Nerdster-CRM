@component('mail::message')
# Welcome, {{ $userName }}!

Thank you for registering on our platform. Your login credentials are as follows:

- **Email:** {{ $userEmail }}
- **Password:** {{ $plainPassword }}

Please make sure to change your password after logging in for security reasons.

We are excited to have you on board!

@component('mail::button', ['url' => 'https://yourwebsite.com/login'])
Login to Your Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
