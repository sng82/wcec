<div class="flex h-full w-full overflow-y-auto">

    <livewire:cpr.sidebar/>

    <div class="right w-full min-w-80 flex grow flex-col overflow-y-auto">

{{--        <livewire:layout.cpr-navigation/>--}}

        <div class="flex flex-col p-3 xl:p-6">

            <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 mb-4 xl:mb-6 shadow-md shadow-slate-300">
                <h2 class="text-2xl text-sky-800 border-b-4 border-red-700 pb-2">
                    My Details
                </h2>

                <form wire:submit="update">
                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="first_name" :value="__('First Name')" class="lg:w-48" />
                        <x-text-input wire:model="first_name" id="first_name" class="block w-full lg:w-96" type="text" name="first_name" required autofocus autocomplete="first_name" />
                    </div>
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />

                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="last_name" :value="__('Last Name')" class="w-48" />
                        <x-text-input wire:model="last_name" id="last_name" class="block w-full lg:w-96" type="text" name="last_name" required autocomplete="last_name" />
                    </div>
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />

                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="email" :value="__('Email')" class="w-48" />
                        <x-text-input wire:model="email" id="email" class="block w-full lg:w-[500px]" type="email" name="email" required autocomplete="email" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="phone_main" :value="__('Phone (main)')" class="w-48" />
                        <x-text-input wire:model="phone_main" id="phone_main" class="block w-full lg:w-[500px]" type="text" name="phone_main" required />
                    </div>
                    <x-input-error :messages="$errors->get('phone_main')" class="mt-2" />

                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="phone_mobile" :value="__('Phone (mobile)')" class="w-48" />
                        <x-text-input wire:model="phone_mobile" id="phone_mobile" class="block w-full lg:w-[500px]" type="text" name="phone_mobile" />
                    </div>
                    <x-input-error :messages="$errors->get('phone_mobile')" class="mt-2" />

                    <div class="flex flex-col lg:flex-row lg:items-center mt-6 gap-1">
                        <span class="w-48"></span>
                        <div>
                            <x-primary-button>
                                {{ __('Save Changes') }}
                            </x-primary-button>
                        </div>
                    </div>

                    <p class="mt-3 text-sm lg:ml-48 lg:pl-1">Password can be reset via the 'Forgot your Password?' link on the login page.</p>
                </form>
            </div>

            <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 mb-4 xl:mb-6 shadow-md shadow-slate-300">
                <h3 class="text-xl text-sky-800 border-b-4 border-red-700 pb-1 mb-2">
                    Additional Details
                </h3>
                <div class="mt-3">
                    <span class="inline-block font-bold w-48">Account Type:</span>
                    <span class="inline-block lg:pl-1">
                        @foreach($roles as $role)
                            {{ str($role)->title() }}
                            {{ $loop->last ? '' : '|' }}
                        @endforeach
                    </span>
                </div>
                @if($role === 'registrant')
                    <div class="mt-2">
                        <span class="inline-block font-bold w-48">Date Awarded:</span>
                        <span class="inline-block lg:pl-1">{{ \Carbon\Carbon::parse($user->became_registrant_at)->toFormattedDayDateString() }}</span>
                    </div>
                    <div class="mt-2">
                        <span class="inline-block font-bold w-48">Registration Expiry:</span>
                        <span class="inline-block lg:pl-1">{{ \Carbon\Carbon::parse($user->registration_expires_at)->toFormattedDayDateString() }}</span>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
