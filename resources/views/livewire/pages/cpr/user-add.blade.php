<div class="flex h-full w-full overflow-hidden">

    <style>
        [type='checkbox'] {
            color: #22c55e;
        }
        .toggle-checkbox {
            background-color: #d1d5db;
            border-color: #9ca3af;
        }
        .toggle-checkbox:checked {
            @apply: right-0 border-green-300;
            right: 0;
            border-color: #22c55e;
        }
        .toggle-checkbox:checked + .toggle-label {
            @apply: bg-green-300;
            background-color: #86efac;
            border-color: #4ade80;
        }
    </style>

    <livewire:cpr.sidebar/>

    <div class="right w-full flex flex-col grow min-w-80 overflow-y-auto">

{{--        <livewire:layout.cpr-navigation />--}}

        <div class="flex flex-col p-3 xl:p-6 gap-5">

            <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 mb-4 xl:mb-6 shadow-md shadow-slate-300">
                <h2 class="text-2xl text-sky-800 border-b-4 border-red-700 pb-2">
                    New Applicant/Registrant
                </h2>
                <form wire:submit="saveUser">
                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="first_name" :value="__('First Name')" class="lg:w-48" />
                        <x-text-input wire:model="first_name" id="first_name"
                                      class="block w-full lg:w-96" type="text"
                                      name="first_name" required autofocus autocomplete="new-name" />
                    </div>
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />

                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="last_name" :value="__('Last Name')" class="w-48" />
                        <x-text-input wire:model="last_name" id="last_name"
                                      class="block w-full lg:w-96" type="text"
                                      name="last_name" required autocomplete="new-name" />
                    </div>
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />

                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="email" :value="__('Email')" class="w-48" />
                        <x-text-input wire:model="email" id="email"
                                      class="block w-full lg:w-[500px]" type="email"
                                      name="email" required autocomplete="new-email" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="phone_main" :value="__('Phone (Main)')" class="w-48" />
                        <x-text-input wire:model="phone_main" id="phone_main" class="block w-full lg:w-60" type="text" name="phone_main" autocomplete="off" />
                    </div>
                    <x-input-error :messages="$errors->get('phone_main')" class="mt-2" />

                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="phone_mobile" :value="__('Phone (Mobile)')" class="w-48" />
                        <x-text-input wire:model="phone_mobile" id="phone_mobile" class="block w-full lg:w-60" type="text" name="phone_mobile" autocomplete="off"  />
                    </div>
                    <x-input-error :messages="$errors->get('phone_mobile')" class="mt-2" />

                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="role" :value="__('Account Type')" class="w-48" />
                        <select wire:model="role" id="role" name="role" class="border-gray-300 focus:border-indigo-500 focus:ring-sky-500 rounded-md shadow-sm lg:w-52">
                            <option value="" selected>- Please Select -</option>
                            <option value="applicant">Applicant</option>
                            <option value="registrant">Registrant</option>
                            <option value="admin">Admin</option>
    {{--                        @foreach($roles as $r)--}}
    {{--                            <option wire:key="{{ $r->id }}" value="{{ $r->name }}" >{{ Str::of($r->name)->title() }}</option>--}}
    {{--                        @endforeach--}}
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />

                    <hr class="my-6">

                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="registration_fee_paid" :value="__('Registration Fee Paid')" class="w-48" />
                        <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                            <input wire:model="registration_fee_paid" type="checkbox" name="registration_fee_paid" id="registration_fee_paid"
                                   class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50 cursor-pointer"/>
                            <label for="registration_fee_paid" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-200 border border-gray-300 cursor-pointer"></label>
                        </div>
                        <span class="text-sm text-gray-700 italic">Only relevant if Account Type = Applicant.</span>
                    </div>

                    <div class="flex flex-col lg:flex-row lg:items-center mt-5 gap-1">
                        <x-admin-input-label for="submission_fee_paid" :value="__('Submission Fee Paid')" class="w-48" />
                        <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                            <input wire:model="submission_fee_paid" type="checkbox" name="submission_fee_paid" id="submission_fee_paid"
                                   class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50 cursor-pointer"/>
                            <label for="submission_fee_paid" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-200 border border-gray-300 cursor-pointer"></label>
                        </div>
                        <span class="text-sm text-gray-700 italic">Only relevant if Account Type = Applicant.</span>
                    </div>

                    <hr class="my-6 border-slate-200">

                    <div class="flex flex-col lg:flex-row lg:items-center mt-5 gap-1">
                        <x-admin-input-label for="send_email" :value="__('Send Email')" class="w-48" />
                        <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                            <input wire:model="send_email" type="checkbox" name="send_email" id="send_email"
                                   class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50 cursor-pointer"/>
                            <label for="send_email" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-200 border border-gray-300 cursor-pointer"></label>
                        </div>
                        <span class="text-sm text-gray-700 italic">Send this user an email containing login instructions.</span>
                    </div>

                    <div class="flex flex-col lg:flex-row lg:items-center mt-8 gap-1">
                        <span class="w-48"></span>
                        <div>
                            <x-primary-button>
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
