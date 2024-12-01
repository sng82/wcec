<div class="flex h-full w-full overflow-y-auto">

    <livewire:cpr.sidebar/>

    <div class="right w-full min-w-80 flex grow flex-col overflow-y-auto">

{{--        <livewire:layout.cpr-navigation/>--}}

        <div class="py-4 p-3 xl:p-6">

            <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 mb-4 xl:mb-6 shadow-md shadow-slate-300">
                <h1 class="text-2xl text-sky-800 border-b-4 border-red-700 pb-2 mb-4">
                    Private Documents
                </h1>

                <p class="mb-4">
                    Documents that can only be accessed by admins and the registrants that submitted them.
                </p>

                <div class="flex flex-col xl:flex-row justify-between">
                    <div class="flex flex-wrap xl:flex-row gap-2 items-center mb-3">
                        <div>
                            <span class="font-bold">Filter:</span>
                        </div>

                        @foreach($filter_options as $filter_option)
                            <button type="button" wire:click="filterFor('{{$filter_option}}')"
                                    class="rounded-full px-4 py-1 text-sm transition ease-linear duration-150 {{ $filter === $filter_option ? 'bg-sky-600 cursor-default text-white' : 'text-slate-600 hover:text-white bg-slate-200 hover:bg-sky-500 active:bg-sky-300' }}">
                                @if($filter_option === '')
                                    N/A
                                @elseif($filter_option === 'cpd' || $filter_option === 'cv')
                                    {{ strtoupper($filter_option) }}
                                @else
                                    {{ str(str_replace('_', ' ', $filter_option))->title() }}
                                @endif
                            </button>
                        @endforeach

                    </div>
                    <div class="flex flex-row items-center mb-3 ml-0 xl:ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 mr-2 text-slate-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <input wire:model="search" wire:keydown.debounce.300ms="searchFilter" type="text" placeholder='search...'
                               class="rounded-lg border border-slate-200 py-1
                       placeholder:font-normal placeholder:italic placeholder:text-slate-300
                       focus:border-sky-200 focus:ring-sky-100 focus:ring-4 ">
                    </div>
                </div>

                <div class="overflow-hidden border border-slate-100 rounded-lg shadow-sm overflow-x-auto">
                    @if($documents->count() > 0)
                        <table class="table-auto w-full divide-y divide-slate-200 text-sm">
                            <thead class="bg-slate-200">
                                <tr class="text-slate-700">
                                    <th wire:click="sortBy('doc_type')" scope="col" class="px-4 py-2 text-left cursor-pointer {{ $sort_column_name === 'doc_type' ? 'bg-slate-400' : 'hover:bg-slate-300' }}">
                                        <div class="flex flex-row justify-between gap-1 content-center {{ $sort_column_name === 'doc_type' ? 'text-white' : 'text-slate-500' }}">
                                            <span class="">
                                                Type
                                            </span>
                                            <span class="float-right flex flex-col font-normal">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'doc_type' && $sort_column_direction === 'asc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'doc_type' && $sort_column_direction === 'asc' ? '' : 'text-slate-800' }}">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'doc_type' && $sort_column_direction === 'desc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'doc_type' && $sort_column_direction === 'desc' ? '' : 'text-slate-800' }}">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </span>
                                        </div>
                                    </th>

                                    <th wire:click="sortBy('file_name')" scope="col" class="px-4 py-2 text-left cursor-pointer {{ $sort_column_name === 'file_name' ? 'bg-slate-400' : 'hover:bg-slate-300' }}">
                                        <div class="flex flex-row justify-between gap-1 content-center {{ $sort_column_name === 'file_name' ? 'text-white' : 'text-slate-500'  }}">
                                            <span class="">
                                                File
                                            </span>
                                            <span class="float-right flex flex-col font-normal">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'file_name' && $sort_column_direction === 'asc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'file_name' && $sort_column_direction === 'asc' ? '' : 'text-slate-800' }}">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'file_name' && $sort_column_direction === 'desc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'file_name' && $sort_column_direction === 'desc' ? '' : 'text-slate-800' }}">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </span>
                                        </div>
                                    </th>

                                    <th wire:click="sortBy('created_at')" scope="col" class="px-4 py-2 text-left cursor-pointer {{ $sort_column_name === 'created_at' ? 'bg-slate-400' : 'hover:bg-slate-300' }}">
                                        <div class="flex flex-row justify-between gap-1 content-center {{ $sort_column_name === 'created_at' ? 'text-white' : 'text-slate-500'  }}">
                                            <span class="">
                                                Submitted At
                                            </span>
                                            <span class="float-right flex flex-col font-normal">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'created_at' && $sort_column_direction === 'asc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'created_at' && $sort_column_direction === 'asc' ? '' : 'text-slate-800' }}">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'created_at' && $sort_column_direction === 'desc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'created_at' && $sort_column_direction === 'desc' ? '' : 'text-slate-800' }}">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </span>
                                        </div>
                                    </th>

                                    <th wire:click="sortBy('users.last_name')" scope="col" class="px-4 py-2 text-left cursor-pointer {{ $sort_column_name === 'users.last_name' ? 'bg-slate-400' : 'hover:bg-slate-300' }}">
                                        <div class="flex flex-row justify-between gap-1 content-center {{ $sort_column_name === 'users.last_name' ? 'text-white' : 'text-slate-500'  }}">
                                            <span class="">
                                                Submitted By
                                            </span>
                                            <span class="float-right flex flex-col font-normal">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'users.last_name' && $sort_column_direction === 'asc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'users.last_name' && $sort_column_direction === 'asc' ? '' : 'text-slate-800' }}">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="{{ $sort_column_name === 'users.last_name' && $sort_column_direction === 'desc' ? '2' : '1.5'  }}" stroke="currentColor" class="w-3 h-3 {{ $sort_column_name === 'users.last_name' && $sort_column_direction === 'desc' ? '' : 'text-slate-800' }}">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-4 py-2"></th>

                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100 text-slate-500">
                                @foreach($documents as $document)
                                    <tr wire:key="{{ $document->id }}">
                                        <td class="px-4 py-2">
                                            @if($document->doc_type === 'cpd' || $document->doc_type === 'cv')
                                                {{ strtoupper($document->doc_type) }}
                                            @else
                                                {{ str(str_replace('_', ' ', $document->doc_type))->title() }}
                                            @endif
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $document->file_name }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ \Carbon\Carbon::parse($document->created_at)->toDayDateTimeString() }}
{{--                                            by--}}
{{--                                            <a class="text-sky-600 hover:text-sky-700" href="/cpr/user-edit/{{ $document->owner->id }}">--}}
{{--                                                {{ $document->owner->first_name . ' ' . $document->owner->last_name }}--}}
{{--                                            </a>--}}
                                        </td>

                                        <td class="px-4 py-2">
                                            <a class="text-sky-600 hover:text-sky-700" href="/cpr/user-edit/{{ $document->owner->id }}">
                                                {{ $document->owner->first_name . ' ' . $document->owner->last_name }}
                                            </a>
                                        </td>

                                        <td class="px-4 py-2">
                                            <button wire:click.prevent="downloadFile({{$document->id}})"
                                                    class="text-white rounded-full bg-sky-700 px-4 py-1 hover:bg-sky-800 flex flex-row gap-2 items-center">
                                                <span>
                                                    Download
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                     class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                                </svg>
                                            </button>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="bg-white p-4">
                            No documents found.
                            Either no documents have been submitted yet, or your search criteria produces no matches.
                        </p>
                    @endif
                </div>

                @if($documents->count() > 0)
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
                        {{ $documents->onEachSide(1)->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
