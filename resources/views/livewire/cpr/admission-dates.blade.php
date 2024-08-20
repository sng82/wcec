<div class="flex flex-col flex-grow p-3 xl:p-6 gap-5 overflow-y-auto">

    <div class="bg-slate-50 rounded-lg p-3 xl:p-4 shadow">
        <h2 class="text-2xl text-sky-800 border-b-4 border-red-700 mb-3 pb-2">
            Upcoming Admission Dates
        </h2>
        <p class="mb-4">
            In order to be added to the CPR on a given Admission Date, an applicant must have been accepted on or before the corresponding Submission Deadline.
        </p>

        <div class="overflow-hidden border border-slate-100 rounded-lg shadow-sm overflow-x-auto">
            <table class="table-auto w-full divide-y divide-slate-100">
                <thead class="bg-slate-200">
                    <tr class="text-slate-700">
                        <th scope="col" class="px-4 py-2 text-left min-w-44">Admission Date</th>
                        <th scope="col" class="px-4 py-2 text-left min-w-44">Submission Deadline</th>
                        <th scope="col" class="min-w-28"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    @foreach($upcoming_dates as $date)
                        <tr wire:key="{{ $date->id }}">
                            <td class="px-4 py-2">
                                @if($loop->first)
                                    <span class="text-slate-800">
                                        {{ \Carbon\Carbon::parse($date->admission_date)->toFormattedDayDateString() }}
                                    </span>
                                @else
                                    <span class="text-slate-400">
                                        {{ \Carbon\Carbon::parse($date->admission_date)->toFormattedDayDateString() }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                {{ \Carbon\Carbon::parse($date->submission_deadline)->toFormattedDayDateString() }}
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

    <div class="bg-slate-50 rounded-lg p-3 xl:p-4 shadow">
        <h2 class="text-2xl text-sky-800 border-b-4 border-red-700 mb-3 pb-2">
            New Admission Date
        </h2>
        <form wire:submit="create">
            <div class="flex flex-col md:flex-row md:gap-4">
                <div>
                    <x-input-label for="admission_date" :value="__('Admission Date')" class="mt-4 mb-1" />
                    <x-text-input wire:model="admission_date" id="admission_date"
                                  class="block mt-1 w-full" type="date"
                                  name="admission_date" required autocomplete="off" />
                </div>
                <div>
                    <x-input-label for="submission_deadline" :value="__('Submission Deadline')" class="mt-4 mb-1" />
                    <x-text-input wire:model="submission_deadline" id="submission_deadline"
                                  class="block mt-1 w-full" type="date"
                                  name="submission_deadline" required autocomplete="off" />
                </div>
                <div class="md:mt-1">
                    <x-primary-button class="mt-4 md:mt-10">
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>

            </div>
            <div class="flex flex-row">
                <x-input-error :messages="$errors->get('admission_date')" class="mt-2" />
            </div>
            <div class="flex flex-row">
                <x-input-error :messages="$errors->get('submission_deadline')" class="mt-2" />
            </div>
        </form>
    </div>

</div>
