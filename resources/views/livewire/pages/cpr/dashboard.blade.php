<div class="flex h-full w-full overflow-y-auto">

    <livewire:cpr.sidebar/>

    <div class="right w-full flex flex-col grow min-w-80 overflow-y-auto" style="scroll-behavior: smooth;">

{{--        <livewire:layout.cpr-navigation/>--}}

        <div class="flex flex-col p-3 xl:p-6">

            <div class="flex flex-col content-center mt-8 mb-4">
                <img src="{{ Vite::asset('resources/img/wcec-crest-small.webp') }}"
                     class="inline-block object-contain h-16 lg:h-28" alt="WCEC Logo">

                <h2 class="text-center mx-auto mt-6 text-sky-900 text-3xl border-b-4 border-red-700 pb-2">
                    <span class="">Chartered Practitioners Portal</span>
                </h2>
{{--                debug--}}
{{--                @foreach($logged_in_user->getRoleNames() as $role)--}}
{{--                    {{ $role . ' | ' }}--}}
{{--                @endforeach--}}
            </div>

            @if ($logged_in_user->hasRole('admin'))
                <x-dashboard-admin :$logged_in_user
                                   :$next_admission_date
                                   :$next_admission_date_difference
                                   :$submitted_eois
                                   :$submitted_submissions
                                   :$expiring_registrations
                                   :$overdue_registrations
                />
            @endif

            @if ($logged_in_user->hasRole('applicant'))
                <x-dashboard-applicant :$logged_in_user
                                       :$next_admission_date_difference
                                       :$next_admission_date
                                       :$registration_fee
                                       :$submission_fee
                />
            @endif

            @if($logged_in_user->hasRole('accepted applicant'))
                <x-dashboard-accepted-applicant :$logged_in_user
                                                :$next_admission_date />
            @endif

            @if($logged_in_user->hasRole('blocked applicant'))
                <x-dashboard-blocked-applicant :$logged_in_user
                                               :$renewal_due
                />
            @endif


            @if ($logged_in_user->hasRole('registrant'))
                <x-dashboard-registrant :$logged_in_user
                                        :$renewal_fee
                                        :$renewal_due
                                        :$renewal_fee_due
                                        :$cpd_due
                                        :$renewal_window
                                        :$cpd_template_document
                />
            @endif

            @if($logged_in_user->hasRole('lapsed registrant'))
                <x-dashboard-lapsed-registrant :$logged_in_user
                                               :$renewal_fee
                                               :$renewal_due
                />
            @endif

{{--            <div>--}}
{{--                {{ $logged_in_user->hasRole('admin') ? 'Admin ' : '' }}--}}
{{--                {{ $logged_in_user->hasRole('applicant') ? 'applicant ' : '' }}--}}
{{--                {{ $logged_in_user->hasRole('accepted applicant') ? 'accepted applicant ' : '' }}--}}
{{--                {{ $logged_in_user->hasRole('blocked applicant') ? 'blocked applicant ' : '' }}--}}
{{--                {{ $logged_in_user->hasRole('registrant') ? 'registrant ' : '' }}--}}
{{--                {{ $logged_in_user->hasRole('lapsed registrant') ? 'lapsed registrant ' : '' }}--}}
{{--            </div>--}}

        </div>

    </div>
</div>
