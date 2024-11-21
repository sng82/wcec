@props([
    'logged_in_user',
    'renewal_fee',
    'renewal_due',
    'renewal_fee_due',
    'cpd_due',
    'renewal_window',
    'cpd_template_document'
])

@php
use Carbon\Carbon;
@endphp

@if($logged_in_user->registration_expires_at < now())
    <div class="flex justify-items-start items-center text-lg w-full bg-red-500 text-white p-2 rounded-md mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
        </svg>
        <span>Your registration renewal is overdue.</span>
    </div>
@endif

<div {{ $attributes->class(['bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 mb-4 xl:mb-6 shadow-md shadow-slate-300']) }}>

    <p class="my-2">
        Hi, {{ explode(" ", $logged_in_user->first_name)[0] }},
    </p>
    <p class="mb-2">
        Welcome to the Chartered Practitioners Portal...
    </p>
    <hr class="my-4">

    @if($logged_in_user->registration_expires_at >= now())
        <p class="mb-2">
            Your registration expires <span class="font-bold">{{ carbon::parse($logged_in_user->registration_expires_at)->toFormattedDayDateString() }}</span>.
        </p>
        @if ($renewal_due)
            <p>
                You should submit your CPD (Continual Professional Development) and pay your renewal fee before this
                date to remain registered.
            </p>
        @else
            <p>
                You can submit your CPD and pay your renewal fee on or after
                <span class="font-bold">
                    {{ carbon::parse($logged_in_user->registration_expires_at)->subMonths($renewal_window)->toFormattedDayDateString() }}
                </span>
            </p>
        @endif
    @else
        <p class="mb-2">
            Your registration expired <span class="font-bold text-red-600">
                {{ carbon::parse($logged_in_user->registration_expires_at)->toFormattedDayDateString() }}</span>.
            As such, you have been removed from the Chartered Practitioners Register.
        </p>
        <p class="mb-2">
            You have a short grace period to submit your CPD (Continual
            Professional Development) and pay your renewal fee to reverse this action.
        </p>
        <p class="mb-2">
            Failure to do so will result in your removal from the register becoming permanent.
            At this point, you would have to go through the application process and pay all
            associated fees to re-join the register.
        </p>
    @endif
    <hr class="my-4">
    <p>
        The Continual Professional Development template can be downloaded here:
    </p>
    <div class="flex gap-2 mt-4 mb-2 items-center">
        <a href="/documents/{{ $cpd_template_document->file_name }}"
           class="inline-flex w-fit px-6 py-2 rounded-full bg-sky-600 text-sky-100 hover:text-white align-center"
           download
        >
            <span class="inline-block w-7">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
            </span>
            <span class="inline-block">
            {{ $cpd_template_document->doc_type }} (v{{ $cpd_template_document->version }} {{ $cpd_template_document->release_month }} {{ $cpd_template_document->release_year }})
        </span>
        </a>

    </div>
</div>

@if($renewal_due)
    <x-stripe-banner />

    <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 mb-4 xl:mb-6 shadow-md shadow-slate-300">
        <h2 id="progression" class="text-2xl text-sky-800 border-b-4 border-red-700 pb-2 mb-2">
            Renewal Progression
        </h2>
        <div class="mt-4 mb-4 overflow-hidden border border-slate-200 rounded-lg shadow-sm overflow-x-auto">
            <table class="table-auto w-full divide-y divide-slate-100 text-left">
                <thead class="bg-slate-100">
                    <tr class="text-slate-500 divide-x divide-slate-200">
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Step</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2 min-w-72">Notes</th>
                        <th class="px-4 py-2 min-w-40">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-sky-100 text-slate-600">
                    <tr>
                        <th class="px-4 py-2">
                            1
                        </th>
                        <td class="px-4 py-2">
                            Pay Renewal Fee
                        </td>
                        <td class="px-4 py-2">
                            @if($renewal_fee_due)
                                <div class="flex items-center">
                                    <span class="text-lg font-semibold me-3 border-2 rounded-full px-4 border-amber-500 text-amber-500">
                                       Unpaid
                                    </span>
                                </div>
                            @else
                                <div class="flex flex-row w-fit gap-2 items-center text-green-500 text-lg font-semibold italic me-3 border-2 border-green-500 rounded-full px-4">
                                    <span>Paid</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-sm">
                            Last paid: {{ !empty($logged_in_user->renewal_fee_last_paid_at ?: '') ? carbon::parse($logged_in_user->renewal_fee_last_paid_at)->toFormattedDayDateString() : 'N/A' }}
                        </td>
                        <td class="px-4 py-2">
                            @if($renewal_fee_due)
                                <button type="button" wire:click="payFee('renewal')"
                                        class="bg-fuchsia-600 hover:bg-fuchsia-700 focus:cursor-wait w-fit pl-4 pr-1 gap-2 py-1 text-white rounded-full flex flex-row"
                                >
                                    Pay Now
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                </button>
                            @endif
                        </td>
                    </tr>

                    <tr class="bg-slate-100">
                        <th class="px-4 py-2">
                            2
                        </th>
                        <td class="px-4 py-2">
                            Submit CPD
                        </td>
                        <td class="px-4 py-2">
                            @if($cpd_due)
                                <div class="flex items-center">
                                    <span class="text-lg font-semibold me-3 border-2 rounded-full px-4 border-amber-500 text-amber-500">
                                       Not submitted
                                    </span>
                                </div>
                            @else
                                <div class="flex flex-row w-fit gap-2 items-center text-green-500 text-lg font-semibold italic me-3 border-2 border-green-500 rounded-full px-4">
                                    <span>
                                        Submitted
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>
                                </div>
                            @endif




                        </td>
                        <td class="px-4 py-2 text-sm">
                            Last submitted: {{ !empty($logged_in_user->cpd_last_submitted_at ?: '') ? carbon::parse($logged_in_user->cpd_last_submitted_at)->toFormattedDayDateString() : 'N/A' }}
                        </td>
                        <td class="px-4 py-2">
                            @if($cpd_due)
                                <a href="{{ route('registrant-cpd') }}"
                                   class="bg-sky-600 w-fit pl-4 pr-1 gap-2 py-1 text-white rounded-full flex flex-row hover:bg-sky-700">
                                    View/Edit
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                </a>
                            @endif
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
@endif
