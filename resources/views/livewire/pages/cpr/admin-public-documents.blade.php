<div class="flex h-full w-full overflow-y-auto">

    <livewire:cpr.sidebar/>

    <div class="right w-full min-w-80 flex grow flex-col overflow-y-auto">

        <livewire:layout.cpr-navigation/>

            <div class="py-4 p-3 xl:p-6">

                <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 mb-6 border border-slate-300 shadow shadow-slate-400">
                    <h1 class="text-2xl text-sky-800 border-b-4 border-red-700 pb-2 mb-4">
                        Public Documents
                    </h1>

                    <p class="mb-4">
                        Documents that can be accessed by the public and/or registrants.
                    </p>

                    <div class="overflow-hidden border border-slate-100 rounded-lg shadow-sm overflow-x-auto">
                        <table class="table-auto w-full divide-y divide-slate-100 text-sm">
                            <thead class="bg-slate-200">
                                <tr class="text-slate-700">
                                    <th scope="col" class="px-4 py-2 text-left">Type</th>
                                    <th scope="col" class="px-4 py-2 text-left">File</th>
                                    <th scope="col" class="px-4 py-2 text-left">Version</th>
                                    <th scope="col" class="px-4 py-2 text-left">Release Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100 text-slate-500">
                                @foreach($documents as $document)
                                    <tr wire:key="{{ $document->id }}">
                                        <td class="px-4 py-2">
                                            {{ $document->doc_type }}
                                        </td>
                                        <td class="px-4 py-2">
                                            <a href="/storage/documents/{{ $document->file_name }}"
                                               class="underline text-sky-700 hover:text-sky-600"
                                            >
                                                {{ $document->file_name }}
                                            </a>
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $document->version }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $document->release_month }}
                                            {{ $document->release_year }}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 mt-6 mb-6 border border-slate-300 shadow shadow-slate-400">
                    <h2 class="text-2xl text-sky-800 border-b-4 border-red-700 pb-2 mb-4">
                        Update Document
                    </h2>

                    <p>Replace an existing document with an updated version:</p>

                    <form wire:submit="submit" enctype="multipart/form-data">
                        @csrf

                        <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                            <x-admin-input-label for="document_type" :value="__('Document To Replace')" class="w-48" />
                            <select wire:model="document_type" id="document_type" name="document_type" class="border-gray-300 focus:border-indigo-500 focus:ring-sky-500 rounded-md shadow-sm lg:w-80">
                                <option value="" selected disabled>- Select -</option>
                                @foreach( $documents as $document)
                                    <option wire:key="{{ $document->id }}" value="{{ $document->id }}" >
                                        {{ $document->doc_type }}
                                    </option>
                                @endforeach
                            </select>
                            <x-cpr-input-error :messages="$errors->get('document_type')" class="mt-2 lg:pl-1 lg:ml-4 lg:mt-0"/>
                        </div>

                        <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                            <x-admin-input-label for="new_file" :value="__('New File')" class="w-48"/>
                            <input type="file" wire:model="new_file" id="new_file"
                                   class="block w-full lg:w-3/4 cursor-pointer rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-[0.5rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.5rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-sky-600 hover:file:bg-sky-700 file:px-3 file:py-[0.5rem] file:text-surface file:text-white focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none shadow-sm"
                                   name="new_file"/>
                            <x-cpr-input-error :messages="$errors->get('new_file')" class="mt-2 lg:pl-1 lg:ml-4 lg:mt-0"/>
                        </div>

                        <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                            <x-admin-input-label for="version" :value="__('Version')" class="lg:w-48" />
                            <x-text-input wire:model="version" id="version" min="1"
                                          class="lg:w-24" type="number"
                                          name="version" required/>
                            <x-cpr-input-error :messages="$errors->get('version')" class="mt-2 lg:pl-1 lg:ml-4 lg:mt-0"/>

                            <span class="text-sm text-gray-700 italic lg:ml-2"> - For display purposes only.</span>
                        </div>

                        <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                            <x-admin-input-label for="release_month" :value="__('Release Date')" class="w-48" />
                            <select wire:model="release_month" id="release_month" name="release_month" class="border-gray-300 focus:border-indigo-500 focus:ring-sky-500 rounded-md shadow-sm lg:w-24">
                                @foreach( $months as $month)
                                    <option wire:key="{{ $month }}" value="{{ $month }}">
                                        {{ $month }}
                                    </option>
                                @endforeach
                            </select>
                            <x-cpr-input-error :messages="$errors->get('release_month')" class="mt-2 lg:pl-1 lg:ml-4 lg:mt-0"/>

                            <x-admin-input-label for="release_year" :value="__('Release Year')" class="sr-only w-48" />
                            <select wire:model="release_year" id="release_year" name="release_year" class="border-gray-300 focus:border-indigo-500 focus:ring-sky-500 rounded-md shadow-sm lg:w-24">
                                @foreach( $years as $year)
                                    <option wire:key="{{ $year }}" value="{{ $year }}">
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                            <x-cpr-input-error :messages="$errors->get('release_year')" class="mt-2 lg:pl-1 lg:ml-4 lg:mt-0"/>

                            <span class="text-sm text-gray-700 italic lg:ml-2"> - For display purposes only.</span>
                        </div>

                        <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                            <span class="w-48"></span>
                            <div>
                                <x-primary-button class="px-8">
                                    {{ __('Save') }}
                                </x-primary-button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
    </div>
</div>
