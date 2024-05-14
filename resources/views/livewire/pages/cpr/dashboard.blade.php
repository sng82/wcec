<div class="flex h-full w-full">

    <livewire:cpr.sidebar />

    <div class="right w-full flex flex-col grow p-6 gap-5 overflow-y-auto">

        <div class="flex flex-col content-center mt-8 mb-6">
            <img src="{{ Vite::asset('resources/img/wcec-crest-small.webp') }}" class="inline-block object-contain h-16 lg:h-28" alt="WCEC Logo">
            <h2 class="text-center mx-auto mt-6 text-sky-900 text-2xl border-b-4 border-red-700 pb-2">Chartered Practitioners Portal</h2>
        </div>

        @if (Auth::user()->hasRole('admin'))
            <div class="bg-slate-50 rounded-lg p-6 shadow">
                <p class="mb-4">
                    Hi, {{ Auth::user()->first_name }},
                </p>

                <p class="">
                    The next Submission Date is
                    <span class="font-bold">{{ $nextSubmissionDate }}</span>
                    ({{ $nextSubmissionDateDifference }}).
                </p>

{{--                @dd($this->all())--}}
            </div>

            <div class="bg-slate-50 rounded-lg p-6 shadow">
                @if($expiring_memberships->count() > 0)
                    <p class="mb-4 text-red-700">
                        {{ $expiring_memberships->count() . 'x' }}
                        {{ Str::of('membership')->plural($expiring_memberships->count()) }}
                        due to expire within the next 30 days:
                    </p>
                    <div class="mt-3 mb-2 overflow-hidden border border-red-100 rounded-lg shadow-sm">
                        <table class="table-auto w-full divide-y divide-red-100">
                            <thead class="bg-red-100">
                                <tr class="text-red-700 divide-x divide-red-200">
                                    <th scope="col" class="px-4 py-2 text-left">
                                        Name
                                    </th>
                                    <th scope="col" class="px-4 py-2 text-left">
                                        Email
                                    </th>
                                    <th scope="col" class="px-4 py-2 text-left">
                                        Membership Expires
                                    </th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-red-100">
                                @foreach($expiring_memberships as $member)
                                    <tr wire:key="{{ $member->id }}">
                                        <td class="px-4 py-2  text-slate-500">
                                            {{ $member->first_name . ' ' . $member->last_name }}
                                        </td>
                                        <td class="px-4 py-2 text-slate-500">
                                            {{ $member->email }}
                                        </td>
                                        <td class="px-4 py-2 text-red-700">
                                            {{ \Carbon\Carbon::parse($member->membership_expires_at)->toFormattedDayDateString() }}
                                        </td>
                                        <td class="px-4 py-2 text-slate-500">
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
                    <p class="mb-4">No memberships are due to expire within the next 30 days.</p>
                @endif
            </div>
        @endif

    </div>

</div>
