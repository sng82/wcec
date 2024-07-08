<x-mail::message>
# Expression of Interest

Dear {{$user->first_name . ' ' . $user->last_name}},<br>
Your Expression of Interest has been assessed but not accepted.<br>
The assessor provided the following feedback:

<x-mail::panel>
## Feedback

{!! $eoi->feedback !!}
</x-mail::panel>


You may update your Expression of Interest, taking the supplied feedback into consideration, and resubmit in the Chartered Practitioners Portal.

<x-mail::button :url="config('app.url') . '/cpr/dashboard'">
Chartered Practitioners Portal
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
