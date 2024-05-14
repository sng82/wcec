<div class="flex flex-col flex-grow p-6 gap-5 overflow-y-auto">

    <div class="bg-slate-50 rounded-lg p-6 shadow">
        <h2 class="text-2xl text-sky-800 border-b-4 border-red-700 mb-3 pb-2">
            Upcoming Submission Dates
        </h2>
        <p class="mb-3">
            Applicants who have had their submissions accepted will become members on the next date shown here.
        </p>

        <div class="overflow-hidden border border-slate-100 rounded-lg shadow-sm">
            <table class="table-auto w-full divide-y divide-slate-100">
                <thead class="bg-slate-200">
                    <tr class="text-slate-700">
                        <th scope="col" class="px-4 py-2 text-left">Submission Date</th>
                        <th scope="col" class="px-4 py-2 text-left">Added By</th>
                        <th scope="col" ></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    @foreach($upcoming_dates as $date)
                        <tr wire:key="{{ $date->id }}">
                            <td class="px-4 py-2">
                                @if($loop->first)
                                    <span class="text-slate-800">
                                        {{ \Carbon\Carbon::parse($date->submission_date)->toFormattedDayDateString() }}
                                    </span>
                                @else
                                    <span class="text-slate-400">
                                        {{ \Carbon\Carbon::parse($date->submission_date)->toFormattedDayDateString() }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                {{ $date->updatedBy->first_name . ' ' . $date->updatedBy->last_name }}
                            </td>
                            <td>
                                <x-danger-button wire:click="delete({{ $date->id }})"
                                                 wire:confirm="Are you sure you want to delete this date?"
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

    <div class="bg-slate-50 rounded-lg p-6 shadow">
        <h2 class="text-2xl text-sky-800 border-b-4 border-red-700 mb-3 pb-2">
            New Submission Date
        </h2>
        <form wire:submit="create">
            <div class="flex flex-row">
                <div>
                    <x-input-label for="date" :value="__('Add a new submission date')" class="mt-4 mb-2" />
                    <x-text-input wire:model="date" id="new_date"
                                  class="block mt-1 w-full" type="date"
                                  name="date" required autocomplete="date" />
                </div>
                <div>
                    <x-primary-button class="mt-12 ms-3">
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>

            </div>
            <div class="flex flex-row">
                <x-input-error :messages="$errors->get('date')" class="mt-2" />
            </div>
        </form>
    </div>

</div>
