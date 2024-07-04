<div class="flex h-full w-full overflow-y-auto">

    <livewire:cpr.sidebar/>

    <div class="right w-full flex flex-col grow min-w-96 overflow-y-auto">

        <livewire:layout.cpr-navigation/>

        <div class="flex flex-col p-3 xl:p-6 gap-5">

            <div class="flex flex-col content-center mt-8 mb-2">
                <img src="{{ Vite::asset('resources/img/wcec-crest-small.webp') }}"
                     class="inline-block object-contain h-16 lg:h-28" alt="WCEC Logo">

                <h2 class="text-center mx-auto mt-6 text-sky-900 text-3xl border-b-4 border-red-700 pb-2">
                    <span class="">Chartered Practitioners Portal</span>
                </h2>
            </div>

            @if ($logged_in_user->hasRole('admin'))
                <x-admin-dashboard :$logged_in_user
                                   :$next_submission_date
                                   :$next_submission_date_difference
                                   :$submitted_eois
                                   :$submitted_submissions
                                   :$expiring_memberships
                />
            @endif

            @if (Auth::user()->hasRole('applicant'))
                <x-applicant-dashboard :$logged_in_user
                                       :$next_submission_date_difference
                                       :$next_submission_date
                                       :$registration_fee
                                       :$application_fee
                />
            @endif

        </div>

    </div>
</div>
