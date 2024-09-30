<div class="flex h-full w-full overflow-y-auto">

    <livewire:cpr.sidebar/>

    <div class="right w-full min-w-80 flex grow flex-col overflow-y-auto">

{{--        <livewire:layout.cpr-navigation/>--}}

        <div class="py-4 p-3 xl:p-6">
            <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 mb-4 xl:mb-6 shadow-md shadow-slate-300">
                <h1 class="text-3xl text-sky-800 border-b-4 border-red-700 pb-2 mb-6">
                    Continual Professional Development {{ $cpd_year_due }}
                </h1>

                <div class="flex gap-2 items-center">
                    <span class="inline-block">Latest CPD template:</span>
                    <a href="/documents/{{ $cpd_template_document->file_name }}"
                       class="inline-flex w-fit px-6 py-2 rounded-full bg-sky-600 text-sky-100 hover:text-white align-center"
                       download
                    >
                        <span class="inline-block w-7">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </span>
                        <span class="inline-block">
                        {{ $cpd_template_document->doc_type }} (v{{ $cpd_template_document->version }} {{ $cpd_template_document->release_month }} {{ $cpd_template_document->release_year }})
                    </span>
                    </a>
                </div>

                <hr class="my-6">

                <form wire:submit="submit"
                      enctype="multipart/form-data"
                >
                    @csrf
                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="completed_cpd_document" :value="__('Completed CPD')" class="w-48"/>
                        <input type="file" wire:model="completed_cpd_document" id="completed_cpd_document"
                               class="block w-full lg:w-96 cursor-pointer rounded-lg border border-solid border-secondary-500 bg-white bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-sky-600 hover:file:bg-sky-700 file:px-3  file:py-[0.32rem] file:text-surface file:text-white focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                               name="completed_cpd_document"/>
                    </div>
                    <x-cpr-input-error :messages="$errors->get('completed_cpd_document')" class="mt-2 lg:pl-1 lg:ml-48"/>

                    <button class="bg-fuchsia-500 hover:bg-fuchsia-600 text-white rounded-full px-6 py-2 mt-6 mb-2 flex flex-row items-center justify-center gap-2 lg:ml-48"
                    >
                        Submit
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" style="transform: rotate(90deg);" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="1.5" d="m12 18-7 3 7-18 7 18-7-3Zm0 0v-5"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
