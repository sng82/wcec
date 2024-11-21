<x-mail::message>
# Expression of Interest

Dear {{$user->first_name . ' ' . $user->last_name}},<br><br>
Your Expression of Interest has been assessed and unfortunately, rejected.<br>
The assessor provided the following feedback:

<x-mail::panel>
## Feedback

{!! $eoi->feedback !!}
</x-mail::panel>

<br><br>Thank you for your interest in the Chartered Practitioners Register,<br>
{{ config('app.name') }}
</x-mail::message>
