<div class="flex h-full w-full overflow-hidden">

    <livewire:cpr.sidebar/>

    <div class="right w-full flex grow flex-col p-6 gap-8 overflow-y-auto">

        <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 mb-4 xl:mb-6 shadow-md shadow-slate-300">
            <h2 class="text-2xl text-sky-800 border-b-4 border-red-700 pb-2">
                {{ $first_name . ' ' . $last_name }}
                @foreach($roles as $role)
                    <span class="text-lg uppercase font-bold text-sky-500">[{{ str($role)->title() }}] </span>
                @endforeach
            </h2>

            <form wire:submit="update">
                <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                    <x-admin-input-label for="first_name" :value="__('First Name')" class="lg:w-48" />
                    <x-text-input wire:model="first_name" id="first_name" class="block w-full lg:w-96" type="text" name="first_name" required autofocus autocomplete="first_name" />
                    <x-input-error :messages="$errors->get('first_name')" class="ml-2 mt-2" />
                </div>

                <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                    <x-admin-input-label for="last_name" :value="__('Last Name')" class="w-48" />
                    <x-text-input wire:model="last_name" id="last_name" class="block w-full lg:w-96" type="text" name="last_name" required autocomplete="last_name" />
                    <x-input-error :messages="$errors->get('last_name')" class="ml-2 mt-2" />
                </div>

                <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                    <x-admin-input-label for="email" :value="__('Email')" class="w-48" />
                    <x-text-input wire:model="email" id="email" class="block w-full lg:w-[500px]" type="email" name="email" required autocomplete="email" />
                    <x-input-error :messages="$errors->get('email')" class="ml-2 mt-2" />
                </div>


                <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                    <x-admin-input-label for="phone_main" :value="__('Phone (Main)')" class="w-48" />
                    <x-text-input wire:model="phone_main" id="phone_main" class="block w-full lg:w-60" type="text" name="phone_main" autocomplete="off" />
                    <x-input-error :messages="$errors->get('phone_main')" class="ml-2 mt-2" />
                </div>

                <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                    <x-admin-input-label for="phone_mobile" :value="__('Phone (Mobile)')" class="w-48" />
                    <x-text-input wire:model="phone_mobile" id="phone_mobile" class="block w-full lg:w-60" type="text" name="phone_mobile" autocomplete="off"  />
                    <x-input-error :messages="$errors->get('phone_mobile')" class="ml-2 mt-2" />
                </div>

                @if($roles[0] === 'registrant' || $roles[0] === 'lapsed registrant')
                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="registration_expires_at" :value="__('Registration Expiry')" class="w-48" />
                        <x-text-input wire:model="registration_expires_at" id="registration_expires_at" class="block" type="date" name="registration_expires_at" required autocomplete="registration_expires_at" />
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
                        @foreach($roles as $role)
                            {{ str($role)->title() }}
                            {{ $loop->last ? '' : '|' }}
                        @endforeach
{{--                        {{ \Illuminate\Support\Str::of($registrant->roles->pluck('name')[0] ?? '')->title() }}--}}
                    </span>
                </div>

                {{-- Member or Lapsed member --}}
                @if($roles->contains('registrant') || $roles->contains('lapsed registrant'))
                    <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                        <span class="w-52">
                            Date Awarded:
                        </span>
                        <span>
                            {{ \Carbon\Carbon::parse($became_registrant_at)->toFormattedDayDateString() }}
                        </span>
                    </div>

                    <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                        <span class="w-52">
                            Registration {{ $roles->contains('lapsed registrant') ? 'Expired' : 'Expires' }}:
                        </span>
                        <span>
                            {{ \Carbon\Carbon::parse($registration_expires_at)->toFormattedDayDateString() }}
                        </span>
                    </div>
                @endif

                {{-- Lapsed Member --}}
                @if($roles->contains('lapsed registrant'))
                @endif

                {{-- Pending Applicant --}}
                @if($roles->contains('applicant'))
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


                {{-- Accepted Applicant or Registrant--}}
                @if(
                    $roles->contains('accepted applicant') ||
                    $roles->contains('registrant') ||
                    $roles->contains('lapsed registrant')
                )
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
                @if($roles->contains('blocked applicant'))
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
