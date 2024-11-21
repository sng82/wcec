<x-mail::message>
# Chartered Practitioners Register - Renewal

Dear {{ explode(" ", $user->first_name)[0] }},<br><br>
Your CPD (Continuous Professional Development) and renewal fee are due before
<strong>{{ \Carbon\Carbon::parse($user->registration_expires_at)->toFormattedDayDateString() }}</strong>.<br><br>
Both requirements can be actioned from the Chartered Practitioners Portal.<br><br>
Failure to renew will result in removal from the Chartered Practitioners Register.<br>

<x-mail::button :url="config('app.url') . '/login'">
Chartered Practitioners Portal
</x-mail::button>

<br>Regards,<br>
{{ config('app.name') }}
</x-mail::message>
