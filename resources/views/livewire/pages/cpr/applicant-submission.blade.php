<div class="flex h-full w-full overflow-y-auto">

    <livewire:cpr.sidebar/>

    <div class="right w-full min-w-80 flex grow flex-col overflow-y-auto">

        <livewire:layout.cpr-navigation/>

        <form wire:submit="submit" class="py-4 p-3 xl:p-6">

            <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 mt-6 mb-6 border border-slate-300 shadow shadow-slate-400">
                <h1 class="text-3xl text-sky-800 border-b-4 border-red-600 pb-2 mb-6">
                    Registration
                </h1>

                <p class="mb-4">There are two pathways to registration - the Standard path and the Individual path.</p>

                <div class="flex flex-col xl:flex-row mb-4 gap-4 mx-4">
                    <div class="flex w-full xl:w-1/2">
                        <div class="rounded-3xl bg-slate-600 text-white p-6 w-full">
                            <h2 class="text-2xl border-b-2 border-slate-400 pb-1 text-slate-100 mb-4">
                                Standard Path
                            </h2>
                            <p class="font-bold">
                                Standard Path requirements:
                            </p>
                            <ul class="my-2 ml-6 list-square marker:text-slate-400 space-y-1">
                                <li>
                                    A Bachelor’s or a Master’s degree or Diploma in any subject plus a cleaning
                                    related qualification.
                                </li>
                            </ul>
                            <span class="font-bold">OR</span>
                            <ul class="my-2 ml-6 list-square marker:text-slate-400 space-y-1">
                                <li>
                                    Five years operational Cleaning industry experience with at least two years
                                    where you can demonstrate you are at the Chartered competence level.
                                </li>
                            </ul>
                            <span class="font-bold">PLUS</span>
                            <ul class="my-2 ml-6 list-square marker:text-slate-400 space-y-1">
                                <li>
                                    An interview with The Assessment panel and members of the Select Committee
                                    including giving a presentation demonstrating your
                                    competency in all the five key elements.
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex w-full xl:w-1/2">
                        <div class="rounded-3xl bg-slate-400 text-white p-6 w-full">
                            <h2 class="text-2xl border-b-2 border-slate-500 pb-1 text-slate-100 mb-4">
                                Individual Path
                            </h2>
                            <p class="font-bold">
                                Individual Path requirements:
                            </p>
                            <ul class="my-2 ml-6 list-square marker:text-slate-700 space-y-4">
                                <li>
                                    Submission of a paper (approximately 10,000 words in length) demonstrating
                                    that you meet the defined competence requirements of all the
                                    five key elements.
                                </li>
                                <li>
                                    Ten years’ Management experience with the last five years at a senior level.
                                </li>
                                <li>
                                    An interview with the representatives of the of the Assessment panel and
                                    members of the Select Committee which will include giving a presentation.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl bg-slate-200 p-6 mx-4">
                    <h2 class="text-2xl border-b-2 border-slate-300 pb-1 mb-4">Further Details</h2>

                    <a href="/documents/WCEC-CP-02-04-GUIDE-FOR-EXPRESSION-OF-INTEREST_v4_FEB-2021.docx"
                       class="flex text-sky-600 hover:text-sky-700 w-fit pb-1 border-b border-transparent hover:border-sky-600"
                       download>
                        <span class="inline-block w-7">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </span>
                        <span class="inline-block">
                            GUIDE FOR EXPRESSION OF INTEREST (v4 FEB 2021)
                        </span>
                    </a>
                </div>

                <hr class="mt-12 mb-8 border-b-4">

                <div x-data="{ path: '' }">
                    <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                        <x-admin-input-label for="path" :value="__('Registration Path')" class="w-48" />
                        <select wire:model="path" x-model="path" id="path" name="path"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-sky-500 rounded-md shadow-sm lg:w-52"
                                required>
                            <option value="" selected>- Please Select -</option>
                            <option value="standard">Standard</option>
                            <option value="individual">Individual</option>
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('path')" class="mt-2" />

                    <div x-show="path == 'individual'" x-cloak>
                        <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                            <x-admin-input-label for="submission_paper" :value="__('Submission Paper')" class="w-48"/>
                            <input type="file" wire:model="submission_paper" id="submission_paper"
                                   class="block w-full lg:w-96 cursor-pointer rounded-lg border border-solid border-secondary-500 bg-white bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-sky-600 hover:file:bg-sky-700 file:px-3  file:py-[0.32rem] file:text-surface file:text-white focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                   name="submission_paper"/>
                        </div>
                        <x-cpr-input-error :messages="$errors->get('submission_paper')" class="mt-2 lg:pl-1 lg:ml-48"/>
                        <p class="text-sm mt-2 pl-1 lg:ml-48 text-slate-400">Permitted file types: .doc, .docx, .pdf</p>
                    </div>

                    <button class="bg-sky-600 hover:bg-sky-700 text-white rounded-full px-6 py-2 my-4 flex flex-row items-center justify-center gap-2"
                    >
                        Submit
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" style="transform: rotate(90deg);" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="1.5" d="m12 18-7 3 7-18 7 18-7-3Zm0 0v-5"/>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>