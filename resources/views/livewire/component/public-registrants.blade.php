<div class="bg-slate-100 border border-slate-200 rounded-lg p-3 xl:p-4 pb-4 mb-4 xl:mb-6 shadow-md shadow-slate-300">
    <h2 class="text-2xl lg:text-3xl text-slate-700 border-b-2 border-red-700 pb-2 mb-4">
        The Chartered Practitioners Register
    </h2>
{{--    <p class="mb-2">--}}
{{--        All registrants can be found here.--}}
{{--    </p>--}}
{{--    <p class="mb-6 text-sm text-slate-500">--}}
{{--        Dates shown indicate when the individual was initially submitted to the register.--}}
{{--    </p>--}}

    <div class="mb-4 flex flex-col lg:flex-row gap-4 items-center">
        <div class="flex flex-col lg:flex-row items-center justify-between w-full gap-4">
            <div class="flex flex-row gap-2 items-center">
                <div>
                    <span>Order by:</span>
                </div>
                <button type="button" wire:click="sortBy('became_registrant_at')" class="rounded-full text-white px-6 py-1 {{ $sort_column_name === 'became_registrant_at' ? ' bg-red-800 hover:bg-red-700 ' : ' bg-slate-500 hover:bg-red-700 ' }}">
                    Admission Date
                </button>
                <button type="button" wire:click="sortBy('last_name')" class="rounded-full text-white px-6 py-1 {{ $sort_column_name === 'last_name' ? ' bg-red-800 hover:bg-red-700 ' : ' bg-slate-500 hover:bg-red-700 ' }}">
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
                               class="rounded-lg border border-slate-300 py-1
                                      placeholder:font-normal placeholder:italic placeholder:text-slate-300
                                      focus:border-sky-200 focus:ring-sky-100 focus:ring-4"
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg border border-slate-300 p-4 pt-6 mb-4 gap-6">
        @forelse($registrants as $registrant)
            <div class="block float-left w-full md:w-1/2 xl:w-1/3 2xl:w-1/4">
                <p class="pb-1 mb-3 border-b border-slate-100" wire:key="{{ $registrant->id }}">
                    {{ $registrant->first_name . ' ' . $registrant->last_name }}
                    <span class="text-slate-400">
                        {{ ' - ' . \Carbon\Carbon::parse($registrant->became_registrant_at)->toFormattedDayDateString() }}
                    </span>
                </p>
            </div>
        @empty
            <p>No results found.</p>
        @endforelse
        <div class="clear-both"></div>
            <p class="my-4 text-sm text-slate-500">
                The date next to each name indicates when the individual was admitted to the register.
            </p>
    </div>
    <div>
        {{ $registrants->onEachSide(1)->links(data: ['scrollTo' => false]) }}
    </div>
</div>
