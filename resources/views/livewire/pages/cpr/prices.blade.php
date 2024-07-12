<div  class="flex h-full w-full overflow-hidden">

    <livewire:cpr.sidebar  />

    <div class="right w-full flex flex-col grow min-w-80 overflow-y-auto">

        <livewire:layout.cpr-navigation />

        <div class="flex flex-col p-3 xl:p-6 gap-5">

            {{--        @dump($upcoming_prices)--}}
            {{--        @dump($upcoming_prices->count())--}}

            @if($upcoming_prices->first())
                <div class="bg-sky-50 rounded-lg p-3 xl:p-4 shadow">
                    <h2 class="text-2xl text-sky-800 border-b-4 border-sky-600 mb-3 pb-2">
                        Scheduled Price Changes
                    </h2>
                    <p class="mb-4">These prices will automatically replace the current prices on the dates shown.</p>
                    <div class="overflow-hidden border border-sky-100 rounded-lg shadow-sm overflow-x-auto">
                        <table class="table-auto w-full divide-y divide-sky-100 text-sm">
                            <thead class="bg-sky-100">
                                <tr class="text-sky-700">
                                    <th scope="col" class="px-4 py-2 text-left min-w-56">Type</th>
                                    <th scope="col" class="px-4 py-2 text-left min-w-28">Amount</th>
                                    <th scope="col" class="px-4 py-2 text-left min-w-44">Start Date</th>
                                    <th scope="col" class=" min-w-28"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-sky-100">
                                @foreach($upcoming_prices as $price)
                                    <tr wire:key="{{ $price->id }}">
                                        <td class="px-4 py-2 text-slate-500">
                                            {{ Str::of($price->price_type)->headline() }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ Number::currency($price->amount, 'GBP') }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ \Carbon\Carbon::parse($price->start_date)->toFormattedDayDateString() }}
                                            {{ $price->end_date !== null ? '(End Date: ' . \Carbon\Carbon::parse($price->end_date)->toFormattedDayDateString() . ')' : '' }}
                                        </td>

                                        <td>
                                            <x-danger-button wire:click="delete({{ $price->id }})"
                                                             wire:confirm="Are you sure you want to delete this scheduled price change?"
                                                             class="ms-3">
                                                {{ __('Delete') }}
                                            </x-danger-button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <div class="bg-teal-50 rounded-lg p-3 xl:p-4 shadow">
                <h2 class="text-2xl text-sky-800 border-b-4 border-teal-600 mb-3 pb-2">
                    Current Prices
                </h2>
                @if($current_prices->count() > 0)
                    <div class="overflow-hidden border border-teal-100 rounded-lg shadow-sm overflow-x-auto">
                        <table class="table-auto w-full divide-y divide-teal-100">
                            <thead class="bg-teal-100">
                                <tr class="text-teal-700 divide-x divide-teal-200">
                                    <th scope="col" class="px-4 py-2 text-left min-w-56">Type</th>
                                    <th scope="col" class="px-4 py-2 text-left min-w-28">Amount</th>
                                    <th scope="col" class="px-4 py-2 text-left min-w-44">Start Date</th>
                                    <th scope="col" class="px-4 py-2 text-left min-w-44">End Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-teal-100">
                                @foreach($current_prices as $price)
                                    <tr wire:key="{{ $price->id }}">
                                        <td class="px-4 py-2  text-slate-500">
                                            {{ Str::of($price->price_type)->headline() }}
                                        </td>
                                        <td class="px-4 py-2 text-slate-500">
                                            {{ Number::currency($price->amount, 'GBP') }}
                                        </td>
                                        <td class="px-4 py-2 text-slate-500">
                                            {{ \Carbon\Carbon::parse($price->start_date)->toFormattedDayDateString() }}
                                        </td>
                                        <td class="px-4 py-2 text-slate-500">
                                            {{ $price->end_date !== null ? \Carbon\Carbon::parse($price->end_date)->toFormattedDayDateString() : 'N/A' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                @else
                    <div class="bg-white rounded-lg p-3 xl:p-4 shadow border border-slate-200">
                        <p>No current prices found!</p>
                    </div>

                @endif
            </div>

            <div class="bg-white rounded-lg p-3 xl:p-4 shadow">
                <h2 class="text-2xl text-sky-800 border-b-4 border-red-700 mb-3 pb-2">
                    New Price
                </h2>
                <p class="mb-4">
                    Schedule price updates for the future here.
                </p>

                <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pt-0 shadow border border-slate-200">
                    <form wire:submit="create">
                        <div class="flex flex-col xl:flex-row">
                            <div class="mt-4">
                                <x-input-label for="price_type" :value="__('Type')" class="mb-2"/>
                                <select wire:model="price_type" name="price_type" id="price_type"
                                        class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-sky-500 rounded-md shadow-sm"
                                        required>
                                    <option value="">Please select...</option>
                                    <option value="registration">Registration</option>
                                    <option value="submission">Submission</option>
                                    <option value="renewal">Renewal</option>
                                </select>
                            </div>

                            <div class="mt-4 xl:ms-3">
                                <x-input-label for="amount" :value="__('Amount')" class="mb-2 xl:ms-4"/>
                                <div class="flex flex-row">
                                    <span class="flex items-center pr-1 font-bold text-slate-400">£</span>
                                    <input wire:model="amount" type="number" name="amount" id="amount"
                                           placeholder="00.00"
                                           class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-sky-500 rounded-md shadow-sm"
                                           min="0" step="any" required>
                                </div>

                            </div>

                            <div class="mt-4 xl:ms-3">
                                <x-input-label for="start_date" :value="__('Start Date')" class="mb-2"/>
                                <x-text-input wire:model="start_date" id="start_date"
                                              class="block mt-1 w-full" type="date"
                                              name="start_date" required autocomplete="date"/>
                            </div>

                            <div>
                                <x-primary-button class="mt-4 xl:mt-12 xl:ms-3">
                                    {{ __('Submit') }}
                                </x-primary-button>
                            </div>

                        </div>
                        <div class="flex flex-row">
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2"/>
                        </div>
                    </form>
                </div>


                <p class="mt-6">
                    Note that:
                </p>
                <ul class="list-disc ml-5">
                    <li>New prices will automatically come into effect on the date you specify.</li>
                    <li>When a new prices is added, an end date will be added to the current (outgoing) price
                        automatically.
                    </li>
                    <li>If a new price of the type you're adding is already scheduled, adding another one here will
                        replace it.
                    </li>
                </ul>
            </div>

            <div class="bg-amber-50 block rounded-lg p-3 xl:p-4 shadow">
                <h2 class="text-2xl text-sky-800 border-b-4 border-amber-600 mb-3 pb-2">
                    Historic Prices
                </h2>
                <p class="mb-4">An archive of prices as they were at various points in the past.</p>

                @if($archived_prices->count() > 0)
                    <div class="overflow-hidden border border-amber-100 rounded-lg shadow-sm overflow-x-auto">
                        <table class="table-auto w-full divide-y divide-amber-100">
                            <thead class="bg-amber-100">
                                <tr class="text-amber-700">
                                    <th scope="col" class="px-4 py-2 text-left min-w-56">Type</th>
                                    <th scope="col" class="px-4 py-2 text-left min-w-28">Amount</th>
                                    <th scope="col" class="px-4 py-2 text-left min-w-44">Start Date</th>
                                    <th scope="col" class="px-4 py-2 text-left min-w-44">End Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-amber-100">
                                @foreach($archived_prices as $price)
                                    <tr wire:key="{{ $price->id }}">
                                        <td class="px-4 py-2">
                                            {{ Str::of($price->price_type)->headline() }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ Number::currency($price->amount, 'GBP') }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ \Carbon\Carbon::parse($price->start_date)->toFormattedDayDateString() }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $price->end_date !== null ? \Carbon\Carbon::parse($price->end_date)->toFormattedDayDateString() : 'N/A' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="bg-white rounded-lg p-3 xl:p-4 shadow border border-slate-200">
                        <p>No archived prices found.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
