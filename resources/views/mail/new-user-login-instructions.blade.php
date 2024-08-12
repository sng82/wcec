<x-mail::message>
# Welcome to the Chartered Practitioners Portal

Dear {{ explode(" ", $user->first_name)[0] }},<br><br>
A user account has been created for you in the Chartered Practitioners Portal of the Worshipful Company of Environmental Cleaners website.<br><br>
Your account must be secured with a password before you can login. Please set one here:

<x-mail::button :url="config('app.url') . '/forgot-password'">
Request Password Reset
</x-mail::button>

Regards,<br>
{{ config('app.name') }}

<x-slot:subcopy>
If you're having trouble clicking the "Request Password Reset" button, copy and paste the URL below into your web browser: <a href="{{ config('app.url') . '/forgot-password' }}">{{ config('app.url') . '/forgot-password' }}</a>
</x-slot:subcopy>
</x-mail::message>
