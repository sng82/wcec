<x-mail::message>
# Expression of Interest

Dear {{$user->first_name . ' ' . $user->last_name}},<br><br>
Your Expression of Interest has been assessed but not accepted.<br>
The assessor provided the following feedback:

<x-mail::panel>
## Feedback

{!! $eoi->feedback !!}
</x-mail::panel>

<br>You may update your Expression of Interest, taking the supplied feedback into consideration, and resubmit in the Chartered Practitioners Portal.

<x-mail::button :url="config('app.url') . '/cpr/dashboard'">
Chartered Practitioners Portal
</x-mail::button>

<br><br>Regards,<br>
{{ config('app.name') }}
</x-mail::message>
