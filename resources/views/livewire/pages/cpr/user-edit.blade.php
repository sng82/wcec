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

                @if($role === 'registrant' || $role === 'lapsed registrant')
                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="registration_expires_at" :value="__('Registration Expiry')" class="w-48" />
                        <x-text-input wire:model="registration_expires_at" id="registration_expires_at" class="block" type="date" name="registration_expires_at" required autofocus autocomplete="registration_expires_at" />
                    </div>
                    <x-input-error :messages="$errors->get('registration_expires_at')" class="mt-2" />
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
                        Account Type:
                    </span>
                    <span>
                        {{ Str::of($registrant->roles->pluck('name')[0] ?? '')->title() }}
                    </span>
                </div>

                {{-- Member or Lapsed member --}}
                @if($role === 'registrant' || $role === 'lapsed registrant')
                    <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                        <span class="w-52">
                            Became Member:
                        </span>
                        <span>
                            {{ \Carbon\Carbon::parse($became_registrant_at)->toFormattedDayDateString() }}
                            {{--                            {{ \Carbon\Carbon::parse($became_registrant_at)->format('d/m/Y') }}--}}
                            {{--                            ({{ \Carbon\Carbon::parse($became_registrant_at)->diffForHumans() }})--}}
                        </span>
                    </div>

                    <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                        <span class="w-52">
                            Registration {{ $role === 'registrant' ? 'Expires' : 'Expired' }}:
                        </span>
                        <span>
                            {{ \Carbon\Carbon::parse($registration_expires_at)->toFormattedDayDateString() }}
                        </span>
                    </div>
                @endif

                {{-- Lapsed Member --}}
                @if($role === 'lapsed registrant')
                @endif

                {{-- Pending Applicant --}}
                @if($role === 'applicant')
                    <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                        <span class="w-52">
                            Created:
                        </span>
                        <span>
                            {{ \Carbon\Carbon::parse($registrant->created_at)->toFormattedDayDateString() }}
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
                            Submission Accepted:
                        </span>
                        <span>
                            {{ \Carbon\Carbon::parse($submission_accepted_at)->toFormattedDayDateString() }}
                        </span>
                    </div>

                    <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                        <span class="w-52">
                            Submission Accepted By:
                        </span>
                        <span>
                            {{ $registrant->acceptedBy->first_name . ' ' . $registrant->acceptedBy->last_name }}
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
                            {{ \Carbon\Carbon::parse($registrant->declined_at)->toFormattedDayDateString() }}
                        </span>
                    </div>

                    <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                        <span class="w-52">
                            Application Declined By:
                        </span>
                        <span>
                            {{ $registrant->declinedBy->first_name . ' ' . $registrant->declinedBy->last_name }}
                        </span>
                    </div>
                @endif

            </form>

        </div>
    </div>
</div>
