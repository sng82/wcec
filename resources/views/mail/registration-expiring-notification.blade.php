<x-mail::message>
# CPR - Continuous Professional Development Required

Dear {{ explode(" ", $user->first_name)[0] }},<br><br>
Please log in to the Chartered Practitioners Portal on the Worshipful Company of
Environmental Cleaners website to upload your CPD
(Continuous Professional Development) and pay your renewal fee.<br><br>
Failure to do so before {{ \Carbon\Carbon::parse($registrant->registration_expires_at)->toFormattedDayDateString() }}
will result in being removed from the register.

<x-mail::button :url="config('app.url') . '/login'">
Chartered Practitioners Portal Login
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
