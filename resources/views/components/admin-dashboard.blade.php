@props([
    'logged_in_user',
    'next_submission_date',
    'next_submission_date_difference',
    'submitted_eois',
    'submitted_submissions',
    'expiring_memberships',
])

<div {{ $attributes->class(['bg-slate-50 rounded-lg p-3 xl:p-4 shadow']) }}>
    <p class="mb-4">
        Hi, {{ $logged_in_user->first_name }},
    </p>
    <p class="mb-4">
        Welcome to the Admin dashboard!
    </p>
    <p class="mb-4">
        You can get a quick overview of Expressions of Interest and CPR Applications below. Use the menu on the left to delve deeper into the Chartered Practitioners Portal.
    </p>

    <p class="mb-4">
        The next Submission Date (when accepted applicants will be admitted as members of the CPR) is
{{--        around {{ $next_submission_date_difference }}:--}}
        <span class="font-bold">{{ $next_submission_date }}</span>.
    </p>
</div>

<div class="bg-slate-50 rounded-lg p-3 xl:p-4 shadow">
    <h2 class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2 mb-2">
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
                    @foreach($submitted_eois as $member)
                        <tr wire:key="{{ $member->id }}" class="hover:bg-slate-100 hover:text-sky-600">
                            <td class="px-4 py-2 " >
                                <span class="cursor-pointer" wire:click="openMember({{ $member->id }})">
                                    {{ $member->first_name . ' ' . $member->last_name }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                {{ $member->email }}
                            </td>
                            <td class="px-4 py-1">
                                <span class="py-1 px-3 inline rounded-full w-96 {{ $member->registration_fee_paid ? 'text-emerald-500 bg-emerald-100' : 'text-slate-500 bg-slate-200' }}">
                                    {{ $member->registration_fee_paid ? 'Paid' : 'Not Paid' }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                @if ($member->eoi_status === 'accepted')
                                    Complete.
                                @elseif ($member->eoi_status === 'submitted' && $member->registration_fee_paid)
                                    Ready for assessment.
                                @elseif($member->eoi_status === 'submitted' && !$member->registration_fee_paid)
                                    Submitted. Awaiting payment.
                                @elseif($member->eoi_status !== 'submitted' && $member->registration_fee_paid)
                                    Paid. Awaiting submission.
                                @else
                                    Unpaid. Awaiting submission.
                                @endif
                            </td>
                            <td class="px-4 py-1">
                                <a href="{{ route('assess-eoi',[$member->id]) }}" class="z-10 bg-sky-800 hover:bg-sky-900 text-white rounded-full py-1 px-4">Assess&nbsp;EoI</a>

{{--                                <a href="#" class="z-10 bg-sky-800 hover:bg-sky-900 text-white rounded-full py-1 px-4">Assess</a>--}}
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

<div class="bg-slate-50 rounded-lg p-3 xl:p-4 shadow">
    <h2 class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2 mb-2">
        Applications
    </h2>
    @if($submitted_submissions->count() > 0)
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
                    @foreach($submitted_submissions as $member)
                        <tr wire:key="{{ $member->id }}" wire:click="openMember({{ $member->id }})" class="cursor-pointer hover:bg-slate-100 hover:text-sky-600">
                            <td class="px-4 py-2">
                                {{ $member->first_name . ' ' . $member->last_name }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $member->email }}
                            </td>
                            <td class="px-4 py-1">
                                <span class="py-1 px-3 inline rounded-full w-96 {{ $member->registration_fee_paid ? 'text-emerald-500 bg-emerald-100' : 'text-slate-500 bg-slate-200' }}">
                                    {{ $member->registration_fee_paid ? 'Paid' : 'Not Paid' }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                @if ($member->application_status === 'submitted' && $member->application_fee_paid)
                                    Ready for assessment.
                                @elseif($member->application_status === 'submitted' && !$member->application_fee_paid)
                                    Submitted. Awaiting payment.
                                @elseif($member->application_status !== 'submitted' && $member->application_fee_paid)
                                    Paid. Awaiting submission.
                                @else
                                    Unpaid. Awaiting submission.
                                @endif
                            </td>
                            <td class="px-4 py-1">
                                <a href="#" class="z-10 bg-sky-800 hover:bg-sky-900 text-white rounded-full py-1 px-4">Assess</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="">No Applications are awaiting assessment.</p>
    @endif
</div>

<div class="bg-slate-50 rounded-lg p-3 xl:p-4 shadow">
    <h2 class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2 mb-2">
        Expiring Memberships
    </h2>
    @if($expiring_memberships->count() > 0)
        <p class="mb-4">
            {{ $expiring_memberships->count() . 'x' }}
            {{ Str::of('membership')->plural($expiring_memberships->count()) }}
            due to expire within the next 30 days:
        </p>
        <div class="mt-3 mb-2 overflow-hidden border border-red-100 rounded-lg shadow-sm overflow-x-auto">
            <table class="table-auto w-full divide-y divide-red-100">
                <thead class="bg-red-100">
                    <tr class="text-red-700 divide-x divide-red-200">
                        <th scope="col" class="px-4 py-2 text-left">
                            Name
                        </th>
                        <th scope="col" class="px-4 py-2 text-left">
                            Email
                        </th>
                        <th scope="col" class="px-4 py-2 text-left">
                            Membership Expires
                        </th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-red-100">
                    @foreach($expiring_memberships as $member)
                        <tr wire:key="{{ $member->id }}" wire:click="openMember({{ $member->id }})"
                            class="cursor-pointer text-slate-500 hover:text-sky-600 hover:bg-slate-100">
                            <td class="px-4 py-2">
                                {{ $member->first_name . ' ' . $member->last_name }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $member->email }}
                            </td>
                            <td class="px-4 py-2 text-sm">
                                {{ \Carbon\Carbon::parse($member->membership_expires_at)->toFormattedDayDateString() }}
                                ({{ \Carbon\Carbon::parse(now()->format('y-m-d'))->diff($member->membership_expires_at->format('y-m-d'), \Carbon\CarbonInterface::DIFF_ABSOLUTE) }})
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    @else
        <p class="mb-4">No memberships are due to expire within the next 30 days.</p>
    @endif
</div>
