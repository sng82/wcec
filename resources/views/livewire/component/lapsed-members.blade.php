<div x-data="{ expanded:false }" class="rounded-lg p-4 shadow" :class="{'bg-slate-50': expanded, 'bg-white': !expanded}">
    <h2 @click="expanded = ! expanded" class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2 cursor-pointer">
        <button class="float-end rounded-full bg-slate-100 text-sky-700 hover:bg-sky-100 hover:text-emerald-700">
            <svg fill="currentColor" viewBox="0 0 20 20"
                 :class="{'rotate-180': expanded, 'rotate-0': !expanded}"
                 class="inline h-8 w-8 transform transition-transform duration-200">
                <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"></path>
            </svg>
        </button>
        Lapsed Members
    </h2>
    <div x-show="expanded" x-collapse>
        <div class="grid justify-end">
            <div class="flex flex-row items-center mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 mr-2 text-slate-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input wire:model.live.debounce.250ms="search" type="text" placeholder='search...' class="rounded-lg border border-slate-200 placeholder:font-normal placeholder:italic placeholder:text-slate-300 focus:border-sky-200 focus:ring-sky-100 focus:ring-4 ">
            </div>
        </div>
        @if($lapsed_members->count() > 0)
            <div class="mt-3 mb-2 overflow-hidden border border-sky-100 rounded-lg shadow-sm overflow-x-auto">
                <table class="table-auto w-full divide-y divide-teal-100">
                    <thead class="bg-sky-100">
                        <tr class="text-sky-700">
                            <th wire:click="sortBy('last_name')" scope="col" class="px-4 py-2 text-left cursor-pointer {{ $sort_column_name === 'last_name' ? 'bg-sky-200' : ''  }}">
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
                            </th>
                            <th wire:click="sortBy('email')" scope="col" class="px-4 py-2 text-left cursor-pointer {{ $sort_column_name === 'email' ? 'bg-sky-200' : ''  }}">
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
                            </th>
                            <th wire:click="sortBy('membership_expires_at')" scope="col" class="px-4 py-2 text-left cursor-pointer {{ $sort_column_name === 'membership_expires_at' ? 'bg-sky-200' : ''  }}">
                                <span class="{{ $sort_column_name === 'membership_expires_at' ? 'text-sky-700' : 'text-slate-500'  }}">
                                    Membership Expired
                                </span>
                                <span class="float-right flex flex-col font-normal">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'membership_expires_at' && $sort_column_direction === 'asc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'membership_expires_at' && $sort_column_direction === 'asc' ? '' : 'text-slate-400' }}">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'membership_expires_at' && $sort_column_direction === 'desc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'membership_expires_at' && $sort_column_direction === 'desc' ? '' : 'text-slate-400' }}">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </th>
{{--                            <th scope="col" class="px-4 py-2 text-left"></th>--}}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-sky-100">
                        @foreach($lapsed_members as $member)
                            <tr wire:key="{{ $member->id }}" wire:click="openMember({{ $member->id }})" class="cursor-pointer text-slate-500 hover:text-sky-600 hover:bg-slate-100">
                                <td class="px-4 py-2">
                                    {{ $member->first_name . ' ' . $member->last_name }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $member->email }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::parse($member->membership_expires_at)->toFormattedDayDateString() }}
                                </td>
{{--                                <td class="px-4 py-1 text-slate-500">--}}
{{--                                    <x-edit-button :href="route('member-edit', $member->id)" class="ms-3">--}}
{{--                                        {{ __('View/Edit') }}--}}
{{--                                    </x-edit-button>--}}
{{--                                </td>--}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex flex-row justify-end items-center gap-4 my-3 text-base">
                <label for="per_page">Per Page</label>
                <select wire:model.live="per_page" name="per_page" id="per_page" class="rounded-lg border border-slate-300 focus:border-sky-200 focus:ring-sky-100 focus:ring-4">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="overflow-x-auto">
                {{ $lapsed_members->links() }}
            </div>
        @else
            <p class="mt-3 mb-2">No lapsed members found.</p>
        @endif
    </div>
</div>
