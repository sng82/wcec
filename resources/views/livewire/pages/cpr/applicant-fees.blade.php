{{--<div class="flex h-full w-full overflow-y-auto">--}}

{{--    <livewire:cpr.sidebar/>--}}

{{--    <div class="right w-full flex grow flex-col overflow-y-auto">--}}

{{--        <livewire:layout.cpr-navigation/>--}}

{{--        <div class="py-4 px-6">--}}

{{--            <div class="bg-slate-50 rounded-lg p-3 xl:p-4 mt-6 border border-slate-200 shadow">--}}
{{--                <h1 class="text-3xl text-sky-800 border-b-4 border-red-600 pb-2 mb-4">--}}
{{--                    Fees Payable--}}
{{--                </h1>--}}

{{--                <p class="mb-6">--}}
{{--                    The following fees must be paid before you can be added to the Chartered Practitioners Register.--}}
{{--                </p>--}}

{{--                <div class="mt-3 mb-2 overflow-hidden border border-slate-200 rounded-lg shadow-sm overflow-x-auto">--}}
{{--                    <table class="table-auto w-full divide-y divide-slate-100 text-left">--}}
{{--                        <thead class="bg-slate-100">--}}
{{--                            <tr class="text-slate-500 divide-x divide-slate-200">--}}
{{--                                <th scope="col" class="px-4 py-2">Name</th>--}}
{{--                                <th scope="col" class="px-4 py-2 min-w-28">Amount</th>--}}
{{--                                <th scope="col" class="px-4 py-2 min-w-40">Status</th>--}}
{{--                                <th scope="col" class="px-4 py-2 min-w-96">Description</th>--}}
{{--                                <th scope="col" class="px-4 py-2 min-w-40">Action</th>--}}
{{--                            </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody class="bg-white divide-y divide-slate-100">--}}
{{--                            <tr class="text-slate-500--}}
{{--                            {{ Auth::user()->registration_fee_paid ? 'bg-white' : 'bg-red-50' }}--}}
{{--                            ">--}}
{{--                                <td class="px-4 py-1">--}}
{{--                                    Expression of Interest Fee--}}
{{--                                </td>--}}
{{--                                <td class="px-4 py-1">--}}
{{--                                    £{{ $registration_fee->amount }}--}}
{{--                                </td>--}}
{{--                                <td class="px-4 py-2">--}}
{{--                                    @if (Auth::user()->registration_fee_paid)--}}
{{--                                        <div class="flex flex-row w-fit gap-2 items-center text-green-500 text-lg font-semibold italic me-3 border-2 border-green-500 rounded-full px-4">--}}
{{--                                            <span>Paid</span>--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-5">--}}
{{--                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />--}}
{{--                                            </svg>--}}
{{--                                        </div>--}}
{{--                                    @else--}}
{{--                                        <div class="flex items-center text-red-500">--}}
{{--                                            <span class="text-lg font-semibold me-3 border-2 border-red-500 bg-white rounded-full px-4">--}}
{{--                                                Not Paid--}}
{{--                                            </span>--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td class="px-4 py-1">--}}
{{--                                    <p>The Expression of Interest Fee must be paid before your Expression of Interest will be assessed.</p>--}}
{{--                                </td>--}}
{{--                                <td class="px-4 py-2">--}}
{{--                                    @if (!Auth::user()->registration_fee_paid)--}}
{{--                                        <div class="flex items-center text-red-500">--}}
{{--                                            <button wire:click="payEOI" class="bg-fuchsia-600 hover:bg-fuchsia-700 pl-4 pr-1 gap-2 py-1 text-white rounded-full flex flex-row">--}}
{{--                                                Pay Now--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">--}}
{{--                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />--}}
{{--                                                </svg>--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                </td>--}}

{{--                            </tr>--}}
{{--                            <tr class="text-slate-500--}}
{{--                            {{ Auth::user()->application_fee_paid ? 'bg-white' : 'bg-red-50' }}--}}
{{--                            ">--}}
{{--                                <td class="px-4 py-1">--}}
{{--                                    Submission Fee--}}
{{--                                </td>--}}
{{--                                <td class="px-4 py-1">--}}
{{--                                    £{{ $submission_fee->amount }}--}}
{{--                                </td>--}}
{{--                                <td class="px-4 py-2">--}}
{{--                                    @if (Auth::user()->submission_fee_paid)--}}
{{--                                        <div class="flex flex-row w-fit gap-2 items-center text-green-500 text-lg font-semibold italic me-3 border-2 border-green-500 rounded-full px-4">--}}
{{--                                            <span>Paid</span>--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-5">--}}
{{--                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />--}}
{{--                                            </svg>--}}
{{--                                        </div>--}}
{{--                                    @else--}}
{{--                                        <div class="flex items-center text-red-500">--}}
{{--                                            <span class="text-lg font-semibold me-3 border-2 border-red-500 bg-white rounded-full px-4">--}}
{{--                                                Not Paid--}}
{{--                                            </span>--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td class="px-4 py-1">--}}
{{--                                    <p>The Submission Fee must be paid before your submission will be assessed.</p>--}}
{{--                                </td>--}}
{{--                                <td class="px-4 py-2">--}}
{{--                                    @if (!Auth::user()->submission_fee_paid)--}}
{{--                                        <div class="flex items-center text-red-500">--}}
{{--                                            <button wire:click="paySubmission" class="bg-fuchsia-600 hover:bg-fuchsia-700 pl-4 pr-1 gap-2 py-1 text-white rounded-full flex flex-row">--}}
{{--                                                Pay Now--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">--}}
{{--                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />--}}
{{--                                                </svg>--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                </td>--}}

{{--                            </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}

{{--                <p class="my-6">--}}
{{--                    A subscription fee of £{{ $renewal_fee->amount }} will be payable annually on the anniversary of you being added to the Chartered Practitioners Register.--}}
{{--                </p>--}}

{{--            </div>--}}

{{--        </div>--}}

{{--    </div>--}}
{{--</div>--}}
