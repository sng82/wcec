<div class="rounded-lg p-3 xl:p-4 shadow bg-slate-50">
    <h2 class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2">
        Pending Applicants
    </h2>
    <div class="grid grid-flow-row lg:grid-flow-col">
        <div class="flex items-center mt-3">
            <p class="">{{ $applicants->count() }} Applicants who have not yet been accepted.
                Of these:<br>
                {{ $pending_eoi_submitted_count }} {{ $pending_eoi_submitted_count === 1 ? 'is' : 'are' }}
                waiting for their Expression of Interest to be assessed.<br>
                {{ $pending_waiting_approval_count }} {{ $pending_waiting_approval_count === 1 ? 'is' : 'are' }}
                waiting for their application to be assessed.</p>
        </div>
        <div class="grid justify-end mt-3 lg:pl-5">
            <div class="flex flex-row items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 mr-2 text-slate-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder='search...'
                       class="rounded-lg border border-slate-200 py-1
                   placeholder:font-normal placeholder:italic placeholder:text-slate-300
                   focus:border-sky-200 focus:ring-sky-100 focus:ring-4 ">
            </div>
        </div>
    </div>
    @if($applicants->count() > 0)
        <div class="mt-3 mb-2 overflow-hidden border border-sky-100 rounded-lg shadow-sm overflow-x-auto">
            <table class="table-auto w-full divide-y divide-sky-100 text-sm">
                <thead class="bg-sky-200">
                    <tr class="text-sky-700 divide-x divide-sky-200">
                        <th wire:click="sortBy('last_name')" scope="col" class="px-4 py-2 text-left cursor-pointer {{ $sort_column_name === 'last_name' ? 'bg-sky-300' : ''  }}">
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
                        <th wire:click="sortBy('email')" scope="col" class="px-4 py-2 text-left cursor-pointer {{ $sort_column_name === 'email' ? 'bg-sky-300' : ''  }}">
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
                        <th wire:click="sortBy('created_at')" scope="col" class="px-4 py-2 text-left cursor-pointer min-w-44 {{ $sort_column_name === 'created_at' ? 'bg-sky-200' : ''  }}">
                            <div class="flex flex-row justify-between gap-1 content-center">
                                <span class="{{ $sort_column_name === 'created_at' ? 'text-sky-700' : 'text-slate-500'  }}">
                                    Added
                                </span>
                                <span class="float-right flex flex-col font-normal">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'created_at' && $sort_column_direction === 'asc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'created_at' && $sort_column_direction === 'asc' ? '' : 'text-slate-400' }}">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'created_at' && $sort_column_direction === 'desc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'created_at' && $sort_column_direction === 'desc' ? '' : 'text-slate-400' }}">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </div>
                        </th>
                        <th wire:click="sortBy('registration_fee_paid')" scope="col" class="px-4 py-2 text-left cursor-pointer min-w-32 {{ $sort_column_name === 'registration_fee_paid' ? 'bg-sky-300' : '' }}">
                            <div class="flex flex-row justify-between gap-1 content-center">
                                <span class="{{ $sort_column_name === 'registration_fee_paid' ? 'text-sky-700' : 'text-slate-500'  }}">
                                    Registration Fee
                                </span>
                                <span class="float-right flex flex-col font-normal">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'registration_fee_paid' && $sort_column_direction === 'asc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'registration_fee_paid' && $sort_column_direction === 'asc' ? '' : 'text-slate-400' }}">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'registration_fee_paid' && $sort_column_direction === 'desc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'registration_fee_paid' && $sort_column_direction === 'desc' ? '' : 'text-slate-400' }}">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </div>
                        </th>
                        <th wire:click="sortBy('eoi_status')" scope="col" class="px-4 py-2 text-left cursor-pointer {{ $sort_column_name === 'eoi_status' ? 'bg-sky-300' : '' }}">
                            <span class="{{ $sort_column_name === 'eoi_status' ? 'text-sky-700' : 'text-slate-500'  }}">
                                EoI Status
                            </span>
                            <span class="float-right flex flex-col font-normal">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'eoi_status' && $sort_column_direction === 'asc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'eoi_status' && $sort_column_direction === 'asc' ? '' : 'text-slate-400' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'eoi_status' && $sort_column_direction === 'desc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'eoi_status' && $sort_column_direction === 'desc' ? '' : 'text-slate-400' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </span>
                        </th>
                        <th wire:click="sortBy('application_fee_paid')" scope="col" class="px-4 py-2 text-left cursor-pointer min-w-32 {{ $sort_column_name === 'application_fee_paid' ? 'bg-sky-300' : ''  }}">
                            <div class="flex flex-row justify-between gap-1 content-center">
                                <span class="{{ $sort_column_name === 'application_fee_paid' ? 'text-sky-700' : 'text-slate-500'  }}">
                                    Application Fee
                                </span>
                                <span class="float-right flex flex-col font-normal">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'application_fee_paid' && $sort_column_direction === 'asc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'application_fee_paid' && $sort_column_direction === 'asc' ? '' : 'text-slate-400' }}">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'application_fee_paid' && $sort_column_direction === 'desc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'application_fee_paid' && $sort_column_direction === 'desc' ? '' : 'text-slate-400' }}">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </div>

                        </th>
                        <th scope="col" class="px-4 py-2 text-left">
                            Application Status
                        </th>
                        <th scope="col" class="px-4 py-2 text-left">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-sky-100">
                    @foreach($applicants as $member)
                        <tr wire:key="{{ $member->id }}" wire:click="openMember({{ $member->id }})"
                            class="cursor-pointer
                             {{
                                ($member->application_status === 'submitted' && $member->application_fee_paid) ||
                                ($member->eoi_status === 'submitted' && $member->registration_fee_paid)
                                ? 'bg-emerald-50 hover:bg-emerald-200 hover:text-emerald-600'
                                : 'hover:bg-slate-100 hover:text-sky-600'
                             }}
                             "
                        >
                            <td class="px-4 py-2">
                                {{ $member->first_name . ' ' . $member->last_name }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $member->email }}
                            </td>
                            <td class="px-4 py-2">
                                {{ \Carbon\Carbon::parse($member->created_at)->format('d/m/Y H:i')}}
{{--                                {{ \Carbon\Carbon::parse($member->created_at)->toDayDateTimeString() }}--}}
                            </td>
                            <td class="px-4 py-1">
                                <span class="py-1 px-3 inline rounded-full w-96 {{ $member->registration_fee_paid ? 'text-emerald-500 bg-emerald-100' : 'text-slate-400 bg-slate-100' }}">
                                    {{ $member->registration_fee_paid ? 'Paid' : 'Not Paid' }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                {{ empty($member->eoi_status) ? 'not submitted' : $member->eoi_status }}
                            </td>
                            <td class="px-4 py-1">
                                <span class="py-1 px-3 rounded-full  {{ $member->application_fee_paid ? 'text-emerald-500 bg-emerald-100' : 'text-slate-400 bg-slate-100' }}">
                                    {{ $member->application_fee_paid ? 'Paid' : 'Not Paid' }}
                                </span>
                            </td>

                            <td class="px-4 py-2">
                                {{ empty($member->application_status) ? 'not submitted' : $member->application_status }}
                            </td>

                            <td class="px-4 py-1">
                                @if ($member->application_status === 'submitted' && $member->application_fee_paid)
                                    <a href="#" class="z-10 bg-sky-800 hover:bg-sky-900 text-white rounded-full py-1 px-4">Assess&nbsp;Application</a>
                                @elseif ($member->eoi_status === 'submitted' && $member->registration_fee_paid)
                                    <a href="{{ route('assess-eoi',[$member->id]) }}" class="z-10 bg-sky-800 hover:bg-sky-900 text-white rounded-full py-1 px-4">Assess&nbsp;EoI</a>
                                @else
                                    N/A
                                @endif
                            </td>
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
            {{ $applicants->links() }}
        </div>
    @else
        <p class="mt-3 mb-2">No unaccepted applicants found.</p>
    @endif

</div>
