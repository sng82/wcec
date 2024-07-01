@props([
    'logged_in_user',
    'next_submission_date',
    'next_submission_date_difference',
    'registration_fee',
    'application_fee',
])

<div {{ $attributes->class(['bg-slate-50 rounded-lg p-3 xl:p-4 shadow']) }}>
    <p class="mb-2">
        Hi, {{ $logged_in_user->first_name }},
    </p>
    <p class="mb-2">
        Welcome to the Chartered Practitioners Portal.
    </p>
    <hr class="my-4">
    <p class="mb-2">
        Joining the Chartered Practitioners Register is a 4 step process:
    </p>
    <ul class="my-2 ml-12 list-square marker:text-sky-400 space-y-1 max-w-2xl xl:max-w-fit">
        <li>Step 1: Pay your registration fee.</li>
        <li>Step 2: Submit your Expression of Interest.</li>
        <li>Step 3: Pay your application fee.</li>
        <li>Step 4: Submit your application.</li>
    </ul>
    <p class="mb-2">
        Steps 1-3 can be completed in any order, although no submitted Expression of Interest will be assessed unless the registration fee has been paid.
    </p>
    <p class="mb-2">
        Step 4 cannot commence until steps 1 to 3 have been completed and an Expression of Interest has been accepted.
    </p>
    <p class="mb-2">
        Track your progression in the table below.
    </p>
    <hr class="my-4">
    <p class="mb-2">
        This page and the options available to you within the left-hand menu will update as your application progresses. You'll recieve emails informing you of important milestones, but it's advised to log in to the Chartered Practitioners Portal and check progress on occasion.
    </p>
    <hr class="my-4">
    <p class="mb-2">
        Accepted applicants will be added to the Chartered Practitioners Register on the next admission date.
    </p>
    <p class="mb-2">
        the next admission date is <span class="font-bold">{{ $next_submission_date ?? '' }}</span>.
    </p>
</div>

<div class="bg-gradient-to-r from-sky-500 to-teal-500
px-6 py-4 lg:mx-6 rounded-lg flex flex-row items-center justify-center text-white gap-6 shadow-md shadow-slate-400">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-16 text-sky-200 min-w-12">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
    </svg>

{{--    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-16 text-sky-200 min-w-12">--}}
{{--        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />--}}
{{--    </svg>--}}
    <div>
        <p class="text-lg mb-1">
            Payments and subscriptions are processed by our secure payment processor, <a href="https://stripe.com/gb" class="underline hover:text-sky-100" target="_blank">Stripe</a>.
        </p>
        <p class="text-lg">
            No bank or card details are stored within the Chartered Practitioners Portal.
        </p>
    </div>
</div>

<div class="bg-slate-50 rounded-lg p-3 xl:p-4 shadow">
    <h2 class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2 mb-2">
        Application Progression
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
                    <th class="px-4 py-2">1</th>
                    <td class="px-4 py-2">
                        Pay Registration Fee
                    </td>
                    <td class="px-4 py-2">
                        @if($logged_in_user->registration_fee_paid)
                            <div class="flex flex-row w-fit gap-2 items-center text-green-500 text-lg font-semibold italic me-3 border-2 border-green-500 rounded-full px-4">
                                <span>Complete</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </div>
                        @else
                            <div class="flex items-center text-red-600">
                                <span
                                    class="text-lg font-semibold me-3 border-2 border-red-600 rounded-full px-4">
                                   Incomplete
                                </span>
                            </div>
                        @endif
                    </td>
                    <td class="px-4 py-2 italic text-sm">
                        Currently £{{ $registration_fee->amount }}.
                        {{ $logged_in_user->registration_fee_paid ? '' : 'Your Expression of Interest will not be assessed before this payment is made.' }}
                    </td>
                    <td class="px-4 py-2">
                        @if(! $logged_in_user->registration_fee_paid)
                            <button wire:click="payFee('registration')"
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
                <tr>
                    <th class="px-4 py-2">2</th>
                    <td class="px-4 py-2">
                        Submit Expression of Interest
                    </td>
                    <td class="px-4 py-2">
                        @if(!empty($logged_in_user->eoi_status ?? ''))
                            <div class="flex flex-row w-fit gap-2 items-center text-green-500 text-lg font-semibold italic me-3 border-2 border-green-500 rounded-full px-4">
                                <span>{{ Str::of($logged_in_user->eoi_status)->title() }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </div>
                        @else
                            <div class="flex items-center text-red-600">
                                <span
                                    class="text-lg font-semibold me-3 border-2 border-red-600 rounded-full px-4">
                                   Incomplete
                                </span>
                            </div>
                        @endif
                    </td>
                    <td class="px-4 py-2 italic text-sm">
                        @if (empty($logged_in_user->eoi_status ?? ''))
                            You can edit and save progress as often as you like before submitting
                        @elseif(!$logged_in_user->registration_fee_paid && $logged_in_user->eoi_status === 'submitted')
                            Your Expression of Interest has been submitted but you need to pay your registration fee before it will be assessed.
                        @elseif($logged_in_user->registration_fee_paid && $logged_in_user->eoi_status === 'submitted')
                            Your Expression of Interest has been submitted. We'll be in touch once as soon as it has been assessed.
                        @elseif($logged_in_user->eoi_status === 'submitted')
                            We'll be in touch ASAP...
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        @if( !in_array($logged_in_user->eoi_status, ['accepted', 'submitted']))
                            <a href="{{ route('applicant-eoi') }}"
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

                <tr>
                    <th class="px-4 py-2">3</th>
                    <td class="px-4 py-2">
                        Pay Application Fee
                    </td>
                    <td class="px-4 py-2">
                        @if($logged_in_user->application_fee_paid)
                            <div class="flex flex-row w-fit gap-2 items-center text-green-500 text-lg font-semibold italic me-3 border-2 border-green-500 rounded-full px-4">
                                <span>Complete</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </div>
                        @else
                            <div class="flex items-center text-red-600">
                                <span
                                    class="text-lg font-semibold me-3 border-2 border-red-700 rounded-full px-4">
                                   Incomplete
                                </span>
                            </div>
                        @endif
                    </td>

                    <td class="px-4 py-2 italic text-sm">
                        Currently £{{ $application_fee->amount }}.
                        {{ $logged_in_user->application_fee_paid ? '' : 'This can be paid at any time. Your application will not be assessed before this payment is made.' }}
                    </td>
                    <td class="px-4 py-2">
                        @if(! $logged_in_user->application_fee_paid)
                            <button wire:click="payFee('application')"
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
                <tr class="{{ $logged_in_user->eoi_status !== 'accepted' || ! $logged_in_user->registration_fee_paid ? 'bg-slate-100' : '' }}">
                    <th class="px-4 py-2">4</th>
                    <td class="px-4 py-2">
                        Submit Application
                    </td>
                    <td class="px-4 py-2">
                        @if(!empty($logged_in_user->application_status ?? ''))
                            <div class="flex items-center text-sky-500">
                                <span
                                    class="text-lg font-semibold me-3 border-2 border-sky-500 bg-white rounded-full px-4">
                                   {{ Str::of($logged_in_user->application_status)->title() }}
                                </span>
                            </div>
                        @else
                            <div class="flex items-center text-red-600">
                                <span
                                    class="text-lg font-semibold me-3 border-2 border-red-600 rounded-full px-4">
                                   Incomplete
                                </span>
                            </div>
                        @endif
                    </td>

                    <td class="px-4 py-2 italic text-sm">
                        {{ $logged_in_user->eoi_status !== 'accepted' && ! $logged_in_user->eoi_paid ? 'Expression of Interest must be completed, paid for and approved before this step can commence.' : '' }}
                        {{ $logged_in_user->application_status === 'submitted' ? 'We\'ll be in touch ASAP...' : '' }}
                    </td>
                    <td class="px-4 py-2">

                    </td>
                </tr>

            </tbody>
        </table>
    </div>

{{--    <div class="px-6 py-4 mt-4 bg-sky-200 rounded-lg flex flex-row items-center text-sky-700 gap-6">--}}
{{--        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-16 text-sky-500">--}}
{{--            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />--}}
{{--        </svg>--}}
{{--        <div>--}}
{{--            <p class="mb-1">--}}
{{--                Payments and subscriptions are processed and managed by our secure payment processor, <a href="https://stripe.com/gb" class="text-sky-500 hover:underline hover:text-sky-600" target="_blank">StripeController</a>.--}}
{{--            </p>--}}
{{--            <p>--}}
{{--                No bank or card details are stored within the Chartered Practitioners Portal.--}}
{{--            </p>--}}
{{--        </div>--}}
{{--    </div>--}}

</div>
