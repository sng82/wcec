<x-mail::message>
# CPR Notification

A submission has been submitted to the Chartered Practitioners Portal.<br><br>
Applicant name: {{$user->first_name . ' ' . $user->last_name}}.<br>

<x-mail::button :url="config('app.url') . '/cpr/dashboard'">
Chartered Practitioners Portal
</x-mail::button>

</x-mail::message>
