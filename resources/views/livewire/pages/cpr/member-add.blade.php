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

        <livewire:layout.cpr-navigation />

        <div class="flex flex-col p-3 xl:p-6 gap-5">

            <div class="rounded-lg bg-slate-50 border border-slate-50 p-4 shadow">
                <h2 class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2">
                    New Applicant/Member
                </h2>

    {{--            {{ Spatie\Permission\Models\Role::get()->pluck('name') }}--}}

                <form wire:submit="save">
                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="first_name" :value="__('First Name')" class="lg:w-48" />
                        <x-text-input wire:model="first_name" id="first_name" class="block w-full lg:w-96" type="text" name="first_name" required autofocus autocomplete="given-name" />
                    </div>
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />

                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="last_name" :value="__('Last Name')" class="w-48" />
                        <x-text-input wire:model="last_name" id="last_name" class="block w-full lg:w-96" type="text" name="last_name" required autocomplete="family-name" />
                    </div>
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />

                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="email" :value="__('Email')" class="w-48" />
                        <x-text-input wire:model="email" id="email" class="block w-full lg:w-[500px]" type="email" name="email" required autocomplete="email" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="phone_1" :value="__('Phone (Primary)')" class="w-48" />
                        <x-text-input wire:model="phone_1" id="phone_1" class="block w-full lg:w-60" type="text" name="phone_1" autocomplete="phone" />
                    </div>
                    <x-input-error :messages="$errors->get('phone_1')" class="mt-2" />

                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="phone_2" :value="__('Phone (2)')" class="w-48" />
                        <x-text-input wire:model="phone_2" id="phone_2" class="block w-full lg:w-60" type="text" name="phone_2" />
                    </div>
                    <x-input-error :messages="$errors->get('phone_2')" class="mt-2" />

                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="phone_3" :value="__('Phone (3)')" class="w-48" />
                        <x-text-input wire:model="phone_3" id="phone_3" class="block w-full lg:w-60" type="text" name="phone_3" />
                    </div>
                    <x-input-error :messages="$errors->get('phone_3')" class="mt-2" />

                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="role" :value="__('Membership Level')" class="w-48" />
                        <select wire:model="role" id="role" name="role" class="border-gray-300 focus:border-indigo-500 focus:ring-sky-500 rounded-md shadow-sm lg:w-52">
                            <option value="" selected>- Please Select -</option>
                            <option value="applicant">Applicant</option>
                            <option value="member">Member</option>
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
    {{--                        <span> - Only relevant if membership level is 'Applicant'</span>--}}
                        </div>
                        <span class="text-sm text-gray-700 italic">Only relevant if Membership Level = Applicant.</span>
                    </div>

                    <div class="flex flex-col lg:flex-row lg:items-center mt-5 gap-1">
                        <x-admin-input-label for="application_fee_paid" :value="__('Application Fee Paid')" class="w-48" />
                        <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                            <input wire:model="application_fee_paid" type="checkbox" name="application_fee_paid" id="application_fee_paid"
                                   class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50 cursor-pointer"/>
                            <label for="application_fee_paid" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-200 border border-gray-300 cursor-pointer"></label>
                        </div>
                        <span class="text-sm text-gray-700 italic">Only relevant if Membership Level = Applicant.</span>
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
