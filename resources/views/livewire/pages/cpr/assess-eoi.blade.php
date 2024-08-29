<div class="flex h-full w-full overflow-hidden">
    <livewire:cpr.sidebar/>

    <div class="right w-full flex flex-col grow min-w-80 overflow-y-auto">

{{--        <livewire:layout.cpr-navigation />--}}

        <div class="flex flex-col p-3 xl:p-6 gap-5">

            <div class="rounded-lg bg-slate-100 border border-slate-200 p-4 shadow-md shadow-slate-400">
                <h1 class="text-2xl text-sky-800 border-b-4 border-red-700 pb-2 mb-6">
                    Expression of Interest: <span class="text-fuchsia-500">{{ $applicant->first_name . ' ' . $applicant->last_name }}</span>
                </h1>

                <p class="mb-1 font-bold text-slate-500">
                    Current Role
                </p>
                <div class="trix-block border border-slate-200 px-3 py-6 bg-white text-slate-700 rounded shadow-inner shadow-slate-400 mb-6">
                    {!! empty($eoi->current_role) ? 'N/A' : $eoi->current_role !!}
                </div>

                <p class="mb-1 font-bold text-slate-500">
                    Employment History
                </p>
                <div class="trix-block border border-slate-200 px-3 py-6 bg-white text-slate-700 rounded shadow-inner shadow-slate-400 mb-6">
                    {!! empty($eoi->employment_history) ? 'N/A' : $eoi->employment_history !!}
{{--                    {{ empty($eoi->employment_history) ? 'N/A' : $eoi->employment_history }}--}}
                </div>

                <p class="mb-1 font-bold text-slate-500">
                    Qualifications
                </p>
                <div class="trix-block border border-slate-200 px-3 py-6 bg-white text-slate-700 rounded shadow-inner shadow-slate-400 mb-6">
                    {!! empty($eoi->qualifications) ? 'N/A' : $eoi->qualifications !!}
                </div>

                <p class="mb-1 font-bold text-slate-500">
                    Training
                </p>
                <div class="trix-block border border-slate-200 px-3 py-6 bg-white text-slate-700 rounded shadow-inner shadow-slate-400 mb-6">
                    {!! empty($eoi->training) ? 'N/A' : $eoi->training !!}
                </div>

                <div class="flex gap-4 items-center">
                    <span>
                        Download as PDF:
                    </span>
                    <button wire:click="buildPDF" class="rounded-full text-white bg-fuchsia-500 hover:bg-fuchsia-600 px-4 py-1 flex items-center gap-2">
                        <span>
                            Download
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                             class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="rounded-lg bg-slate-100 border border-slate-200 p-4 shadow-md shadow-slate-400">
                <h2 class="text-2xl pb-2 mt-2 border-b-2 border-slate-400">
                    Accompanying Documentation
                </h2>

                @if($documents->count() > 0)
                    <p class="my-2">
                        The following documents were supplied by the applicant to accompany their
                        Expression of Interest:
                    </p>
                    <div class="mb-2 overflow-hidden border border-sky-100 rounded-lg text-slate-700 shadow-md shadow-slate-300 overflow-x-auto">
                        <table class="table-auto w-full divide-y divide-sky-100 text-sm">
                            <thead class="bg-sky-200">
                                <tr class="text-sky-700 divide-x divide-sky-200">
                                    <th scope="col" class="px-4 py-2 text-left">
                                        Document Type
                                    </th>
                                    <th scope="col" class="px-4 py-2 text-left">
                                        Filename
                                    </th>
                                    <th scope="col" class="px-4 py-2 text-left">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-sky-100">
                                @foreach($documents as $document)
                                    <tr wire:key="{{ $document->id }}">
                                        <td class="px-4 py-2">
                                            {{ $document->doc_type === 'cv' ? 'CV' : str($document->doc_type)->replace('_', ' ')->title() }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $document->file_name }}
                                        </td>
                                        <td class="px-4 py-1">
                                            <button wire:click.prevent="downloadFile({{$document->id}})"
                                                    class="text-white rounded-full bg-sky-700 px-4 py-1 hover:bg-sky-800 flex flex-row gap-2 items-center">
                                                <span>
                                                    Download
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                     class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                @if($documents->count() > 1)
                                    <tr>
                                        <td class="px-4 py-2 bg-slate-100"></td>
                                        <td class="px-4 py-2 bg-slate-100"></td>
                                        <td class="px-4 py-1">
                                            <button wire:click.prevent="downloadFiles"
                                                    class="text-white rounded-full bg-fuchsia-500 px-4 py-1 hover:bg-fuchsia-600 flex flex-row gap-2 items-center">
                                                <span>
                                                    Download All
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                     class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                @else
                    No documents found.
                @endif
            </div>


            <div class="rounded-lg bg-slate-100 border border-slate-200 p-4 shadow-md shadow-slate-400">
                <h2 class="text-2xl pb-2 mt-2 border-b-2 border-slate-400">
                    Assessment
                </h2>

                <form wire:submit="assess">

                    <div class="flex flex-col lg:flex-row lg:items-center mt-3">
                        <x-admin-input-label for="eoi_status" :value="__('EoI Status')" class="lg:w-48 shrink-0"/>
                        <select wire:model="eoi_status" name="eoi_status" id="eoi_status"
                                class="block w-48 border-gray-300 focus:border-indigo-500 focus:ring-sky-500 rounded-md shadow-sm"
                                required>
                            <option value="submitted" {{ $eoi_status === 'submitted' ? 'selected' : '' }}>
                                Submitted
                            </option>
                            <option value="accepted" {{ $eoi_status === 'accepted' ? 'selected' : '' }}>
                                Accepted
                            </option>
                            <option value="unaccepted" {{ $eoi_status === 'unaccepted' ? 'selected' : '' }}>
                                Unaccepted
                            </option>
                            <option value="rejected" {{ $eoi_status === 'rejected' ? 'selected' : '' }}>
                                Rejected
                            </option>
                        </select>
                    </div>

                    <div class="flex flex-col lg:flex-row lg:items-center mt-3">
                        <x-admin-input-label for="feedback" :value="__('Feedback')" class="lg:w-48 shrink-0"/>
                        <textarea wire:model="feedback" name="feedback" rows="3" id="feedback"
                                  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 resize rounded-md block w-full"></textarea>
                    </div>

                    <div class="flex flex-col lg:flex-row lg:items-center mt-3">
                        <x-admin-input-label for="notes" :value="__('Assessor Notes')" class="lg:w-48 shrink-0"/>
                        <textarea wire:model="notes" name="notes" rows="3" id="notes"
                                  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 resize rounded-md block w-full"></textarea>
                    </div>

                    <button class="mt-4 text-lg py-2 px-12 bg-fuchsia-500 hover:bg-fuchsia-600 focus:cursor-wait text-white rounded-full lg:ml-48">
                        Save
                    </button>

                </form>

                <div class="rounded-lg bg-gradient-to-r from-sky-500 to-teal-500 text-white p-4 mt-6 mb-2">
                    <h3 class="text-lg font-bold text-sky-200">
                        EoI Statuses
                    </h3>
                    <ul class="mt-0 ml-5 list-disc marker:text-white space-y-2 text-sm">
                        <li>
                            <span class="font-bold text-slate-600">
                                Submitted
                            </span>
                            <ul class="ml-8 list-square marker:text-slate-200">
                                <li>
                                    This is the default status, applied when the applicant submits
                                    their Expression of Interest (EoI).
                                </li>
                                <li>
                                    Only EoI's with this status can be assessed.
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span class="font-bold text-slate-600">
                                Accepted
                            </span>
                            <ul class="ml-8 list-square marker:text-slate-200">
                                <li>
                                    Select this status to allow the applicant to continue with their
                                    application to join the Chartered Practitioners Register.
                                </li>
                                <li>
                                    An email will automatically be sent to the applicant advising
                                    them that they can continue their application.
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span class="font-bold text-slate-600">
                                Unaccepted
                            </span>
                            <ul class="ml-8 list-square marker:text-slate-200">
                                <li>
                                    Select this status if the submitted EoI is unacceptable but
                                    you want to allow the applicant to make amendments and resubmit.
                                </li>
                                <li>
                                    An email including the feedback you supply will automatically
                                    be sent to the applicant.
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span class="font-bold text-slate-600">
                                Rejected
                            </span>
                            <ul class="ml-8 list-square marker:text-slate-200">
                                <li>
                                    Select this status if the submitted EoI is unacceptable and
                                    you <span class="font-bold text-red-600">DO NOT</span> want to
                                    allow the applicant to make amendments and resubmit.
                                </li>
                                <li>
                                    An email including the feedback you supply will automatically
                                    be sent to the applicant.
                                </li>
                                <li>
                                    This will terminate the applicants CPR application.
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <hr class="my-4">
                    <h3 class="text-lg font-bold text-sky-200">
                        Feedback
                    </h3>
                    <p class="mt-0 text-sm">
                        When the EoI Status is set to <span class="font-bold text-slate-600">Unaccepted</span>
                        or <span class="font-bold text-slate-600">Rejected</span>, the feedback you provide
                        here will be made available to the applicant.
                    </p>
                    <hr class="my-4">
                    <h3 class="text-lg font-bold text-sky-200">
                        Assessor Notes
                    </h3>
                    <p class="mt-0 text-sm">
                        Optional. Only visible to CPR admins so can include private observations, such as why
                        an EoI was unacceptable. Assessor Notes will remain visible on this page if/when an
                        EoI is resubmitted
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
