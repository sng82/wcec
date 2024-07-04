<div class="flex h-full w-full overflow-y-auto">

    <livewire:cpr.sidebar/>

    <div class="right w-full min-w-96 flex grow flex-col overflow-y-auto">

        <livewire:layout.cpr-navigation/>

        <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

        <form wire:submit="saveProgress" class="py-4 px-6" x-data="{
            init() {
                Livewire.hook('commit', ({ succeed }) => {
                    succeed(() => {
                        this.$nextTick(() => {
                            const firstErrorMessage = document.querySelector('.error')

                            if (firstErrorMessage !== null) {
                                firstErrorMessage.scrollIntoView({ block: 'center', inline: 'center' })
                            }
                        })
                    })
                })
            }
        }">

            <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 mt-6 mb-6 border border-slate-300 shadow shadow-slate-400">
                <h1 class="text-3xl text-sky-800 border-b-4 border-red-600 pb-2 mb-4">
                    Expression of Interest
                </h1>
                <p class="mb-2">
                    The following is our expression of Interest form. It can be completed in multiple sessions,
                    just don't forget to press the save button (bottom of the page) before leaving!
                </p>
                <p class="mb-4">
                    When you are happy with the information you have provided, you should press the submit
                    button (bottom of the page). You will no longer be able to make edits after this point.
                </p>
            </div>

            <x-files-renamed-notice/>

            <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-8 xl:pb-8 mt-6 border border-slate-300 shadow shadow-slate-400">
                <h2 class="text-xl text-white bg-sky-900 border-b border-sky-900 p-2 pl-7 mb-3 -ml-7 shadow rounded-lg font-semibold">
                    Your Details
                </h2>
                <p class="mt-4">
                    Your admittance certificate will show your name as printed here.
                </p>
                <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                    <x-admin-input-label for="first_name" :value="__('First Name')" class="lg:w-48"/>
                    <x-text-input wire:model="first_name" id="first_name" class="block w-full lg:w-96" type="text"
                                  name="first_name" required autofocus autocomplete="first_name"/>
                </div>
                <x-cpr-input-error :messages="$errors->get('first_name')" class="mt-2 lg:pl-1 lg:ml-48"/>

                <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                    <x-admin-input-label for="last_name" :value="__('Last Name')" class="w-48"/>
                    <x-text-input wire:model="last_name" id="last_name" class="block w-full lg:w-96" type="text"
                                  name="last_name" required autocomplete="last_name"/>
                </div>
                <x-cpr-input-error :messages="$errors->get('last_name')" class="mt-2 lg:pl-1 lg:ml-48"/>

                <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                    <x-admin-input-label for="email" :value="__('Business Email')" class="w-48"/>
                    <x-text-input wire:model="email" id="email" class="block w-full lg:w-[500px]" type="email"
                                  name="email" required autocomplete="email"/>
                </div>
                <x-cpr-input-error :messages="$errors->get('email')" class="mt-2 lg:pl-1 lg:ml-48"/>

                <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                    <x-admin-input-label for="phone_1" :value="__('Business Phone')" class="w-48"/>
                    <x-text-input wire:model="phone_1" id="phone_1" class="block w-full lg:w-60" type="text"
                                  name="phone_1" required autocomplete="phone_1"/>
                </div>
                <x-cpr-input-error :messages="$errors->get('phone_1')" class="mt-2 lg:pl-1 lg:ml-48"/>

                <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                    <x-admin-input-label for="phone_2" :value="__('Business Phone 2')" class="w-48"/>
                    <x-text-input wire:model="phone_2" id="phone_2" class="block w-full lg:w-60" type="text"
                                  name="phone_2" autocomplete="phone_2"/>
                    <span class="text-sm text-gray-700 italic"> - optional</span>
                </div>
                <x-cpr-input-error :messages="$errors->get('phone_2')" class="mt-2 lg:pl-1 lg:ml-48"/>

                <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                    <x-admin-input-label for="phone_3" :value="__('Business Phone 3')" class="w-48"/>
                    <x-text-input wire:model="phone_3" id="phone_3" class="block w-full lg:w-60" type="text"
                                  name="phone_3" autocomplete="phone_3"/>
                    <span class="text-sm text-gray-700 italic"> - optional</span>
                </div>
                <x-cpr-input-error :messages="$errors->get('phone_3')" class="mt-2 lg:pl-1 lg:ml-48"/>
            </div>

            <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-8 xl:pb-8 mt-6 border border-slate-300 shadow shadow-slate-400">
                <h2 class="text-xl text-white bg-sky-900 border-b border-sky-900 p-2 pl-7 mb-3 -ml-7 shadow rounded-lg font-semibold">
                    Curriculum Vitae
                </h2>
                @if($existing_cv)
                    <div class="mt-3 mb-2 overflow-hidden border border-slate-200 rounded-lg shadow-sm overflow-x-auto">
                        <table class="table-auto w-full divide-y divide-slate-100 text-left">
                            <thead class="bg-slate-100">
                                <tr class="text-slate-700 divide-x divide-slate-200">
                                    <th scope="col" class="px-4 py-2">File</th>
                                    <th scope="col" class="px-4 py-2 xl:w-[600px]">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                <tr class="text-slate-500">
                                    <td class="px-4 py-2">{{ $existing_cv->file_name }}</td>
                                    <td class="px-4 py-2">
                                        <div class="flex flex-row gap-2">
                                            <div class="w-40">
                                                <button wire:click.prevent="downloadFile({{ $existing_cv->id }})"
                                                        class="text-white rounded-full bg-sky-600 px-4 py-1 hover:bg-sky-700 flex flex-row gap-2 items-center">
                                                    <span>
                                                        Download
                                                    </span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                         stroke-width="2" stroke="currentColor" class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="w-40">
                                                <button wire:click.prevent="deleteFile({{ $existing_cv->id }})"
                                                        class="text-white rounded-full bg-red-600 px-4 py-1 hover:bg-red-700 ml-2 flex flex-row gap-2 items-center">
                                                    <span>
                                                        Delete
                                                    </span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                         stroke-width="2" stroke="currentColor" class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
{{--                    <x-files-renamed-notice/>--}}
                @else
                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="cv" :value="__('Current CV')" class="w-48"/>
                        <input type="file" wire:model="cv" id="cv"
                               class="block w-full lg:w-96 cursor-pointer rounded-lg border border-solid border-secondary-500 bg-white bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-sky-600 hover:file:bg-sky-700 file:px-3  file:py-[0.32rem] file:text-surface file:text-white focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                               name="cv"/>
                    </div>
                    <x-cpr-input-error :messages="$errors->get('cv')" class="mt-2 lg:pl-1 lg:ml-48"/>
{{--                    <x-files-renamed-notice/>--}}
                @endif
                <p class="text-sm mt-2 pl-1 lg:ml-48 text-slate-400">Permitted file types: .doc, .docx, .pdf</p>
            </div>

            <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-8 xl:pb-8 mt-6 border border-slate-300 shadow shadow-slate-400">
                <h2 class="text-xl text-white bg-sky-900 border-b border-sky-900 p-2 pl-7 mb-3 -ml-7 shadow rounded-lg font-semibold">
                    Current Employment &amp; Position
                </h2>

                <p>Please provide a description of your current role:</p>

                @if($existing_job_description)
                    <div class="mt-3 mb-2 overflow-hidden border border-slate-200 rounded-lg shadow-sm overflow-x-auto">
                        <table class="table-auto w-full divide-y divide-slate-100 text-left">
                            <thead class="bg-slate-100">
                                <tr class="text-slate-700 divide-x divide-slate-200">
                                    <th scope="col" class="px-4 py-2">File</th>
                                    <th scope="col" class="px-4 py-2 xl:w-[600px]">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                <tr class="text-slate-500">
                                    <td class="px-4 py-2">{{ $existing_job_description->file_name }}</td>
                                    <td class="px-4 py-2">
                                        <div class="flex flex-row gap-2">
                                            <div class="w-40">
                                                <button
                                                    wire:click.prevent="downloadFile({{ $existing_job_description->id }})"
                                                    class="text-white rounded-full bg-sky-600 px-4 py-1 hover:bg-sky-700 flex flex-row gap-2 items-center">
                                                        <span>
                                                            Download
                                                        </span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                         stroke-width="2" stroke="currentColor" class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="w-40">
                                                <button wire:click.prevent="deleteFile({{ $existing_job_description->id }})"
                                                        class="text-white rounded-full bg-red-600 px-4 py-1 hover:bg-red-700 ml-2 flex flex-row gap-2 items-center">
                                                        <span>
                                                            Delete
                                                        </span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                         stroke-width="2" stroke="currentColor" class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

{{--                @else--}}
                @endif
                <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                    <x-admin-input-label for="job_description" :value="__('Job Description')" class="w-48"/>
                    <input type="file" wire:model="job_description" id="job_description"
                           class="block w-full lg:w-96 cursor-pointer rounded-lg border border-solid border-secondary-500 bg-white bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-sky-600 hover:file:bg-sky-700 file:px-3  file:py-[0.32rem] file:text-surface file:text-white focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                           name="job_description"/>
                </div>
                <x-cpr-input-error :messages="$errors->get('job_description')" class="mt-2 lg:pl-1 lg:ml-48"/>
                <p class="text-sm mt-2 pl-1 lg:ml-48 text-slate-400">Permitted file types: .doc, .docx, .pdf</p>

{{--                @endif--}}

                <label for="current_role" class="block mt-6">
                    If you do not have a formal document, please provide a description of your current role instead:
                </label>

                <div wire:ignore class="mt-4">
                    <input id="current_role" type="hidden" value="{{ $this->current_role }}" wire:model="current_role">
                    <trix-editor input="current_role" class="trix-block" style="min-height: 200px;" ></trix-editor>

                    @script
                    <script>
                        let trixEditor = document.getElementById("current_role")

                        addEventListener("trix-blur", function (event) {
                            @this.set('current_role', trixEditor.getAttribute('value'))
                        })
                    </script>
                    @endscript
                </div>

                <x-cpr-input-error :messages="$errors->get('current_role')" class="mt-2"/>
            </div>

            <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-8 xl:pb-8 mt-6 border border-slate-300 shadow shadow-slate-400">
                <h2 class="text-xl text-white bg-sky-900 border-b border-sky-900 p-2 pl-7 mb-3 -ml-7 shadow rounded-lg font-semibold">
                    Employment History
                </h2>
                <label for="employment_history" class="my-4">
                    An appraisal of your employment history, particularly with regard to knowledge,
                    practical skills, leadership, communication and professional commitment.
                    Be specific about the roles you have undertaken during your employment history,
                    particularly with regard to knowledge, practical skills, leadership, communication
                    and professional commitment.
                </label>

                <div wire:ignore class="mt-4">
                    <input id="employment_history" type="hidden" value="{{ $this->employment_history }}" wire:model="employment_history">
                    <trix-editor input="employment_history" class="trix-block" style="min-height: 200px;" ></trix-editor>

                    @script
                    <script>
                        let trixEditor = document.getElementById("employment_history")

                        addEventListener("trix-blur", function (event) {
                            @this.set('employment_history', trixEditor.getAttribute('value'))
                        })
                    </script>
                    @endscript
                </div>

                <x-cpr-input-error :messages="$errors->get('employment_history')" class="mt-2"/>
            </div>

            <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-8 xl:pb-8 mt-6 border border-slate-300 shadow shadow-slate-400">
                <h2 class="text-xl text-white bg-sky-900 border-b border-sky-900 p-2 pl-7 mb-3 -ml-7 shadow rounded-lg font-semibold">
                    Education
                </h2>
                <label for="qualifications" class="mt-4">
                    Provide details of all higher education qualifications, including non-cleaning subjects:
                </label>

                <div wire:ignore class="mt-4">
                    <input id="qualifications" type="hidden" value="{{ $this->qualifications }}" wire:model="qualifications">
                    <trix-editor input="qualifications" class="trix-block" style="min-height: 200px;" ></trix-editor>

                    @script
                    <script>
                        let trixEditor = document.getElementById("qualifications")

                        addEventListener("trix-blur", function (event) {
                            @this.set('qualifications', trixEditor.getAttribute('value'))
                        })
                    </script>
                    @endscript
                </div>

                <x-cpr-input-error :messages="$errors->get('qualifications')" class="mt-2"/>

                <p class="my-4">
                    You must supply copy certificates for these and bring the originals along to the
                    interview:
                </p>

                @if($existing_qualification_certificates?->count() > 0)
                    <div class="mt-3 mb-2 overflow-hidden border border-slate-200 rounded-lg shadow-sm overflow-x-auto">
                        <table class="table-auto w-full divide-y divide-slate-100 text-left">
                            <thead class="bg-slate-100">
                                <tr class="text-slate-700 divide-x divide-slate-200">
                                    <th scope="col" class="px-4 py-2">File</th>
                                    <th scope="col" class="px-4 py-2 xl:w-[600px]">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                @foreach($existing_qualification_certificates as $document)
                                    <tr wire:key="{{ $document->id }}" class="text-slate-500">
                                        <td class="px-4 py-1">{{ $document->file_name }}</td>
                                        <td class="px-4 py-1">
                                            <div class="flex flex-row gap-2">
                                                <div class="w-40">
                                                    <button wire:click.prevent="downloadFile({{ $document->id }})"
                                                            class="text-white rounded-full bg-sky-600 px-4 py-1 hover:bg-sky-700 flex flex-row gap-2 items-center">
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
                                                <div class="w-40">
                                                    <button wire:click.prevent="deleteFile({{ $document->id }})"
                                                            class="text-white rounded-full bg-red-600 px-4 py-1 hover:bg-red-700 ml-2 flex flex-row gap-2 items-center">
                                                            <span>
                                                                Delete
                                                            </span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                             class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                                @if($existing_qualification_certificates?->count() > 1)
                                    <tr class="bg-slate-200">
                                        <td class="px-4 py-1"></td>
                                        <td class="px-4 py-1">
                                            <div class="flex flex-row gap-2">
                                                <div class="w-40">
                                                    <button wire:click.prevent="downloadFiles('qualification_certificate')"
                                                            class="text-white rounded-full bg-sky-700 px-4 py-1 hover:bg-sky-800 flex flex-row gap-2 items-center">
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
                                                </div>
                                                <div class="w-40">
                                                    <button wire:click.prevent="deleteFiles('qualification_certificate')"
                                                            wire:confirm="Delete all saved qualification certificates?"
                                                            class="text-white rounded-full bg-red-700 px-4 py-1 hover:bg-red-800 ml-2 flex flex-row gap-2 items-center">
                                                        <span>
                                                            Delete All
                                                        </span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                             class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="flex flex-col lg:flex-row lg:items-center mt-4 gap-1">
                    <x-admin-input-label for="qualification_certificates" :value="__('Education Certificates')"
                                         class="w-48"/>
                    <input type="file" wire:model="qualification_certificates" id="qualification_certificates"
                           class="block w-full lg:w-96 cursor-pointer rounded-lg border border-solid border-secondary-500 bg-white bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-sky-600 hover:file:bg-sky-700 file:px-3  file:py-[0.32rem] file:text-surface file:text-white focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                           name="qualification_certificates" multiple/>
                    <span class="text-sm text-gray-700 italic"> - You can add multiple files at once, or add them one at a time.</span>
                </div>
                <p class="text-sm mt-2 pl-1 lg:ml-48 text-slate-400">Permitted file types: .doc, .docx, .pdf</p>

                <x-cpr-input-error :messages="$errors->get('qualification_certificates')" class="mt-2 mt-2 lg:pl-1 lg:ml-48"/>

{{--                <x-files-renamed-notice/>--}}
            </div>

            <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-8 xl:pb-8 mt-6 border border-slate-300 shadow shadow-slate-400">
                <h2 class="text-xl text-white bg-sky-900 border-b border-sky-900 p-2 pl-7 mb-3 -ml-7 shadow rounded-lg font-semibold">
                    Training
                </h2>
                <label for="training" class="mt-4">
                    Provide details of training courses you have undertaken in the last 5 years:
                </label>

                <div wire:ignore class="mt-4">
                    <input id="training" type="hidden" value="{{ $this->training }}" wire:model="training">
                    <trix-editor input="training" class="trix-block" style="min-height: 200px;" ></trix-editor>

                    @script
                    <script>
                        let trixEditor = document.getElementById("training")

                        addEventListener("trix-blur", function (event) {
                            @this.set('training', trixEditor.getAttribute('value'))
                        })
                    </script>
                    @endscript
                </div>

                <x-cpr-input-error :messages="$errors->get('training')" class="mt-2"/>

                <p class="my-4">
                    Provide attendance certificates if possible:
                </p>

                @if($existing_training_certificates?->count() > 0)
                    <div class="mt-3 mb-2 overflow-hidden border border-slate-200 rounded-lg shadow-sm overflow-x-auto">
                        <table class="table-auto w-full divide-y divide-slate-100 text-left">
                            <thead class="bg-slate-100">
                                <tr class="text-slate-700 divide-x divide-slate-200">
                                    <th scope="col" class="px-4 py-2">File</th>
                                    <th scope="col" class="px-4 py-2 xl:w-[600px]">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                @foreach($existing_training_certificates as $document)
                                    <tr wire:key="{{ $document->id }}" class="text-slate-500">
                                        <td class="px-4 py-1">{{ $document->file_name }}</td>
                                        <td class="px-4 py-1">
                                            <div class="flex flex-row gap-2">
                                                <div class="w-40">
                                                    <button wire:click.prevent="downloadFile({{ $document->id }})"
                                                            class="text-white rounded-full bg-sky-600 px-4 py-1 hover:bg-sky-700 flex flex-row gap-2 items-center">
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
                                                <div class="w-40">
                                                    <button wire:click.prevent="deleteFile({{ $document->id }})"
                                                            class="text-white rounded-full bg-red-600 px-4 py-1 hover:bg-red-700 ml-2 flex flex-row gap-2 items-center">
                                                        <span>
                                                            Delete
                                                        </span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                             class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                                @if($existing_training_certificates?->count() > 1)
                                    <tr class="bg-slate-200">
                                        <td class="px-4 py-2"></td>
                                        <td class="px-4 py-2">
                                            <div class="flex flex-row gap-2">
                                                <div class="w-40">
                                                    <button wire:click.prevent="downloadFiles('training_certificate')"
                                                            class="text-white rounded-full bg-sky-700 px-4 py-1 hover:bg-sky-800 flex flex-row gap-2 items-center">
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
                                                </div>
                                                <div class="w-40">
                                                    <button wire:click.prevent="deleteFiles('training_certificate')"
                                                            wire:confirm="Delete all saved training certificates?"
                                                            class="text-white rounded-full bg-red-700 px-4 py-1 hover:bg-red-800 ml-2 flex flex-row gap-2 items-center">
                                                        <span>
                                                            Delete All
                                                        </span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                             class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                    <x-admin-input-label for="training_certificates" :value="__('Training Certificates')" class="w-48"/>

                    <input type="file" wire:model="training_certificates" id="training_certificates"
                           class="block w-full lg:w-96 cursor-pointer rounded-lg border border-solid border-secondary-500 bg-white bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-sky-600 hover:file:bg-sky-700 file:px-3 file:py-[0.32rem] file:text-surface file:text-white focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                           name="training_certificates" multiple/>

                    <span class="text-sm text-gray-700 italic"> - You can add multiple files at once, or add them one at a time.</span>
                </div>
                <p class="text-sm mt-2 pl-1 lg:ml-48 text-slate-400">Permitted file types: .doc, .docx, .pdf</p>

                <x-cpr-input-error :messages="$errors->get('training_certificates')" class="mt-2 lg:pl-1 lg:ml-48"/>

{{--                <x-files-renamed-notice/>--}}
            </div>

            <div class="bg-slate-800 text-white rounded-3xl xl:rounded-[50px] p-3 xl:py-4 lg:px-6 xl:px-12 mt-6 border border-slate-200 shadow">
                @if($errors->any())
                    <div class="rounded-lg bg-red-500 px-4 py-2 border border-red-600 mt-3 flex flex-row items-center gap-4 text-white text-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-8 min-w-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                        </svg>
                        <span class="font-semibold">Changes not saved: </span>
                        <span>
                            Please fix the errors highlighted above.
                        </span>

                    </div>
                    @if (config('app.env') !== 'Production')
                        @dump($errors)
                    @endif
                @endif

                <div class="flex flex-col lg:flex-row items-center mt-3 gap-1">
                    <button type="button"
                            wire:click="saveProgress()"
                            class="
                            bg-gradient-to-r from-cyan-500 to-blue-500
{{--                            hover:from-cyan-400 hover:to-blue-600--}}
                            hover:from-blue-500 hover:to-cyan-500
                            text-white rounded-full px-6 py-4 mt-8 lg:mt-0
                            uppercase w-48 font-bold text-lg flex flex-row items-center justify-center gap-2">
                        Save
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5"
                                  d="M11 16h2m6.707-9.293-2.414-2.414A1 1 0 0 0 16.586 4H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7.414a1 1 0 0 0-.293-.707ZM16 20v-6a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v6h8ZM9 4h6v3a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V4Z"/>
                        </svg>
                    </button>
                    <ul class="my-6 ml-12 list-square marker:text-sky-400 space-y-1 max-w-2xl xl:max-w-fit">
                        <li>All changes you have made above will be saved.</li>
                        <li>Your Expression of Interest <span class="font-semibold text-sky-400">WILL NOT</span> be
                            submitted for assessment.
                        </li>
                        <li>You can return to this page and edit/save your Expression of Interest as many times as you
                            like before submitting.
                        </li>
                    </ul>
                </div>
                <hr class="my-4">

                <div class="flex flex-col lg:flex-row items-center mt-3 mb-3 gap-1">
                    <button type="button"
                            wire:click="submitEoI"
                            wire:confirm="You cannot edit your Expression of Interest once submitted.\n\n Please confirm you are ready to proceed with your submission:"
                            class="
                            bg-gradient-to-r from-fuchsia-500 to-purple-500
                            hover:from-purple-500 hover:to-fuchsia-500
{{--                            hover:from-fuchsia-400 hover:to-purple-600--}}
                            text-white rounded-full px-6 py-4 mt-8 lg:mt-0
                            uppercase w-48 font-bold text-lg flex flex-row items-center justify-center gap-2">
                        Submit
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" style="transform: rotate(90deg);" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="1.5" d="m12 18-7 3 7-18 7 18-7-3Zm0 0v-5"/>
                        </svg>
                    </button>
                    <ul class="my-6 ml-12 list-square marker:text-fuchsia-400 space-y-1 max-w-2xl xl:max-w-fit">
                        <li>All changes you have made above will be saved.</li>
                        <li>Your Expression of Interest <span class="font-semibold text-red-400">WILL</span> be
                            submitted for assessment.
                        </li>
                        <li class="text-red-400">You will no longer be able to return to this page and/or edit your
                            Expression of Interest.
                        </li>
                    </ul>
                </div>
            </div>
        </form>

    </div>
</div>
