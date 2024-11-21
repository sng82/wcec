<x-mail::message>
# CPR Notification

A CPR fee has been paid via the website.

Applicant name: {{$user->first_name . ' ' . $user->last_name}}.<br>
The fee which has been paid: {{ str($order->product_name)->headline() }}.<br>

<x-mail::panel>
## Application Overview

Registration fee paid: {{ $user->registration_fee_paid ? 'Yes' : 'No' }}<br>
Submission fee paid: {{ $user->submission_fee_paid ? 'Yes' : 'No' }}<br>
Expression of Interest: {{ empty($user->eoi_status ?? '') ? 'Not submitted' : str($user->eoi_status)->headline() }}<br>
Submission: {{ empty($user->submission_status ?? '') ? 'Not submitted' : str($user->submission_status)->headline() }}<br>
</x-mail::panel>

<br>Visit the <a href="{{ config('app.url') . '/cpr/dashboard' }}">Chartered Practitioners Portal</a> for further details.<br>

<x-mail::button :url="config('app.url') . '/cpr/dashboard'">
Chartered Practitioners Portal
</x-mail::button>

</x-mail::message>
