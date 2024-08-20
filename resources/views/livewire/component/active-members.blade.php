<div class="rounded-lg p-3 xl:p-4 shadow bg-slate-50">
    <h2 class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2">
        Active Registrants
{{--        <span class="text-base">[{{ $active_members->count() }}]</span>--}}
    </h2>

        <div class="grid justify-end">
            <div class="flex flex-row items-center mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 mr-2 text-slate-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input wire:model="search" wire:keydown.debounce.300ms="searchFilter" type="text" placeholder='search...'
                       class="rounded-lg border border-slate-200 py-1
                       placeholder:font-normal placeholder:italic placeholder:text-slate-300
                       focus:border-sky-200 focus:ring-sky-100 focus:ring-4 ">
            </div>
        </div>
        @if($active_registrants->count() > 0)
            <div class="mt-3 mb-2 overflow-hidden border border-sky-100 rounded-lg shadow-sm overflow-x-auto">
                <table class="table-auto w-full divide-y divide-sky-100 text-sm">
                    <thead class="bg-sky-100">
                        <tr class="text-sky-700 divide-x divide-sky-200">
                            <th wire:click="sortBy('last_name')" scope="col" class="px-4 py-2 text-left cursor-pointer {{ $sort_column_name === 'last_name' ? 'bg-sky-200' : ''  }}">
                                <div class="flex flex-row justify-between gap-1 content-center">
                                    <span class="{{ $sort_column_name === 'last_name' ? 'text-sky-700' : 'text-slate-500'  }}">
                                        Name
                                    </span>
                                    <span class="float-right flex flex-col font-normal">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'last_name' && $sort_column_direction === 'asc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'last_name' && $sort_column_direction === 'asc' ? '' : 'text-slate-400' }}">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'last_name' && $sort_column_direction === 'desc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'last_name' && $sort_column_direction === 'desc' ? '' : 'text-slate-400' }}">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </span>
                                </div>
                            </th>
                            <th wire:click="sortBy('email')" scope="col" class="px-4 py-2 text-left cursor-pointer {{ $sort_column_name === 'email' ? 'bg-sky-200' : ''  }}">
                                <div class="flex flex-row justify-between gap-1 content-center">
                                    <span class="{{ $sort_column_name === 'email' ? 'text-sky-700' : 'text-slate-500'  }}">
                                        Email
                                    </span>
                                    <span class="float-right flex flex-col font-normal">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'email' && $sort_column_direction === 'asc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'email' && $sort_column_direction === 'asc' ? '' : 'text-slate-400' }}">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'email' && $sort_column_direction === 'desc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'email' && $sort_column_direction === 'desc' ? '' : 'text-slate-400' }}">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </span>
                                </div>
                            </th>
                            <th wire:click="sortBy('registration_expires_at')" scope="col" class="px-4 py-2 text-left cursor-pointer {{ $sort_column_name === 'registration_expires_at' ? 'bg-sky-200' : ''  }}">
                                <div class="flex flex-row justify-between gap-1 content-center">
                                    <span class="{{ $sort_column_name === 'registration_expires_at' ? 'text-sky-700' : 'text-slate-500'  }}">
                                        Registration Expires
                                    </span>
                                    <span class="float-right flex flex-col font-normal">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'registration_expires_at' && $sort_column_direction === 'asc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'registration_expires_at' && $sort_column_direction === 'asc' ? '' : 'text-slate-400' }}">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'registration_expires_at' && $sort_column_direction === 'desc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'registration_expires_at' && $sort_column_direction === 'desc' ? '' : 'text-slate-400' }}">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </span>
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-sky-100 text-slate-600">
                        @foreach($active_registrants as $registrant)
                            <tr wire:key="{{ $registrant->id }}"
                                class="odd:bg-white even:bg-slate-50 hover:bg-slate-100 hover:text-sky-600
{{--                            {{ $registrant->registration_expires_at < now()->addDays(30) ? 'bg-red-100 hover:bg-red-200 hover:text-red-600' : 'hover:bg-slate-100 hover:text-sky-600' }}--}}
                            ">
                                <td class="px-4 py-2">
                                    {{ $registrant->first_name . ' ' . $registrant->last_name }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $registrant->email }}
                                </td>
                                <td class="px-4 py-2 {{ $registrant->registration_expires_at < now()->addDays(30) ? 'text-red-700 font-semibold' : '' }} ">
                                    {{ \Carbon\Carbon::parse($registrant->registration_expires_at)->toFormattedDayDateString() }}
                                </td>
                                <td class="px-4 py-1">
                                    <x-edit-button :href="route('user-edit', $registrant->id)" class="">
                                        {{ __('View/Edit') }}
                                    </x-edit-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex flex-row justify-end items-center gap-4 my-3 text-base">
                <label class="text-sm" for="per_page">Per Page</label>
                <select wire:model.live="per_page" name="per_page" id="per_page" class="rounded-lg border border-slate-300 focus:border-sky-200 focus:ring-sky-100 focus:ring-4">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="overflow-x-auto">
                {{ $active_registrants->onEachSide(1)->links() }}
            </div>

        @else
            <p class="mt-3 mb-2">No active registrants found.</p>
        @endif

</div>
