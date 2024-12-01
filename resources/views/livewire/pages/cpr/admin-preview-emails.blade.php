<div class="flex h-full w-full overflow-hidden">

    <livewire:cpr.sidebar/>

    <div class="right w-full flex flex-col grow overflow-y-auto">

        <div class="flex flex-col flex-grow p-3 xl:p-6 overflow-y-auto">

            <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 mb-4 xl:mb-6 shadow-md shadow-slate-300">
                <h2 class="text-2xl text-sky-800 border-b-4 border-red-700 mb-3 pb-2">
                    Email Previews
                </h2>
                <p class="mb-2">
                    All emails that can be sent from the Chartered Practitioners Portal are listed below.
                </p>
                <p class="mb-4">
                    Previews are populated with example data. They will open in a new browser tab.
                </p>

                <div class="overflow-hidden border border-slate-100 rounded-lg shadow-sm overflow-x-auto">
                    <table class="table-auto w-full divide-y divide-slate-100 text-sm">
                        <thead class="bg-slate-200">
                            <tr class="text-slate-700">
                                <th scope="col" class="px-4 py-2 text-left min-w-44">Recipient</th>
                                <th scope="col" class="px-4 py-2 text-left min-w-44">Title</th>
                                <th scope="col" class="px-4 py-2 text-left min-w-44">Description</th>
                                <th scope="col" class="px-4 py-2 text-left min-w-44"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">

                            <tr>
                                <td class="px-4 py-2">
                                    Admin
                                </td>
                                <td class="px-4 py-2">
                                    EoI Submitted
                                </td>
                                <td class="px-4 py-2">
                                    Informs admins that an Expression of Interest has been submitted.
                                </td>
                                <td class="px-4 py-2">
                                    <a href="/mail/preview/eoi-submitted" target="_blank" class="text-white bg-fuchsia-500 px-4 py-1 rounded-full">
                                        Preview
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="px-4 py-2">
                                    Admin
                                </td>
                                <td class="px-4 py-2">
                                    Submission Submitted
                                </td>
                                <td class="px-4 py-2">
                                    Informs admins that a submission has been submitted.
                                </td>
                                <td class="px-4 py-2">
                                    <a href="/mail/preview/submission-submitted" target="_blank" class="text-white bg-fuchsia-500 px-4 py-1 rounded-full">
                                        Preview
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="px-4 py-2">
                                    Admin
                                </td>
                                <td class="px-4 py-2">
                                    Fee Paid
                                </td>
                                <td class="px-4 py-2">
                                    Informs admins that a fee (registration, submission, renewal) has been paid.
                                </td>
                                <td class="px-4 py-2">
                                    <a href="/mail/preview/admin-fee-paid" target="_blank" class="text-white bg-fuchsia-500 px-4 py-1 rounded-full">
                                        Preview
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="px-4 py-2">
                                    Applicant
                                </td>
                                <td class="px-4 py-2">
                                    Interview Notification
                                </td>
                                <td class="px-4 py-2">
                                    Informs an applicant that an interview date and time has been scheduled.
                                </td>
                                <td class="px-4 py-2">
                                    <a href="/mail/preview/interview-notification" target="_blank" class="text-white bg-fuchsia-500 px-4 py-1 rounded-full">
                                        Preview
                                    </a>
                                </td>
                            </tr>










                            <tr>
                                <td class="px-4 py-2">
                                    Applicant
                                </td>
                                <td class="px-4 py-2">
                                    EoI Accepted
                                </td>
                                <td class="px-4 py-2">
                                    Sent to an applicant when their EoI is accepted.
                                </td>
                                <td class="px-4 py-2">
                                    <a href="/mail/preview/eoi-accepted" target="_blank" class="text-white bg-fuchsia-500 px-4 py-1 rounded-full">
                                        Preview
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="px-4 py-2">
                                    Applicant
                                </td>
                                <td class="px-4 py-2">
                                    EoI Not Accepted
                                </td>
                                <td class="px-4 py-2">
                                    Sent to an applicant when their EoI is not accepted, but they haven't been rejected.
                                </td>
                                <td class="px-4 py-2">
                                    <a href="/mail/preview/eoi-unaccepted" target="_blank" class="text-white bg-fuchsia-500 px-4 py-1 rounded-full">
                                        Preview
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="px-4 py-2">
                                    Applicant
                                </td>
                                <td class="px-4 py-2">
                                    EoI Rejected
                                </td>
                                <td class="px-4 py-2">
                                    Sent to an applicant when their EoI is rejected.
                                </td>
                                <td class="px-4 py-2">
                                    <a href="/mail/preview/eoi-rejected" target="_blank" class="text-white bg-fuchsia-500 px-4 py-1 rounded-full">
                                        Preview
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="px-4 py-2">
                                    Applicant/Registrant
                                </td>
                                <td class="px-4 py-2">
                                    Login Instructions
                                </td>
                                <td class="px-4 py-2">
                                    Can optionally be sent to new users when an account is created for them by an admin.
                                </td>
                                <td class="px-4 py-2">
                                    <a href="/mail/preview/login-instructions" target="_blank" class="text-white bg-fuchsia-500 px-4 py-1 rounded-full">
                                        Preview
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="px-4 py-2">
                                    Applicant/Registrant
                                </td>
                                <td class="px-4 py-2">
                                    Fee Paid
                                </td>
                                <td class="px-4 py-2">
                                    Sent to applicant/registrant when any fee (registration, submission, renewal) is paid.
                                </td>
                                <td class="px-4 py-2">
                                    <a href="/mail/preview/registrant-fee-paid" target="_blank" class="text-white bg-fuchsia-500 px-4 py-1 rounded-full">
                                        Preview
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="px-4 py-2">
                                    Registrant
                                </td>
                                <td class="px-4 py-2">
                                    Registration Expiring
                                </td>
                                <td class="px-4 py-2">
                                    Automatically sent out to registrants 28 days before their registration expires.
                                </td>
                                <td class="px-4 py-2">
                                    <a href="/mail/preview/registration-expiring" target="_blank" class="text-white bg-fuchsia-500 px-4 py-1 rounded-full">
                                        Preview
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td class="px-4 py-2">
                                    Registrant
                                </td>
                                <td class="px-4 py-2">
                                    Registration Expired
                                </td>
                                <td class="px-4 py-2">
                                    Automatically sent out to registrants when their registration expires.
                                </td>
                                <td class="px-4 py-2">
                                    <a href="/mail/preview/registration-expired" target="_blank" class="text-white bg-fuchsia-500 px-4 py-1 rounded-full">
                                        Preview
                                    </a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

{{--                @dump($dummyUser)--}}
{{--                @dump($dummyOrder)--}}
            </div>
        </div>
    </div>
</div>
