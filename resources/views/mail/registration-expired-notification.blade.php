<x-mail::message>
# Chartered Practitioners Register - Expired

Dear {{ explode(" ", $user->first_name)[0] }},<br><br>
Your registration with the Chartered Practitioners has expired.<br><br>

Regards,<br>
{{ config('app.name') }}
</x-mail::message>
