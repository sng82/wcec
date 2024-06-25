<div class="flex h-full w-full overflow-hidden">
    <livewire:cpr.sidebar/>

    <div class="right w-full flex flex-col grow min-w-80 overflow-y-auto">

        <livewire:layout.cpr-navigation />

        <div class="flex flex-col p-3 xl:p-6 gap-5">

            <div class="rounded-lg bg-slate-50 border border-slate-50 p-4 shadow">
                <h1 class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2 mb-6">
                    Expression of Interest Assessment for {{ $applicant->first_name . ' ' . $applicant->last_name }}
                </h1>

                <p>Current Role:</p>
                <div class=" border-b border-slate-400 py-3 px-1 bg-slate-100 mb-4">
                    <p class="text-slate-500">{{ empty($eoi->current_role) ? 'N/A' : $eoi->current_role }}</p>
                </div>

                <p>Employment History:</p>
                <div class=" border-b border-slate-400 py-3 px-1 bg-slate-100 mb-4">
                    <p class="text-slate-500">{{ empty($eoi->employment_history) ? 'N/A' : $eoi->employment_history }}</p>
                </div>

                <p>Qualifications:</p>
                <div class=" border-b border-slate-400 py-3 px-1 bg-slate-100 mb-4">
                    <p class="text-slate-500">{{ empty($eoi->qualifications) ? 'N/A' : $eoi->qualifications }}</p>
                </div>

                <p>Training:</p>
                <div class=" border-b border-slate-400 py-3 px-1 bg-slate-100 mb-4">
                    <p class="text-slate-500">{{ empty($eoi->training) ? 'N/A' : $eoi->training }}</p>
                </div>

                <h2 class="text-xl pb-2 mt-6">Accompanying Documents:</h2>
                <div class="mb-2 overflow-hidden border border-sky-100 rounded-lg shadow-sm overflow-x-auto">
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
                                        <button wire:click.prevent="downloadFile"
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
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
