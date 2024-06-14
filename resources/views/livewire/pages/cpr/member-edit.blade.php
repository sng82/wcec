<div class="flex h-full w-full overflow-hidden">

    <livewire:cpr.sidebar/>

    <div class="right w-full flex grow flex-col p-6 gap-8 overflow-y-auto">

        <div class="rounded-lg bg-slate-50 border border-slate-50 p-4">
            <h2 class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2">
                {{ $first_name . ' ' . $last_name }}
            </h2>

            <form wire:submit="update">
                <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                    <x-admin-input-label for="first_name" :value="__('First Name')" class="lg:w-48" />
                    <x-text-input wire:model="first_name" id="first_name" class="block w-full lg:w-96" type="text" name="first_name" required autofocus autocomplete="first_name" />
                </div>
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />

                <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                    <x-admin-input-label for="last_name" :value="__('Last Name')" class="w-48" />
                    <x-text-input wire:model="last_name" id="last_name" class="block w-full lg:w-96" type="text" name="last_name" required autofocus autocomplete="last_name" />
                </div>
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />

                <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                    <x-admin-input-label for="email" :value="__('Email')" class="w-48" />
                    <x-text-input wire:model="email" id="email" class="block w-full lg:w-[500px]" type="email" name="email" required autofocus autocomplete="email" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                @if($role === 'member' || $role === 'lapsed member')
                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="membership_expires_at" :value="__('Membership Expiry')" class="w-48" />
                        <x-text-input wire:model="membership_expires_at" id="membership_expires_at" class="block" type="date" name="membership_expires_at" required autofocus autocomplete="membership_expires_at" />
                    </div>
                    <x-input-error :messages="$errors->get('membership_expires_at')" class="mt-2" />
                @endif

                <div class="flex flex-col lg:flex-row lg:items-center mt-6 gap-1">
                    <span class="w-48"></span>
                    <div>
                        <x-primary-button>
                            {{ __('Save Changes') }}
                        </x-primary-button>
                    </div>
                </div>

                <hr class="mt-4">

                <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                    <span class="w-52">
                        Membership Level:
                    </span>
                    <span>
                        {{ Str::of($member->roles->pluck('name')[0] ?? '')->title() }}
                    </span>
                </div>

                {{-- Member or Lapsed member --}}
                @if($role === 'member' || $role === 'lapsed member')
                    <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                        <span class="w-52">
                            Became Member:
                        </span>
                        <span>
                            {{ \Carbon\Carbon::parse($became_member_at)->toFormattedDayDateString() }}
                            {{--                            {{ \Carbon\Carbon::parse($became_member_at)->format('d/m/Y') }}--}}
                            {{--                            ({{ \Carbon\Carbon::parse($became_member_at)->diffForHumans() }})--}}
                        </span>
                    </div>

                    <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                        <span class="w-52">
                            Membership {{ $role === 'member' ? 'Expires' : 'Expired' }}:
                        </span>
                        <span>
                            {{ \Carbon\Carbon::parse($membership_expires_at)->toFormattedDayDateString() }}
                        </span>
                    </div>
                @endif

                {{-- Lapsed Member --}}
                @if($role === 'lapsed member')
                @endif

                {{-- Pending Applicant --}}
                @if($role === 'applicant')
                    <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                        <span class="w-52">
                            Created:
                        </span>
                        <span>
                            {{ \Carbon\Carbon::parse($member->created_at)->toFormattedDayDateString() }}
                        </span>
                    </div>
                    <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                        <span class="w-52">
                            Submission Attempts:
                        </span>
                        <span>
                            {{ $submission_count ?? 0 }}
                        </span>
                    </div>
                @endif

                {{-- Accepted Applicant --}}
                @if($role === 'accepted applicant')
                    <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                        <span class="w-52">
                            Application Accepted:
                        </span>
                        <span>
                            {{ \Carbon\Carbon::parse($accepted_at)->toFormattedDayDateString() }}
                        </span>
                    </div>

                    <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                        <span class="w-52">
                            Application Accepted By:
                        </span>
                        <span>
                            {{ $member->acceptedBy->first_name . ' ' . $member->acceptedBy->last_name }}
                        </span>
                    </div>
                @endif

                {{-- Blocked Applicant --}}
                @if($role === 'blocked applicant')
                    <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                        <span class="w-52">
                            Application Declined:
                        </span>
                        <span>
                            {{ \Carbon\Carbon::parse($member->declined_at)->toFormattedDayDateString() }}
                        </span>
                    </div>

                    <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                        <span class="w-52">
                            Application Declined By:
                        </span>
                        <span>
                            {{ $member->declinedBy->first_name . ' ' . $member->declinedBy->last_name }}
                        </span>
                    </div>
                @endif

            </form>

        </div>
    </div>
</div>
