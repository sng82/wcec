<main>
    <div class="w-full bg-white py-12 lg:py-20">
        <div class="container mx-auto px-5">
            <div class="flex flex-col gap-8 xl:gap-x-12 xl:flex-row 2xl:gap-16">
                <!-- Left -->
                <div class="grow text-sky-950">
                    <h1 class="mb-2 lg:mb-4 text-3xl font-brand md:text-4xl lg:text-5xl text-red-700">
                        Expression of Interest
                    </h1>
                    <hr class="mb-2 lg:mb-4 page-title-under">
                    <p>
                        It's important that you have read and understand the application/admission processes detailed on our <a class="text-red-700 hover:text-red-500" href="/chartered-practitioners">Chartered Practitioners page</a> before proceeding.
                    </p>

                    <form wire:submit="submit">
                        <x-honeypot livewire-model="extraFields" />

                        <div class="bg-slate-50 rounded-lg p-3 xl:p-4 mt-6 border border-slate-200 shadow">
                            <h2 class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2">
                                Your Details
                            </h2>
                            <p class="mt-4">
                                Your admittance certificate will show your name as printed here.
                            </p>
                            <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                                <x-admin-input-label for="first_name" :value="__('First Name')" class="lg:w-48" />
                                <x-text-input wire:model="first_name" id="first_name" class="block w-full lg:w-96" type="text" name="first_name" required autofocus autocomplete="first_name" />
                            </div>
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2 ml-48" />

                            <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                                <x-admin-input-label for="last_name" :value="__('Last Name')" class="w-48" />
                                <x-text-input wire:model="last_name" id="last_name" class="block w-full lg:w-96" type="text" name="last_name" required autocomplete="last_name" />
                            </div>
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2 ml-48" />

                            <h2 class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2 mt-10">
                                Communications
                            </h2>
                            <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                                <x-admin-input-label for="email" :value="__('Business Email')" class="w-48" />
                                <x-text-input wire:model="email" id="email" class="block w-full lg:w-[500px]" type="email" name="email" required autocomplete="email" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2 ml-48" />


                            <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                                <x-admin-input-label for="phone_1" :value="__('Business Phone')" class="w-48" />
                                <x-text-input wire:model="phone_1" id="phone_1" class="block w-full lg:w-96" type="text" name="phone_1" required autocomplete="phone_1" />
                            </div>
                            <x-input-error :messages="$errors->get('phone_1')" class="mt-2" />

                            <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                                <x-admin-input-label for="phone_2" :value="__('Business Phone 2')" class="w-48" />
                                <x-text-input wire:model="phone_2" id="phone_2" class="block w-full lg:w-96" type="text" name="phone_2" autocomplete="phone_2" />
                                <span class="text-sm text-gray-700 italic"> - optional</span>
                            </div>
                            <x-input-error :messages="$errors->get('phone_2')" class="mt-2 ml-48" />

                            <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                                <x-admin-input-label for="phone_3" :value="__('Business Phone 3')" class="w-48" />
                                <x-text-input wire:model="phone_3" id="phone_3" class="block w-full lg:w-96" type="text" name="phone_3" autocomplete="phone_3" />
                                <span class="text-sm text-gray-700 italic"> - optional</span>
                            </div>
                            <x-input-error :messages="$errors->get('phone_3')" class="mt-2 ml-48" />

                            <h2 class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2 mt-10">
                                Current Employment &amp; Position
                            </h2>
                            <p class="mt-4">
                                Please provide a description of your current role. Include a copy of your job description.
                                If you do not have a formal document, please provide a description of your current role.
                            </p>

                            <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                                <x-admin-input-label for="current_role" :value="__('Current Role')" class="w-48" />
                                <textarea wire:model="current_role" name="current_role" rows="6" id="current_role" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 resize rounded-md block w-full lg:w-[700px] xl:w-[950px] 2xl:w-[1200px]" ></textarea>
                            </div>
                            <x-input-error :messages="$errors->get('current_role')" class="mt-2 ml-48" />

                            <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                                <x-admin-input-label for="job_description" :value="__('Job Description')" class="w-48" />
                                <input type="file" wire:model="job_description" id="job_description" class="block w-full lg:w-96" name="job_description" />
                            </div>
                            <x-input-error :messages="$errors->get('job_description')" class="mt-2 ml-48" />

                            <h2 class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2 mt-10">
                                 Employment History
                            </h2>
                            <p class="mt-4">
                                An appraisal of your employment history, particularly with regard to knowledge,
                                practical skills, leadership, communication and professional commitment.
                                Be specific about the roles you have undertaken during your employment history,
                                particularly with regard to knowledge, practical skills, leadership, communication
                                and professional commitment.
                            </p>

                            <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                                <x-admin-input-label for="employment_history" :value="__('Appraisal')" class="w-48" />
                                <textarea wire:model="employment_history" name="employment_history" rows="10" id="employment_history" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 resize rounded-md block w-full lg:w-[700px] xl:w-[950px] 2xl:w-[1200px]" ></textarea>
                            </div>
                            <x-input-error :messages="$errors->get('employment_history')" class="mt-2 ml-48" />

                            <h2 class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2 mt-10">
                                Education
                            </h2>
                            <p class="mt-4">
                                Include all higher education qualifications, including non-cleaning subjects.
                                You must supply copy certificates for these and bring the originals along to the
                                interview.
                            </p>

                            <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                                <x-admin-input-label for="qualifications" :value="__('Qualifications')" class="w-48" />
                                <textarea wire:model="qualifications" name="qualifications" rows="6" id="qualifications" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 resize rounded-md block w-full lg:w-[700px] xl:w-[950px] 2xl:w-[1200px]" ></textarea>
                            </div>
                            <x-input-error :messages="$errors->get('qualifications')" class="mt-2 ml-48" />

                            <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                                <x-admin-input-label for="qualification_certificates" :value="__('Certificates')" class="w-48" />
                                <input type="file" wire:model="qualification_certificates" id="qualification_certificates" class="block w-full lg:w-96" name="qualification_certificates" multiple />
                            </div>
                            <x-input-error :messages="$errors->get('qualification_certificates')" class="mt-2 ml-48" />

                            <h2 class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2 mt-10">
                                Training
                            </h2>
                            <p class="mt-4">
                                Training courses you have undertaken in the last 5 years.
                                Add details of training courses you have undertaken.
                                Provide attendance certificates if possible.
                            </p>

                            <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                                <x-admin-input-label for="training" :value="__('Training')" class="w-48" />
                                <textarea wire:model="training" name="training" rows="6" id="training" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 resize rounded-md block w-full lg:w-[700px] xl:w-[950px] 2xl:w-[1200px]" ></textarea>
                            </div>
                            <x-input-error :messages="$errors->get('training')" class="mt-2 ml-48" />

                            <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                                <x-admin-input-label for="training_certificates" :value="__('Training Certificates')" class="w-48" />
                                <input type="file" wire:model="training_certificates" id="training_certificates" class="block w-full lg:w-96" name="training_certificates" multiple />
                            </div>
                            <x-input-error :messages="$errors->get('training_certificates')" class="mt-2 ml-48" />


                            <h2 class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2 mt-10">
                                Security
                            </h2>
                            <p class="mt-4">
                                Please choose a secure password. You will need this to continue your application process.
                            </p>

                            <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                                <x-admin-input-label for="password" :value="__('Password')" class="lg:w-48" />
                                <div class="flex mt-1 mb-2">
                                    <div class="relative flex-1 col-span-4" x-data="{ show_pass: true }">
                                        <input wire:model="password" class="w-full lg:w-96 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                               id="password"
                                               :type="show_pass ? 'password' : 'text'"
                                               name="password"
                                               required autocomplete="new-password" />

                                        <button type="button" title="Show / hide"
                                                class="flex absolute inset-y-0 right-0 items-center pr-3"
                                                @click="show_pass = !show_pass"
                                                :class="{'hidden': !show_pass, 'block': show_pass }">
                                            <!-- Heroicon name: eye -->
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </button>
                                        <button type="button" class="flex absolute inset-y-0 right-0 items-center pr-3" @click="show_pass = !show_pass" :class="{'block': !show_pass, 'hidden': show_pass }">
                                            <!-- Heroicon name: eye-slash -->
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
{{--                                <x-text-input wire:model="password" id="password" class="block w-full lg:w-96" type="password" name="password" required autocomplete="new-password" />--}}
                            </div>
                            <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                                <x-admin-input-label for="password_confirmation" :value="__('Confirm Password')" class="lg:w-48" />
                                <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block w-full lg:w-96" type="password" name="password_confirmation" required autocomplete="new-password" />
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2 ml-48" />

                            <hr class="my-6">

                            <p>Click Next to pay the {{ Number::currency($eoi_fee->amount, 'GBP') }} fee, and submit your Expression of Interest.</p>
                            <button type="submit"
                                    class="bg-sky-900 text-white rounded-full px-6 py-2 mt-4 hover:bg-sky-800">
                                Next
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
