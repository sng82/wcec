<div class="bg-slate-50 rounded-xl px-5 py-6">
    <h2 class="text-2xl lg:text-3xl text-slate-800 border-b border-slate-300 pb-2 mb-4">
        The Chartered Practitioners Register
    </h2>
    <p class="mb-2">
        Individuals in the register have proven their positions within the upper echelons of the industry.
    </p>
    <p class="mb-6 text-sm text-slate-500">
        Dates shown indicate when the individual was initially submitted to the register.
    </p>

    <div class="mb-4 flex flex-col lg:flex-row gap-4 items-center">
        <div class="flex flex-col lg:flex-row items-center justify-between w-full gap-4">
            <div class="flex flex-row gap-2 items-center">
                <div>
                    <span>Order Registrants By:</span>
                </div>
                <button type="button" wire:click="sortBy('became_registrant_at')" class="rounded-full text-white px-6 py-1 {{ $sort_column_name === 'became_registrant_at' ? ' bg-sky-700 hover:bg-sky-600 ' : ' bg-slate-300 hover:bg-sky-600 ' }}">
                    Submission Date
                </button>
                <button type="button" wire:click="sortBy('last_name')" class="rounded-full text-white px-6 py-1 {{ $sort_column_name === 'last_name' ? ' bg-sky-700 hover:bg-sky-600 ' : ' bg-slate-300 hover:bg-sky-600 ' }}">
                    Last Name
                </button>
            </div>
            <div>
                <div class="grid justify-end">
                    <div class="flex flex-row items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 mr-2 text-slate-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <input wire:model="search" wire:keydown.debounce.300ms="searchFilter" type="text" placeholder='search...'
                               class="rounded-lg border border-slate-200 py-1
                                      placeholder:font-normal placeholder:italic placeholder:text-slate-300
                                      focus:border-sky-200 focus:ring-sky-100 focus:ring-4"
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg border border-slate-200 p-4 pt-6 mb-4 gap-6">
        @forelse($registrants as $registrant)
            <div class="block float-left w-full md:w-1/2 xl:w-1/3 2xl:w-1/4">
                <p class="pb-1 mb-3 border-b border-slate-100" wire:key="{{ $registrant->id }}">
                    {{ $registrant->first_name . ' ' . $registrant->last_name }}
                    <span class="text-slate-400">
                        {{ ' - ' . \Carbon\Carbon::parse($registrant->submission_accepted_at)->toFormattedDayDateString() }}
                    </span>
                </p>
            </div>

        @empty
            <p>No results found.</p>
        @endforelse
        <div class="clear-both"></div>
    </div>
    <div>
        {{ $registrants->onEachSide(1)->links() }}
    </div>
</div>
