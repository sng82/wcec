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

            <div class="rounded-lg bg-slate-100 border border-slate-200 p-4 shadow-md shadow-slate-400">
                <h1 class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2 mb-6">
                    Registration Submission: <span class="text-fuchsia-500">{{ $applicant->first_name . ' ' . $applicant->last_name }}</span>
                </h1>

                <p class="mb-4">Registration Pathway: <span class="font-bold">{{ str($path)->title() }}</span>.</p>

                @if($path === 'standard')
                    <button wire:click.prevent="downloadFile"
                            class="text-white rounded-full bg-sky-700 px-4 py-1 hover:bg-sky-800 flex flex-row gap-2 items-center"
                    >
                        <span>
                            Download Submission Paper
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                             class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                        </svg>
                    </button>
                @endif
            </div>

            <div class="rounded-lg bg-slate-100 border border-slate-200 p-4 shadow-md shadow-slate-400"
                 x-data="{
                    submission_interview_at: $wire.submission_interview_at,
                    submission_status: $wire.submission_status
                }"
            >
                <h2 class="text-2xl pb-2 mt-2 border-b-2 border-slate-400">
                    Assessment
                </h2>

{{--                @dump($this)--}}

                <form wire:submit="save">

                    <div class="flex flex-col lg:flex-row lg:items-center py-2">
                        <x-admin-input-label for="submission_status" :value="__('Submission Status')" class="lg:w-60 shrink-0"/>
                        <select wire:model="submission_status" x-model="submission_status" name="submission_status" id="submission_status"
                                class="block w-52 border-gray-300 focus:border-indigo-500 focus:ring-sky-500 rounded-md shadow-sm"
                                required>
                            <option value="submitted" {{ $submission_status === 'submitted' ? 'selected' : '' }}>Submitted</option>
                            <option value="awaiting_interview" {{ $submission_status === 'awaiting_interview' ? 'selected' : '' }}>Awaiting Interview</option>
                            <option value="accepted" {{ $submission_status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="unaccepted" {{ $submission_status === 'unaccepted' ? 'selected' : '' }}>Unaccepted</option>
                            <option value="rejected" {{ $submission_status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <div x-show="submission_status == 'awaiting_interview'"
                         x-cloak
{{--                         x-transition:enter.duration.1500ms--}}
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="bg-cyan-300"
                    >
                        <div class="flex flex-col lg:flex-row lg:items-center py-2">
                            <x-admin-input-label for="submission_interview_at" :value="__('Interview Date & Time')" class="lg:w-60 shrink-0"/>
                            <div class="relative inline-block w-60 mr-2 align-middle">
                                <x-text-input wire:model="submission_interview_at" x-model="submission_interview_at" id="submission_interview_at"
                                              class="block w-full" type="datetime-local"
                                              name="submission_interview_at" autocomplete="off" />
                            </div>
                            <div class="hidden lg:inline-block lg:relative  w-2 mr-2 align-middle">
                                -
                            </div>
                            <span class="text-sm text-gray-700 italic">Can be set any time after Submission Status is set to 'Awaiting Interview'.</span>
                        </div>
                    </div>

                    <div x-show="submission_interview_at != '' && submission_interview_at != null && submission_status == 'awaiting_interview'"
                         x-cloak
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="bg-cyan-300"
{{--                         x-transition:enter.duration.500ms--}}
                    >
                        <div class="flex flex-col lg:flex-row lg:items-center py-2 gap-1">
                            <x-admin-input-label for="send_interview_email" :value="__('Send Email')" class="w-60" />
                            <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                <input wire:model="send_interview_email" type="checkbox" name="send_interview_email" id="send_interview_email"
                                       class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50 cursor-pointer"/>
                                <label for="send_interview_email" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-200 border border-gray-300 cursor-pointer"></label>
                            </div>
                            <span class="text-sm text-gray-700 italic">Send an email to the applicant advising date and time of interview.</span>
                        </div>
                    </div>


                    <div class="flex flex-col lg:flex-row lg:items-center py-2">
                        <x-admin-input-label for="feedback" :value="__('Feedback')" class="lg:w-60 shrink-0"/>
                        <textarea wire:model="feedback" name="feedback" rows="3" id="feedback"
                                  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 resize rounded-md block w-full"></textarea>
                    </div>

                    <div class="flex flex-col lg:flex-row lg:items-center py-2">
                        <x-admin-input-label for="notes" :value="__('Assessor Notes')" class="lg:w-60 shrink-0"/>
                        <textarea wire:model="notes" name="notes" rows="3" id="notes"
                                  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 resize rounded-md block w-full"></textarea>
                    </div>

                    <button class="mt-4 text-lg py-2 px-12 bg-fuchsia-500 hover:bg-fuchsia-600 focus:cursor-wait text-white rounded-full lg:ml-60">
                        Save
                    </button>

                </form>

                <div class="rounded-lg bg-gradient-to-r from-sky-500 to-teal-500 text-white p-4 mt-6 mb-2">
                    <h3 class="text-lg font-bold text-sky-200">Submission Statuses</h3>
                    <ul class="mt-0 ml-5 list-disc marker:text-white space-y-2 text-sm">
                        <li>
                            <span class="font-bold text-slate-600">
                                Submitted
                            </span>
                            <ul class="ml-8 list-square marker:text-slate-200">
                                <li>
                                    This is the default status, applied when the applicant submits their
                                    registration.
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span class="font-bold text-slate-600">
                                Awaiting Interview
                            </span>
                            <ul class="ml-8 list-square marker:text-slate-200">
                                <li>
                                    Select this status when you are happy with the submission and want to arrange an
                                    interview.
                                </li>
                                <li>
                                    If the 'Interview Date &amp; Time' files is completed, and the 'Send Email' switch is turned
                                    on, an email will be sent to the applicant advising them of the interview that has
                                    been scheduled.<br>
                                    The applicant is asked to reply<span class="text-slate-500">*</span> to the email
                                    either confirming or requesting a different time/date.<br>
                                    <span class="text-slate-500">*</span> Replies are sent to
                                    <span class="text-slate-500">
                                        {{ config('mail.membership_enquiry_mail_recipient') }}
                                    </span>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span class="font-bold text-slate-600">Accepted</span>
                            <ul class="ml-8 list-square marker:text-slate-200">
                                <li>
                                    Select this status when you are happy with the submission AND the applicant has been
                                    successfully interviewed.
                                </li>
                                <li>
                                    Applicants with this status will automatically become registrants on the next
                                    admission date.
                                </li>
                                <li>
                                    An email will automatically be sent to the applicant advising them of their
                                    successful application.
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span class="font-bold text-slate-600">Unaccepted</span>
                            <ul class="ml-8 list-square marker:text-slate-200">
                                <li>
                                    Select this status if the submitted registration is unacceptable but you want to
                                    allow the applicant to make amendments and resubmit.
                                </li>
                                <li>
                                    An email including the feedback you supply will automatically be sent to the
                                    applicant.
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span class="font-bold text-slate-600">Rejected</span>
                            <ul class="ml-8 list-square marker:text-slate-200">
                                <li>
                                    Select this status if the submitted registration is unacceptable and
                                    you <span class="font-bold text-red-600">DO NOT</span> want to allow the applicant
                                    to make amendments and resubmit.
                                </li>
                                <li>
                                    An email including the feedback you supply will automatically be sent to the
                                    applicant.
                                </li>
                                <li>
                                    This will terminate the applicants CPR application.
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <hr class="my-4">
                    <h3 class="text-lg font-bold text-sky-200">Feedback</h3>
                    <p class="mt-0 text-sm">Depending upon the submission status, the feedback you provide here may be made available to the applicant.</p>

                    <hr class="my-4">
                    <h3 class="text-lg font-bold text-sky-200">Assessor Notes</h3>
                    <p class="mt-0 text-sm">Optional. Only visible to CPR admins so can include private observations, such as why a submission was unacceptable. Assessor Notes will remain visible if/when a submission is resubmitted</p>
                </div>

            </div>
        </div>
    </div>
</div>
