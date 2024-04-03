<main>
    <div class="w-full bg-white py-12 lg:py-20">
        <div class="container mx-auto px-5">
            <div class="bg-white text-sky-950">
                <h1 class="mb-2 lg:mb-4 text-3xl font-brand md:text-4xl lg:text-5xl text-red-700">
                    Contact Us
                </h1>
                <hr class="mb-2 lg:mb-4 page-title-under">
                <p>
                    If you are interested in finding out more about joining the Environmental Cleaners, please drop us a
                    line.
                </p>
                <div class="flex flex-col xl:flex-row gap-12">
                    <div class="flex xl:w-[50%]">
                        @if ( session('status') && (session('status') === 'sent'))
                            <div class="flex self-center rounded border border-slate-200 py-24 px-12 mt-4 bg-slate-100 xl:w-full">
                                <div class="flex rounded border border-sky-900 py-8 px-4 bg-sky-800 text-white xl:w-full shadow">
                                    <p class="text-xl mx-auto text-center py-4 border-b-4 border-t-4 border-red-600 mb-0">
                                        Your message has been sent.<br>
                                        Thanks for getting in touch.
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="rounded border border-slate-200 p-5 mt-4 bg-slate-100 xl:w-full">
                                <form wire:submit="submit" class="w-full">
                                    <x-honeypot livewire-model="extraFields" />
                                    <label for="name" class="block w-full text-sky-800">
                                        Name:
                                    </label>
                                    <input type="text" wire:model="name" name="name" id="name"
                                           class="form-input min-w-[400px] rounded border @error('email') border-red-600 @else border-slate-200 @enderror block w-full" />
                                    <div>
                                        @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <label for="email" class="block w-full text-sky-800 mt-2">
                                        Email:
                                    </label>
                                    <input type="email" wire:model="email"
                                           class="form-input rounded border @error('email') border-red-600 @else border-slate-200 @enderror block w-full"
                                           name="email" id="email" />
                                    <div>
                                        @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <label for="phone" class="block w-full text-sky-800 mt-2">
                                        Phone:
                                    </label>
                                    <input type="number" wire:model="phone"
                                           class="form-input rounded border @error('email') border-red-600 @else border-slate-200 @enderror block w-full"
                                           name="phone" id="phone" />
                                    <div>
                                        @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <label for="message" class="block w-full text-sky-800 mt-2">
                                        Message:
                                    </label>
                                    <textarea wire:model="message"
                                              class="form-input rounded border @error('email') border-red-600 @else border-slate-200 @enderror block w-full"
                                              name="message" id="message" rows="3"></textarea>
                                    <div>
                                        @error('message') <span
                                            class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <button type="submit"
                                            class="bg-sky-700 text-white rounded-full px-6 py-2 mt-3 hover:bg-sky-800 active:bg-sky-900 uppercase">
                                        Send
                                    </button>
                                </form>
                            </div>
                        @endif

                    </div>
                    <div class="flex p-5 xl:mt-4">
                        <p>Or write to:<br><br>
                            Clerk of the Company<br>
                            Worshipful Company of Environmental Cleaners<br>
                            2 Chapel Street<br>
                            Potton<br>
                            Sandy<br>
                            Bedfordshire<br>
                            SG19 2PT
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

