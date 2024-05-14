<div x-data="{ expanded:false }" class="rounded-lg p-4 shadow" :class="{'bg-slate-50': expanded, 'bg-white': !expanded}">
    <h2 class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2">
        <button @click="expanded = ! expanded" class="float-end rounded-full bg-sky-100 text-sky-700 hover:bg-sky-200 shadow-inner">
            <svg fill="currentColor" viewBox="0 0 20 20"
                 :class="{'rotate-180': expanded, 'rotate-0': !expanded}"
                 class="inline h-8 w-8 transform transition-transform duration-200">
                <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"></path>
            </svg>
        </button>
        Accepted Applicants <span class="text-base">[{{ $accepted_applicants->count() }}]</span>
    </h2>
    <div x-show="expanded" x-collapse>
        <p class="my-3">Applicants that will become members on the next submission date.</p>
        @if($accepted_applicants->count() > 0)
            <div class="mt-3 mb-2 overflow-hidden border border-sky-100 rounded-lg shadow-sm">

                {{--                        {{ dump($accepted_applicants) }}--}}

                <table class="table-auto w-full divide-y divide-teal-100">
                    <thead class="bg-sky-100">
                        <tr class="text-sky-700">
                            <th scope="col" class="px-4 py-2 text-left">Name</th>
                            <th scope="col" class="px-4 py-2 text-left">Email</th>
                            <th scope="col" class="px-4 py-2 text-left">Accepted</th>
                            <th scope="col" class="px-4 py-2 text-left"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-sky-100">
                        @foreach($accepted_applicants as $member)
                            <tr wire:key="{{ $member->id }}">
                                <td class="px-4 py-2  text-slate-500">
                                    {{ $member->first_name . ' ' . $member->last_name }}
                                </td>
                                <td class="px-4 py-2 text-slate-500">
                                    {{ $member->email }}
                                </td>
                                <td class="px-4 py-2 text-slate-500">
                                    {{ \Carbon\Carbon::parse($member->accepted_at)->toDayDateTimeString() }} by {{ $member->acceptedBy->first_name . ' ' . $member->acceptedBy->last_name }}
                                </td>
                                <td class="px-4 py-2 text-slate-500">
                                    <x-primary-button class="ms-3">
                                        {{ __('View/Edit') }}
                                    </x-primary-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        @else
            <p class="mt-3 mb-2">No accepted applicants found.</p>
        @endif
    </div>
</div>
