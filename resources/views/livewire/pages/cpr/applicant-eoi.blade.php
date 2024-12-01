<div class="flex h-full w-full overflow-y-auto">

    <livewire:cpr.sidebar/>

    <div class="right w-full min-w-80 flex grow flex-col overflow-y-auto">

{{--        <livewire:layout.cpr-navigation/>--}}

        <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

        <form wire:submit="saveProgress" enctype="multipart/form-data" class="py-4 p-3 xl:p-6" x-data="{
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

            <div x-data="{show_help_1: false}">

                <div x-show="show_help_1" x-cloak @click.away="show_help_1 = false">
                    <div class="fixed top-1 right-4 ml-4 z-20 opacity-90 max-w-96 bg-amber-100 border border-amber-200 p-4 mt-4 rounded-lg text-sky-900 flex justify-center shadow-md">
                        <div class="absolute top-2 right-2">
                            <button type="button" @click="show_help_1 = !show_help_1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="mx-6">
                            <p class="text-sky-700 font-bold">Select Multiple Files...</p>
                            <hr class="border-sky-900 my-3">
                            <p class="text-lg text-sky-700 font-bold">
                                On Windows
                            </p>
                            <p>
                                by pressing and holding down the Control (Ctrl) key whilst you click on each file.
                            </p>
                            <hr class="border-sky-900 my-3">
                            <p class="text-lg text-sky-700 font-bold">
                                On Mac
                            </p>
                            <p>
                                by pressing and holding down the Command (⌘) key whilst you click on each file.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 mt-6 mb-6 border border-slate-300 shadow shadow-slate-400">
                    <h1 class="text-3xl text-sky-800 border-b-4 border-red-700 pb-2 mb-4">
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

                @if(!empty ($eoi->feedback))
                    <div class="bg-gradient-to-r from-purple-500 via-violet-400 to-indigo-500
                                rounded-lg shadow-lg shadow-slate-400
    {{--                            outline outline-3 outline-purple-400 outline-offset-4--}}
                                p-5 mt-6 text-white">

                        <div class="flex flex-row items-center mb-3 gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 min-w-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>
                            <h2 class="text-xl text-indigo-50">
                                Your Expression of Interest was not accepted
                            </h2>
                        </div>

                        <span class="w-full block border-b-2 border-purple-200 mb-3"></span>


                        <p class="mb-4 text-purple-100">
                            The assessor provided the following feedback:
                        </p>

                        {!! $eoi->feedback; !!}
                    </div>
                @endif

                <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-8 xl:pb-8 mt-6 border border-slate-300 shadow shadow-slate-400">
                    <h2 class="text-xl font-semibold text-white bg-sky-900 border-b border-sky-900 p-2 py-3 xl:py-2 pl-3 xl:pl-7 mb-3 -mx-3 -mt-3 xl:mt-0 xl:-ml-7 xl:-mr-0 shadow rounded-t-lg xl:rounded-lg">
                        Your Details
                    </h2>
                    <p class="mt-4">
                        Your admittance certificate will show your name as printed here.
                    </p>
                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="first_name" :value="__('First Name(s)')" class="lg:w-48"/>
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
                        <x-admin-input-label for="phone_main" :value="__('Phone (Main)')" class="w-48"/>
                        <x-text-input wire:model="phone_main" id="phone_main" class="block w-full lg:w-60" type="text"
                                      name="phone_main" required autocomplete="phone_main"/>
                    </div>
                    <x-cpr-input-error :messages="$errors->get('phone_main')" class="mt-2 lg:pl-1 lg:ml-48"/>

                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="phone_mobile" :value="__('Phone (Mobile)')" class="w-48"/>
                        <x-text-input wire:model="phone_mobile" id="phone_mobile" class="block w-full lg:w-60" type="text"
                                      name="phone_mobile" autocomplete="phone_mobile"/>
                        <span class="text-sm text-gray-700 italic"> - optional</span>
                    </div>
                    <x-cpr-input-error :messages="$errors->get('phone_mobile')" class="mt-2 lg:pl-1 lg:ml-48"/>
                </div>

                <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-8 xl:pb-8 mt-6 border border-slate-300 shadow shadow-slate-400">
                    <h2 class="text-xl font-semibold text-white bg-sky-900 border-b border-sky-900 p-2 py-3 xl:py-2 pl-3 xl:pl-7 mb-3 -mx-3 -mt-3 xl:mt-0 xl:-ml-7 xl:-mr-0 shadow rounded-t-lg xl:rounded-lg">
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
                    <p class="text-sm mt-2 pl-1 lg:ml-48 text-slate-400">Permitted file types: .pdf, .doc, .docx, .jpg, .jpeg, .png | Max file size: 5MB</p>
                </div>

                <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-8 xl:pb-8 mt-6 border border-slate-300 shadow shadow-slate-400">
                    <h2 class="text-xl font-semibold text-white bg-sky-900 border-b border-sky-900 p-2 py-3 xl:py-2 pl-3 xl:pl-7 mb-3 -mx-3 -mt-3 xl:mt-0 xl:-ml-7 xl:-mr-0 shadow rounded-t-lg xl:rounded-lg">
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
                    <p class="text-sm mt-2 pl-1 lg:ml-48 text-slate-400">Permitted file types: .pdf, .doc, .docx, .jpg, .jpeg, .png | Max file size: 5MB</p>

    {{--                @endif--}}

                    <label for="current_role" class="block mt-6">
                        If you do not have a formal document, please provide a summary of your current role instead. Max 200 words.:
                    </label>

                    <div wire:ignore class="mt-4">
                        <input id="current_role" type="hidden" value="{{ $this->current_role }}" wire:model="current_role">
                        <trix-editor input="current_role"
                                     class="trix-block bg-white border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                     style="min-height: 200px;" ></trix-editor>
                        <small>
                            Word Count: <span id="word_count_display"></span>
                        </small>

                        @script
                        <script>
                            let trixEditor = document.getElementById("current_role");
                            let wordCountDisplay = document.getElementById('word_count_display');

                            showCount();

                            document.addEventListener("trix-blur", function () {
                                @this.set('current_role', trixEditor.getAttribute('value'))
                            });

                            document.addEventListener("trix-change", function () {
                                showCount();
                            });

                            function showCount() {
                                let string = trixEditor.getAttribute('value');
                                wordCountDisplay.innerHTML = wordCount(string);
                            }

                            function wordCount(s) {
                                // console.log('pre: ' + s); // debug
                                s = s.replace(/(^\s*)|(\s*$)/gi,""); // Exclude start and end white-space
                                s = s.replace(/[ ]{2,}/gi," "); // Trim 2 or more space to 1

                                let treatAsSpace = [
                                    "<div>", "</div>",
                                    "<strong>", "</strong>",
                                    "<em>", "</em>",
                                    "<del>", "</del>",
                                    "<h1>", "</h1>",
                                    "<ul><li>",
                                    "<ol><li>",
                                    "<ul>", "</ul>",
                                    "<ol>", "</ol>",
                                    "<li>", "</li>",
                                    "&nbsp;",
                                    "<br>",
                                ]

                                for (let i = 0; i < treatAsSpace.length; i++) {
                                    s = s.replaceAll(treatAsSpace[i], ' ')
                                }

                                s = s.replaceAll(/[ ]{2,}/gi, " "); // Trim 2 or more space to 1

                                // console.log('post: ' + s); // debug
                                return s.split(' ').filter(
                                    function(str){
                                        return str != "";
                                    }
                                ).length;
                            }
                        </script>
                        @endscript
                    </div>

                    <x-cpr-input-error :messages="$errors->get('current_role')" class="mt-2"/>
                </div>

                <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-8 xl:pb-8 mt-6 border border-slate-300 shadow shadow-slate-400">
                    <h2 class="text-xl font-semibold text-white bg-sky-900 border-b border-sky-900 p-2 py-3 xl:py-2 pl-3 xl:pl-7 mb-3 -mx-3 -mt-3 xl:mt-0 xl:-ml-7 xl:-mr-0 shadow rounded-t-lg xl:rounded-lg">
                        Employment History
                    </h2>
                    <label for="employment_history" class="my-4">
                        An appraisal of your employment history covering the last 10 years or 5 positions held,
                        whichever is longer.
                        <br>Be specific about the roles you have undertaken, particularly with regard to knowledge,
                        practical skills, leadership, communication and professional commitment.
                    </label>

                    <div wire:ignore class="mt-4">
                        <input id="employment_history" type="hidden" value="{{ $this->employment_history }}" wire:model="employment_history">
                        <trix-editor input="employment_history"
                                     class="trix-block bg-white border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                     style="min-height: 200px;" ></trix-editor>

                        @script
                        <script>
                            let trixEditor = document.getElementById("employment_history")

                            addEventListener("trix-blur", function () {
                                @this.set('employment_history', trixEditor.getAttribute('value'))
                            })
                        </script>
                        @endscript
                    </div>

                    <x-cpr-input-error :messages="$errors->get('employment_history')" class="mt-2"/>
                </div>

                <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-8 xl:pb-8 mt-6 border border-slate-300 shadow shadow-slate-400">
                    <h2 class="text-xl font-semibold text-white bg-sky-900 border-b border-sky-900 p-2 py-3 xl:py-2 pl-3 xl:pl-7 mb-3 -mx-3 -mt-3 xl:mt-0 xl:-ml-7 xl:-mr-0 shadow rounded-t-lg xl:rounded-lg">
                        Education
                    </h2>
                    <label for="qualifications" class="mt-4">
                        Provide details of higher education qualifications, including non-cleaning subjects:
                    </label>

                    <div wire:ignore class="mt-4">
                        <input id="qualifications" type="hidden" value="{{ $this->qualifications }}" wire:model="qualifications">
                        <trix-editor input="qualifications"
                                     class="trix-block bg-white border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                     style="min-height: 200px;" ></trix-editor>

                        @script
                        <script>
                            let trixEditor = document.getElementById("qualifications")

                            addEventListener("trix-blur", function () {
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
                        <span class="text-sm text-gray-700 italic">
                            - You can select and add multiple files at once
                        </span>
                        <button @click="show_help_1 = !show_help_1" type="button" class="text-sky-600 hover:cursor-help hover:text-sky-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </button>
                    </div>

                    <p class="text-sm mt-2 pl-1 lg:ml-48 text-slate-400">Permitted file types: .pdf, .doc, .docx, .jpg, .jpeg, .png | Max file size (each): 5MB</p>

                    <x-cpr-input-error :messages="$errors->get('qualification_certificates')" class="mt-2 lg:pl-1 lg:ml-48"/>

    {{--                <x-files-renamed-notice/>--}}
                </div>

                <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-8 xl:pb-8 mt-6 border border-slate-300 shadow shadow-slate-400">
                    <h2 class="text-xl font-semibold text-white bg-sky-900 border-b border-sky-900 p-2 py-3 xl:py-2 pl-3 xl:pl-7 mb-3 -mx-3 -mt-3 xl:mt-0 xl:-ml-7 xl:-mr-0 shadow rounded-t-lg xl:rounded-lg">
                        Training
                    </h2>
                    <label for="training" class="mt-4">
                        Provide details of training courses you have undertaken in the last 5 years:
                    </label>

                    <div wire:ignore class="mt-4">
                        <input id="training" type="hidden" value="{{ $this->training }}" wire:model="training">
                        <trix-editor input="training"
                                     class="trix-block bg-white border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                     style="min-height: 200px;" ></trix-editor>

                        @script
                        <script>
                            let trixEditor = document.getElementById("training")

                            addEventListener("trix-blur", function () {
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

                        <span class="text-sm text-gray-700 italic">
                            - You can select and add multiple files at once
                        </span>
                        <button @click="show_help_1 = !show_help_1" type="button" class="text-sky-600 hover:cursor-help hover:text-sky-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                        </button>
                    </div>

                    <p class="text-sm mt-2 pl-1 lg:ml-48 text-slate-400">Permitted file types: .pdf, .doc, .docx, .jpg, .jpeg, .png | Max file size (each): 5MB</p>

                    <x-cpr-input-error :messages="$errors->get('training_certificates')" class="mt-2 lg:pl-1 lg:ml-48"/>

    {{--                <x-files-renamed-notice/>--}}
                </div>

            </div>

            <div class="bg-slate-800 text-white rounded-3xl xl:rounded-[50px] p-3 xl:py-4 px-4 lg:px-6 xl:px-12 mt-6 border border-slate-200 shadow">
                @if($errors->any())
                    <div class="rounded-lg bg-red-500 px-4 py-2 border border-red-700 mt-3 flex flex-row items-center gap-4 text-white text-lg">
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
                    @if (config('app.env') !== 'production')
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
                            uppercase w-48 shrink-0 font-bold text-lg flex flex-row items-center justify-center gap-2">
                        Save
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5"
                                  d="M11 16h2m6.707-9.293-2.414-2.414A1 1 0 0 0 16.586 4H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7.414a1 1 0 0 0-.293-.707ZM16 20v-6a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v6h8ZM9 4h6v3a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V4Z"/>
                        </svg>
                    </button>
                    <ul class="my-6 ml-5 lg:ml-12 list-square marker:text-sky-400 space-y-1 max-w-2xl xl:max-w-fit">
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
                            text-white rounded-full px-6 py-4 mt-8 lg:mt-0
                            uppercase w-48 shrink-0 font-bold text-lg flex flex-row items-center justify-center gap-2">
                        Submit
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" style="transform: rotate(90deg);" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="1.5" d="m12 18-7 3 7-18 7 18-7-3Zm0 0v-5"/>
                        </svg>
                    </button>
                    <ul class="my-6 ml-5 lg:ml-12 list-square marker:text-fuchsia-400 space-y-1 max-w-2xl xl:max-w-fit">
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
