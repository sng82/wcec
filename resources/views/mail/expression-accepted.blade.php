<x-mail::message>
# Expression of Interest

Dear {{$user->first_name . ' ' . $user->last_name}},<br><br>
Your Expression of Interest has been accepted.<br>
You may now continue with your application.

<x-mail::button :url="config('app.url') . '/cpr/dashboard'">
Chartered Practitioners Portal
</x-mail::button>

Regards,<br>
{{ config('app.name') }}
</x-mail::message>
