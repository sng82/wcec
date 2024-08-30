@props([
    'logged_in_user',
    'next_admission_date',
    'next_admission_date_difference',
    'submitted_eois',
    'submitted_submissions',
    'expiring_registrations',
])

<div {{ $attributes->class(['bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 mb-4 xl:mb-6 shadow-md shadow-slate-300']) }}>
    <p class="mb-4">
        Hi, {{ explode(" ", $logged_in_user->first_name)[0] }},
    </p>
    <p class="mb-4">
        Welcome to the Admin dashboard!
    </p>
    <p class="mb-4">
        Everything currently requiring your attention is listed below. Use the menu on the left to delve deeper into the Chartered Practitioners Portal.
    </p>

    <p class="mb-4">
        The next Admission Date (when accepted applicants will be admitted to the register) is
{{--        around {{ $next_admission_date_difference }}:--}}
        <span class="font-bold">{{ $next_admission_date }}</span>.
    </p>
</div>

<div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 mb-4 xl:mb-6 shadow-md shadow-slate-300" wire:poll.15s="getEOIs">
    <h2 class="text-2xl text-sky-800 border-b-4 border-red-700 pb-2 mb-2">
        Expressions of Interest
    </h2>
    @if($submitted_eois->count() > 0)
        <p class="mb-4">
            Applicants who are waiting for their Expression of Interest to be assessed:
        </p>
        <div class="mt-3 mb-2 overflow-hidden border border-sky-100 rounded-lg shadow-sm overflow-x-auto">
            <table class="table-auto w-full divide-y divide-sky-100 text-sm">
                <thead class="bg-sky-100">
                    <tr class="text-sky-700 divide-x divide-sky-200">
                        <th scope="col" class="px-4 py-2 text-left cursor-pointer ">
                            <div class="flex flex-row justify-between gap-1 content-center">
                                <span class="text-slate-500">
                                    Name
                                </span>
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-2 text-left cursor-pointer">
                            <div class="flex flex-row justify-between gap-1 content-center">
                                <span class="text-slate-500">
                                    Email
                                </span>
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-2 text-left cursor-pointer min-w-32">
                            <div class="flex flex-row justify-between gap-1 content-center">
                                <span class="text-slate-500">
                                    Registration Fee
                                </span>
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-2 text-left">
                            EoI Status
                        </th>
                        <th scope="col" class="px-4 py-2 text-left">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-sky-100">
                    @foreach($submitted_eois as $registrant)
                        <tr wire:key="{{ $registrant->id }}" class="">
                            <td class="px-4 py-2 " >
                                <span class="cursor-pointer" wire:click="openMember({{ $registrant->id }})">
                                    {{ $registrant->first_name . ' ' . $registrant->last_name }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                {{ $registrant->email }}
                            </td>
                            <td class="px-4 py-1">
                                <span class="py-1 px-3 inline rounded-full w-96 {{ $registrant->registration_fee_paid ? 'text-emerald-500 bg-emerald-100' : 'text-slate-500 bg-slate-200' }}">
                                    {{ $registrant->registration_fee_paid ? 'Paid' : 'Not Paid' }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                {{ str($registrant->eoi_status)->title() }}
                            </td>
                            <td class="px-4 py-1">
                                <x-edit-button-fuchsia :href="route('assess-eoi',[$registrant->eoi->id])" class="">
                                    EoI
                                </x-edit-button-fuchsia>
{{--                                <a href="{{ route('assess-eoi',[$registrant->eoi->id]) }}" class="z-10 bg-sky-800 hover:bg-sky-900 text-white rounded-full py-1 px-4">Assess&nbsp;EoI</a>--}}

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="">No Expressions of Interest are awaiting assessment.</p>
    @endif
</div>

<div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 mb-4 xl:mb-6 shadow-md shadow-slate-300" wire:poll.15s="getSubmissions">
    <h2 class="text-2xl text-sky-800 border-b-4 border-red-700 pb-2 mb-2">
        Registration Submissions
    </h2>
    @if($submitted_submissions->count() > 0)
        <p class="mb-4">
            Applicants who have submitted submissions but not yet been accepted:
        </p>
        <div class="mt-3 mb-2 overflow-hidden border border-sky-100 rounded-lg shadow-sm overflow-x-auto">
            <table class="table-auto w-full divide-y divide-sky-100 text-sm">
                <thead class="bg-sky-100">
                    <tr class="text-sky-700 divide-x divide-sky-200">
                        <th scope="col" class="px-4 py-2 text-left ">
                            <div class="flex flex-row justify-between gap-1 content-center">
                                <span class="text-slate-500">
                                    Name
                                </span>
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-2 text-left">
                            <div class="flex flex-row justify-between gap-1 content-center">
                                <span class="text-slate-500">
                                    Email
                                </span>
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-2 text-left">
                            Submission Status
                        </th>
                        <th scope="col" class="px-4 py-2 text-left">
                            Interview Date &amp; Time
                        </th>
                        <th scope="col" class="px-4 py-2 text-left">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-sky-100">
                    @foreach($submitted_submissions as $registrant)
                        <tr wire:key="{{ $registrant->id }}" class="">
                            <td class="px-4 py-2">
                                {{ $registrant->first_name . ' ' . $registrant->last_name }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $registrant->email }}
                            </td>
                            <td class="px-4 py-2">
                                {{ str(str_replace('_', ' ', $registrant->submission_status))->title() }}
                            </td>
                            <td class="px-4 py-2 {{ empty($registrant->submission_interview_at) || $registrant->submission_interview_at > now()
                                        ? ''
                                        : ' text-red-700 '
                            }} ">
                                {{
                                    empty($registrant->submission_interview_at)
                                        ? '-'
                                        : \Carbon\Carbon::parse($registrant->submission_interview_at)->toDayDateTimeString()
                                }}
                            </td>
                            <td class="px-4 py-1">
                                <x-edit-button-fuchsia :href="route('assess-submission', [$registrant->id])" class="">
                                    Submission
                                </x-edit-button-fuchsia>
{{--                                <a href="{{ route('assess-submission',[$registrant->id]) }}" class="z-10 bg-sky-800 hover:bg-sky-900 text-white rounded-full py-1 px-4">Assess&nbsp;Submission</a>--}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="">No Submissions are awaiting assessment.</p>
    @endif
</div>

<div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 mb-4 xl:mb-6 shadow-md shadow-slate-300">
    <h2 class="text-2xl text-sky-800 border-b-4 border-red-700 pb-2 mb-2">
        Expiring Registrations
    </h2>
    @if($expiring_registrations->count() > 0)
        <p class="mb-4">
            {{ $expiring_registrations->count() . 'x' }}
            {{ Str::of('registration')->plural($expiring_registrations->count()) }}
            due to expire within the next 30 days:
        </p>
        <div class="mt-3 mb-2 overflow-hidden border border-red-100 rounded-lg shadow-sm overflow-x-auto">
            <table class="table-auto w-full divide-y divide-red-100 text-sm">
                <thead class="bg-red-100">
                    <tr class="text-red-900 divide-x divide-red-200">
                        <th scope="col" class="px-4 py-2 text-left">
                            Name
                        </th>
                        <th scope="col" class="px-4 py-2 text-left">
                            Email
                        </th>
                        <th scope="col" class="px-4 py-2 text-left">
                            Registration Expires
                        </th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-red-100">
                    @foreach($expiring_registrations as $registrant)
                        <tr wire:key="{{ $registrant->id }}" wire:click="openMember({{ $registrant->id }})"
                            class="cursor-pointer text-slate-500 hover:text-sky-600 hover:bg-slate-100">
                            <td class="px-4 py-2">
                                {{ $registrant->first_name . ' ' . $registrant->last_name }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $registrant->email }}
                            </td>
                            <td class="px-4 py-2 text-sm">
                                {{ \Carbon\Carbon::parse($registrant->registration_expires_at)->toFormattedDayDateString() }}
                                ({{ \Carbon\Carbon::parse(now()->format('y-m-d'))->diff($registrant->registration_expires_at->format('y-m-d'), \Carbon\CarbonInterface::DIFF_ABSOLUTE) }})
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    @else
        <p class="mb-4">No registrations are due to expire within the next 30 days.</p>
    @endif
</div>
