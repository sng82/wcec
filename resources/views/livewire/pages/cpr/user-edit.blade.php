@php
use Carbon\Carbon;
use Carbon\CarbonInterface;
@endphp

<div class="flex h-full w-full overflow-hidden">

    <livewire:cpr.sidebar/>

    <div class="right w-full flex grow flex-col p-6 gap-8 overflow-y-auto">

        <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 shadow-md shadow-slate-300">
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

            </form>
        </div>

        @if($roles->contains('registrant') && $registration_expires_at < now())
            <div class="bg-slate-50 rounded-lg shadow-md shadow-slate-300 border-4 border-orange-600">
                <div class="bg-orange-100 rounded-t-lg p-3 xl:p-4 ">
                    <h2 class="text-xl text-orange-700 border-b-4 border-orange-600 pb-2">
                        Registration Renewal Overdue
                    </h2>
                </div>
                <div class="p-3 xl:p-4">
                    <p class="mb-2">
                        This individual failed to renew their registration before it expired.
                    </p>
                    <p class="mb-2">
                        Registration Expiry date:
                        {{ Carbon::parse($registration_expires_at)->toFormattedDayDateString() }}
                        ({{ Carbon::parse(now()->format('y-m-d'))->diff($registrant->registration_expires_at->format('y-m-d'), CarbonInterface::DIFF_ABSOLUTE) }} ago)
                    </p>
                    <p class="mb-2">
                        CPD last submitted:
                        {{ !empty($registrant->cpd_last_submitted_at)
                            ? Carbon::parse($registrant->cpd_last_submitted_at)->toFormattedDayDateString() . '(' . Carbon::parse(now()->format('y-m-d'))->diff($registrant->cpd_last_submitted_at->format('y-m-d'), CarbonInterface::DIFF_ABSOLUTE) . ')'
                            : 'N/A'
                        }}
                    </p>
                    <p class="mb-2">
                        Renewal fee last paid:
                        {{ !empty($registrant->renewal_fee_last_paid_at)
                            ? Carbon::parse($registrant->renewal_fee_last_paid_at)->toFormattedDayDateString() . '(' . Carbon::parse(now()->format('y-m-d'))->diff($registrant->renewal_fee_last_paid_at->format('y-m-d'), CarbonInterface::DIFF_ABSOLUTE) . ')'
                            : 'N/A'
                        }}
                    </p>
                    <hr class="my-2">
                    <p class="mb-2">
                        This individual is not currently visible on the public register, but still has
                        the status of 'Active Registrant' meaning they are able to renew their registration.
                    </p>
                    <p class="mb-2">
                        Press the 'Demote' button to change this individuals status to 'Lapsed Registrant'.
                    </p>
                    <p class="mb-4">
                        Lapsed Registrants are not able to renew their registrations. To rejoin the register they will need to reapply
                        in exactly the same way as a new applicant. The only difference being that they would retain
                        their existing registration number and admittance date.
                    </p>

                    <button type="button"
                            wire:click="setLapsed"
                            wire:confirm="Please confirm that you wish to change this individuals status from 'Active Registrant' to 'Lapsed Registrant'"
                            class="bg-red-600 hover:bg-red-700 focus:cursor-wait w-fit pl-4 pr-2 gap-2 py-2 text-white rounded-full flex flex-row"
                    >
                        <span>Demote</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>


                    </button>
                </div>
            </div>
        @endif

        @if($roles->contains('lapsed registrant'))
            <div class="bg-slate-50 rounded-lg shadow-md shadow-slate-300 border border-red-700">
                <div class="bg-red-50 rounded-t-lg p-3 xl:p-4 ">
                    <h2 class="text-xl text-red-700 border-b-4 border-red-700 pb-2">
                        Lapsed Registrant
                    </h2>
                </div>
                <div class="p-3 xl:p-4">
                    <p class="mb-2 text-gray-500">
                        This individual failed to renew their registration before it expired which
                        resulted in their account status changing from
                        'Active Registrant' to 'Lapsed Registrant'.
                    </p>
                    <p class="mb-2 text-gray-500">
                        Registration Expiry date:
                        <span class="font-bold">
                        {{ Carbon::parse($registration_expires_at)->toFormattedDayDateString() }}
                        ({{ Carbon::parse(now()->format('y-m-d'))->diff($registrant->registration_expires_at->format('y-m-d'), CarbonInterface::DIFF_ABSOLUTE) }} ago)
                        </span>
                    </p>
                    <p class="mb-2 text-gray-500">
                        CPD last submitted:
                        {{ !empty($registrant->cpd_last_submitted_at)
                            ? Carbon::parse($registrant->cpd_last_submitted_at)->toFormattedDayDateString() . '(' . Carbon::parse(now()->format('y-m-d'))->diff($registrant->cpd_last_submitted_at->format('y-m-d'), CarbonInterface::DIFF_ABSOLUTE) . ')'
                            : 'N/A'
                        }}
                    </p>
                    <p class="mb-2 text-gray-500">
                        Renewal fee last paid:
                        {{ !empty($registrant->renewal_fee_last_paid_at)
                            ? Carbon::parse($registrant->renewal_fee_last_paid_at)->toFormattedDayDateString() . '(' . Carbon::parse(now()->format('y-m-d'))->diff($registrant->renewal_fee_last_paid_at->format('y-m-d'), CarbonInterface::DIFF_ABSOLUTE) . ')'
                            : 'N/A'
                        }}
                    </p>
                    <hr class="my-2">
                    <p class="mb-2">
                        Lapsed Registrants are not visible on the public register and cannot
                        submit CPD's, pay renewal fees or renew their registration.
                    </p>
                    <p class="mb-2">
                        Their are two routes back on to the register for lapsed registrants:
                    </p>
                    <ol class="list-decimal ml-6">
                        <li>
                            Restart the application process, similarly to a new applicant.
                            The only difference being that lapsed registrants will retain
                            their original registration number and admission date upon acceptance.
                        </li>
                        <li>
                            If the registration expiry date was within the last 12 months,
                            admins can opt to promote a 'Lapsed Registrant' back
                            to 'Active Registrant' status. This will not automatically
                            add the individual to the publicly visible register, but will
                            allow the individual to complete the steps necessary to renew,
                            such as submitting CPD and paying the renewal fee.
                        </li>
                    </ol>

                    <hr class="my-4">

                    @if ( Carbon::parse($registration_expires_at)->addYear() > now())
                        <p class="mb-2">
                            You can promote this individuals account status to 'Active Registrant' by pressing
                            the 'Set Active' button below.
                        </p>
                        <p class="mb-4">
                            This option is available because the registration expired within the last 12 months.
                        </p>

                        <button type="button"
                                wire:click="setActive"
                                wire:confirm="Please confirm that you wish to change this individuals status from 'Lapsed Registrant' to 'Active Registrant'"
                                class="bg-fuchsia-600 hover:bg-fuchsia-700 focus:cursor-wait w-fit pl-4 pr-2 gap-2 py-2 text-white rounded-full flex flex-row"
                        >
                            <span>Set Active</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>
                    @else
                        <p class="mb-2">
                            This individuals status can not be promoted to 'Active Registrant' because their registration
                            expired more than a year ago.
                        </p>
                    @endif
                    <hr class="my-4">
                    <p class="mb-2">
                        You can reset this account status to 'Applicant' by pressing the 'Make Applicant' button below.
                    </p>
                    <p class="mb-4">
                        This will allow the individual to re-apply for inclusion in the CPR in exactly the same way as a new applicant.
                    </p>
                    <p class="mb-4">
                        <span class="font-bold  uppercase">Please note:</span>
                        <span class=" text-red-600 ">This action is NOT reversible.</span>
                    </p>

                    <button type="button"
                            wire:click="setApplicant"
                            wire:confirm="Please confirm that you wish to change this individuals status from 'Lapsed Registrant' to 'Applicant'"
                            class="bg-red-600 hover:bg-red-700 focus:cursor-wait w-fit pl-4 pr-2 gap-2 py-2 text-white rounded-full flex flex-row"
                    >
                        <span>Make Applicant</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 shadow-md shadow-slate-300">
            <h2 class="text-xl text-sky-800 border-b-4 border-sky-700 pb-2">
                Additional Details
            </h2>
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

            {{-- Accepted Applicant, Registrant or Lapsed Registrant--}}
            @if(
                $roles->contains('accepted applicant') ||
                $roles->contains('registrant') ||
                $roles->contains('lapsed registrant')
            )
                <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                    <span class="w-52">
                        Registration Number:
                    </span>
                    <span>
                        {{ $registrant->reg_no }}
                    </span>
                </div>

                <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                    <span class="w-52">
                        Registration Pathway
                    </span>
                    <span>
                        {{ str($registrant->registration_pathway)->title }}
                    </span>
                </div>

                <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                    <span class="w-52">
                        Submission Accepted:
                    </span>
                    <span>
                        {{ !empty($submission_accepted_at)
                            ? Carbon::parse($submission_accepted_at)->toFormattedDayDateString()
                            : 'Unknown'
                        }}
                    </span>
                </div>

                <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                    <span class="w-52">
                        Submission Accepted By:
                    </span>
                    <span>
                        {{ !empty ($registrant->acceptedBy)
                            ? $registrant->acceptedBy->first_name . ' ' . $registrant->acceptedBy->last_name
                            : 'Unknown'
                        }}
                    </span>
                </div>

            @endif

            {{-- Registrant or Lapsed Registrant --}}
            @if($roles->contains('registrant') || $roles->contains('lapsed registrant'))
                <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                    <span class="w-52">
                        Date Awarded:
                    </span>
                    <span>
                        {{ Carbon::parse($became_registrant_at)->toFormattedDayDateString() }}
                    </span>
                </div>

                <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                    <span class="w-52">
                        Registration {{ $roles->contains('lapsed registrant') ? 'Expired' : 'Expires' }}:
                    </span>
                    <span>
                        {{ Carbon::parse($registration_expires_at)->toFormattedDayDateString() }}
                    </span>
                </div>
            @endif

            {{-- Lapsed Registrant --}}
            @if($roles->contains('lapsed registrant'))
            @endif

            {{-- Pending Applicant --}}
            @if($roles->contains('applicant'))
                <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                    <span class="w-52">
                        Created:
                    </span>
                    <span>
                        {{ Carbon::parse($registrant->created_at)->toFormattedDayDateString() }}
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




            {{-- Blocked Applicant --}}
            @if($roles->contains('blocked applicant'))
                <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                    <span class="w-52">
                        Application Declined:
                    </span>
                    <span>
                        {{ Carbon::parse($registrant->declined_at)->toFormattedDayDateString() }}
                    </span>
                </div>

                <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                    <span class="w-52">
                        Application Declined By:
                    </span>
                    <span>
                        {{ !empty($registrant->declined_by) ? $registrant->declinedBy?->first_name . ' ' . $registrant->declinedBy?->last_name : 'Unknown' }}
                    </span>
                </div>
            @endif

            @if($roles->contains('applicant') || $roles->contains('blocked applicant'))
                <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                    <span class="w-52">
                        Registration Fee Paid?:
                    </span>
                    <span>
                        {{ $registrant->registration_fee_paid > 0 ? 'Yes' : 'No' }}
                    </span>
                </div>
                <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                    <span class="w-52">
                        Submission Fee Paid?:
                    </span>
                    <span>
                        {{ $registrant->submission_fee_paid > 0 ? 'Yes' : 'No' }}
                    </span>
                </div>
            @endif


        </div>
    </div>
</div>
