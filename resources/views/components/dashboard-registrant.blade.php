@props([
    'logged_in_user',
    'renewal_fee',
    'renewal_due',
    'renewal_fee_due',
    'cpd_due',
    'renewal_window',
])

<div {{ $attributes->class(['bg-slate-100 rounded-lg p-3 xl:p-4 shadow']) }}>
    <p class="my-2">
        Hi, {{ explode(" ", $logged_in_user->first_name)[0] }},
    </p>
    <p class="mb-2">
        Welcome to the Chartered Practitioners Portal...
    </p>
    <hr class="my-4">
    <p class="mb-2">
        Your registration expires <span class="font-bold">
            {{ \Carbon\Carbon::parse($logged_in_user->registration_expires_at)->toFormattedDayDateString() }}</span>.
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
                {{ \Carbon\Carbon::parse($logged_in_user->registration_expires_at)->subMonths($renewal_window)->toFormattedDayDateString() }}
            </span>
        </p>
    @endif

</div>

@if($renewal_due)
    <x-stripe-banner />

    <div class="bg-slate-50 rounded-lg p-3 xl:p-4 shadow">
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
                            Last paid: {{ !empty($logged_in_user->renewal_fee_last_paid_at ?: '') ? \Carbon\Carbon::parse($logged_in_user->renewal_fee_last_paid_at)->toFormattedDayDateString() : 'N/A' }}
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
                            Last submitted: {{ !empty($logged_in_user->cpd_last_submitted_at ?: '') ? \Carbon\Carbon::parse($logged_in_user->cpd_last_submitted_at)->toFormattedDayDateString() : 'N/A' }}
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
