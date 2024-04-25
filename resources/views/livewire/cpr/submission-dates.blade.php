<div class="flex flex-col flex-grow p-6 gap-5">

    @if(session('success'))
        <div class="w-full font-bold bg-green-100 rounded-2xl text-green-600 px-5 py-2">
            <span class="text-xs">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="w-full font-bold bg-red-200 rounded-2xl text-red-700 px-5 py-2">
            <span class="text-xs">{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-slate-50 rounded-lg p-6 shadow">
        <h2 class="text-2xl text-sky-800 border-b-4 border-red-700 mb-3 pb-2">New Submission Date</h2>
        <form wire:submit="create">
            <div class="flex flex-row">
                <div>
                    <x-input-label for="date" :value="__('New Submission Date')" />
                    <x-text-input wire:model="date" id="new_date" class="block mt-1 w-full" type="date" name="date" required autocomplete="date" />
                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                </div>
                <div>
                    <x-primary-button class="mt-7 ms-3">
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div>

    <div class="bg-slate-50 rounded-lg p-6 shadow">
        <h2 class="text-2xl text-sky-800 border-b-4 border-red-700 mb-3 pb-2">Upcoming Submission Dates</h2>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Submission Date</th>
                    <th class="px-4 py-2 text-left">Added By</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="">
                @foreach($upcoming_dates as $date)
                    <tr wire:key="{{ $date->id }}">
                        <td class="px-4 py-2 border border-slate-200 bg-white">
                            @if($loop->first)
                                <span class="text-slate-800">
{{--                                    {{ $date->submission_date->format('d/m/Y') }}--}}
                                    {{ \Carbon\Carbon::parse($date->submission_date)->toFormattedDayDateString() }}
                            @else
                                <span class="text-slate-400">
{{--                                    {{ $date->submission_date->format('d/m/Y') }}--}}
                                    {{ \Carbon\Carbon::parse($date->submission_date)->toFormattedDayDateString() }}

                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border border-slate-200 bg-white">
                            {{ $date->updatedBy->first_name . ' ' . $date->updatedBy->last_name }}
                        </td>
                        <td>
                            <x-danger-button wire:click="delete({{ $date->id }})" wire:confirm="Are you sure you want to delete this date?" class="ms-3">
                                {{ __('Delete') }}
                            </x-danger-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
