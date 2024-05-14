<div x-data="{ expanded:false }" class="rounded-lg p-4 shadow" :class="{'bg-slate-50': expanded, 'bg-white': !expanded}">
    <h2 class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2">
        <button @click="expanded = ! expanded" class="float-end rounded-full bg-sky-100 text-sky-700 hover:bg-sky-200 hover:text-emerald-700 shadow-inner">
            <svg fill="currentColor" viewBox="0 0 20 20"
                 :class="{'rotate-180': expanded, 'rotate-0': !expanded}"
                 class="inline h-8 w-8 transform transition-transform duration-200">
                <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"></path>
            </svg>
        </button>
        Active Members <span class="text-base">[{{ $active_members->count() }}]</span>
    </h2>
    <div x-show="expanded" x-collapse>
        @if($active_members->count() > 0)
            <div class="mt-3 mb-2 overflow-hidden border border-sky-100 rounded-lg shadow-sm">
                <table class="table-auto w-full divide-y divide-sky-100">
                    <thead class="bg-sky-100">
                        <tr class="text-sky-700 divide-x divide-sky-200">
                            {{-- @todo: make th's into components --}}
                            <th wire:click="sortBy('last_name')" scope="col" class="px-4 py-2 text-left cursor-pointer {{ $sort_column_name === 'last_name' ? 'bg-sky-200' : ''  }}">
                                <span class="{{ $sort_column_name === 'last_name' ? 'text-sky-700' : 'text-slate-500'  }}">
                                    Name
                                </span>
                                <span class="float-right flex flex-row font-normal cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'last_name' && $sort_column_direction === 'asc' ? '2' : '1.5'  }}" stroke="currentColor" class="mt-1 w-4 h-4 {{ $sort_column_name === 'last_name' && $sort_column_direction === 'asc' ? '' : 'text-slate-400' }}">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'last_name' && $sort_column_direction === 'desc' ? '2' : '1.5'  }}" stroke="currentColor" class="mt-1 w-4 h-4 {{ $sort_column_name === 'last_name' && $sort_column_direction === 'desc' ? '' : 'text-slate-400' }}">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                                    </svg>
                                </span>
                            </th>
                            <th wire:click="sortBy('email')" scope="col" class="px-4 py-2 text-left cursor-pointer {{ $sort_column_name === 'email' ? 'bg-sky-200' : ''  }}">
                                <span class="{{ $sort_column_name === 'email' ? 'text-sky-700' : 'text-slate-500'  }}">
                                    Email
                                </span>
                                <span class="float-right flex flex-row font-normal cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'email' && $sort_column_direction === 'asc' ? '2' : '1.5'  }}" stroke="currentColor" class="mt-1 w-4 h-4 {{ $sort_column_name === 'email' && $sort_column_direction === 'asc' ? '' : 'text-slate-400' }}">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'email' && $sort_column_direction === 'desc' ? '2' : '1.5'  }}" stroke="currentColor" class="mt-1 w-4 h-4 {{ $sort_column_name === 'email' && $sort_column_direction === 'desc' ? '' : 'text-slate-400' }}">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                                    </svg>
                                </span>
                            </th>
                            <th wire:click="sortBy('membership_expires_at')" scope="col" class="px-4 py-2 text-left cursor-pointer {{ $sort_column_name === 'membership_expires_at' ? 'bg-sky-200' : ''  }}">
                                <span class="{{ $sort_column_name === 'membership_expires_at' ? 'text-sky-700' : 'text-slate-500'  }}">
                                    Membership Expires
                                </span>
                                <span class="float-right flex flex-row font-normal cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'membership_expires_at' && $sort_column_direction === 'asc' ? '2' : '1.5'  }}" stroke="currentColor" class="mt-1 w-4 h-4 {{ $sort_column_name === 'membership_expires_at' && $sort_column_direction === 'asc' ? '' : 'text-slate-400' }}">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'membership_expires_at' && $sort_column_direction === 'desc' ? '2' : '1.5'  }}" stroke="currentColor" class="mt-1 w-4 h-4 {{ $sort_column_name === 'membership_expires_at' && $sort_column_direction === 'desc' ? '' : 'text-slate-400' }}">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                                    </svg>
                                </span>
                            </th>
                            <th scope="col" class="px-4 py-2 text-left"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-sky-100 text-slate-600">
                        @foreach($active_members as $member)
                            <tr wire:key="{{ $member->id }}" class="{{ $member->membership_expires_at < now()->addDays(30) ? 'bg-red-100' : '' }}">
                                <td class="px-4 py-2">
                                    {{ $member->first_name . ' ' . $member->last_name }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $member->email }}
                                </td>
                                <td class="px-4 py-2 {{ $member->membership_expires_at < now()->addDays(30) ? 'text-red-700 font-semibold' : 'text-slate-600' }} ">
                                    {{ \Carbon\Carbon::parse($member->membership_expires_at)->toFormattedDayDateString() }}
                                </td>
                                <td class="px-4 py-2">
                                    <x-edit-button class="ms-3">
                                        {{ __('View/Edit') }}
                                    </x-edit-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        @else
            <p class="mt-3 mb-2">No active members found.</p>
        @endif
    </div>
</div>
