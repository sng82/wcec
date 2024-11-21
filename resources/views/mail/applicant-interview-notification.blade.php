<x-mail::message>
# Chartered Practitioners Register: Interview Notification

Dear {{ explode(" ", $user->first_name)[0] }},<br><br>
Your registration submission has been received.<br>
An interview has been scheduled at the following date and time:<br><br>
<strong>{{ \Carbon\Carbon::parse($user->submission_interview_at)->toDayDateTimeString() }}</strong><br><br>
Please reply to this email confirming that this date and time is agreeable, or to request a different date and time if not.<br><br>
@if(!empty($feedback))
<x-mail::panel>
## Feedback

{!! $feedback !!}
</x-mail::panel>
<br>
@endif
Regards,<br>
{{ config('app.name') }}
</x-mail::message>
