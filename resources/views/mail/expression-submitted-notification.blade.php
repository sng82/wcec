<x-mail::message>
# CPR Notification

An Expression of Interest has been submitted to the Chartered<br>Practitioners Portal.<br><br>
Applicant name: {{$user->first_name . ' ' . $user->last_name}}.<br>

<x-mail::button :url="config('app.url') . '/cpr/dashboard'">
Chartered Practitioners Portal
</x-mail::button>

</x-mail::message>
