<?php

use App\Livewire\Actions\Logout;
use App\Livewire\Forms\LogoutForm;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

};
?>


<div class="sticky top-0">

    <nav class="flex bg-sky-900 text-white main-nav lg-text-sky-900 shadow-md">
        <div class="container mx-auto px-5 mb-3 flex justify-between font-semibold uppercase">
            <div class="hidden lg:flex">
                <a href="/about" wire:navigate
                   class="mx-1 mt-3 flex items-center justify-center rounded-full border-2 border-transparent
                   {{ @request()->is('about')  ? 'bg-sky-950' : 'bg-transparent' }}
                   px-2 py-2 text-center transition-all duration-300 hover:border-red-700 hover:bg-red-700 xl:mx-3 xl:px-6">
                    About
                </a>
                <div @click.away="company_open = false" class="relative" x-data="{ company_open: false }">
                    <button @click="company_open = !company_open" type="button"
                            class="mx-1 mt-3 flex items-center justify-center uppercase rounded-full border-2 border-transparent px-2 py-2
                            {{ @request()->is('membership', 'court', 'where-we-meet', 'history', 'supporters', 'supporting', 'our-church')  ? 'bg-sky-950' : 'bg-transparent' }}
                            hover:border-red-700 hover:bg-red-700 lg:ml-0 xl:mr-3 xl:px-6">
                        The Company
                        <svg fill="currentColor" viewBox="0 0 20 20"
                             :class="{'rotate-180': company_open, 'rotate-0': !company_open}"
                             class="xl:ml-1 inline h-4 w-4 transform transition-transform duration-200">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div x-show="company_open" x-cloak
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute left-0 pt-2 w-max origin-top-left rounded-md shadow-lg">
                        <div class="rounded-md bg-slate-50 px-2 py-2 shadow">
                            <x-dropdown-link :href="route('membership')" @class(['text-red-700' => request()->is('membership'), 'text-sky-800' => ! request()->is('membership')]) wire:navigate>
                                Membership
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('officers')" @class(['text-red-700' => request()->is('officers'), 'text-sky-800' => ! request()->is('officers')]) wire:navigate>
                                Officers
                            </x-dropdown-link>
{{--                            <x-dropdown-link :href="route('where-we-meet')" @class(['text-red-700' => request()->is('where-we-meet'), 'text-sky-800' => ! request()->is('where-we-meet')]) wire:navigate>--}}
{{--                                Where We Meet--}}
{{--                            </x-dropdown-link>--}}
                            <x-dropdown-link :href="route('history')" @class(['text-red-700' => request()->is('history'), 'text-sky-800' => ! request()->is('history')]) wire:navigate>
                                Our History
                            </x-dropdown-link>
{{--                            <x-dropdown-link :href="route('supporters')" @class(['text-red-700' => request()->is('supporters'), 'text-sky-800' => ! request()->is('supporters')]) wire:navigate>--}}
{{--                                Our Supporters--}}
{{--                            </x-dropdown-link>--}}
                            <x-dropdown-link :href="route('supporting')" @class(['text-red-700' => request()->is('supporting'), 'text-sky-800' => ! request()->is('supporting')]) wire:navigate>
                                Supporting Others
                            </x-dropdown-link>
{{--                            <x-dropdown-link :href="route('our-church')" @class(['text-red-700' => request()->is('our-church'), 'text-sky-800' => ! request()->is('our-church')]) wire:navigate>--}}
{{--                                Our Church--}}
{{--                            </x-dropdown-link>--}}
                        </div>
                    </div>
                </div>
                <a href="/charitable-trust" wire:navigate
                   class="mx-1 mt-3 flex items-center justify-center rounded-full border-2 border-transparent
                   {{ @request()->is('charitable-trust')  ? 'bg-sky-950' : 'bg-transparent' }}
                   px-2 py-2 text-center transition-all duration-300 hover:border-red-700 hover:bg-red-700 xl:mx-3 xl:px-6">
                    Charitable Trust
                </a>
                <a href="/chartered-practitioners" wire:navigate
                   class="mx-1 mt-3 flex items-center justify-center rounded-full border-2 border-transparent
                   {{ @request()->is('chartered-practitioners')  ? 'bg-sky-950' : 'bg-transparent' }}
                   px-2 py-2 text-center transition-all duration-300 hover:border-red-700 hover:bg-red-700 xl:mx-3 xl:px-6">
                    Chartered Practitioners
                </a>

                <a href="/contact" wire:navigate
                   class="mx-1 mt-3 flex items-center justify-center rounded-full border-2 border-transparent
                   {{ @request()->is('contact')  ? 'bg-sky-950' : 'bg-transparent' }}
                   px-2 py-2 text-center transition-all duration-300 hover:border-red-700 hover:bg-red-700 xl:mx-3 xl:px-6">
                    Contact
                </a>
            </div>
            <div class="hidden lg:flex">

                <div @click.away="login_open = false" class="relative" x-data="{ login_open: false }">
                    <button @click="login_open = !login_open"
                            type="button"
                            class="mt-3 flex items-center justify-center rounded-full border-2 border-sky-800 bg-sky-800 px-6 py-2 text-center transition-all duration-300 hover:border-white hover:bg-transparent">
                        @auth()
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-5.5-2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 12a5.99 5.99 0 0 0-4.793 2.39A6.483 6.483 0 0 0 10 16.5a6.483 6.483 0 0 0 4.793-2.11A5.99 5.99 0 0 0 10 12Z" clip-rule="evenodd" />
                            </svg>
                            {{ Auth::user()->name }}
                        @else
                            Log In
                        @endauth
                        <svg fill="currentColor" viewBox="0 0 20 20"
                             :class="{'rotate-180': login_open, 'rotate-0': !login_open}"
                             class="xl:ml-1 inline h-4 w-4 transform transition-transform duration-200">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div x-show="login_open" x-cloak
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 pt-2 w-max origin-top-right rounded-md shadow-lg">
                        <div class="rounded-md bg-slate-50 px-2 py-2 shadow">
                            <a href="https://members.wc-ec.com" target="_blank" class="flex content-center rounded-lg bg-transparent px-4 py-2 font-semibold text-sky-800 hover:bg-slate-100 hover:text-red-700 focus:shadow-outline focus:bg-gray-200 focus:outline-none">
                                Livery Members Area
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 ml-2">
                                    <path fill-rule="evenodd" d="M4.25 5.5a.75.75 0 00-.75.75v8.5c0 .414.336.75.75.75h8.5a.75.75 0 00.75-.75v-4a.75.75 0 011.5 0v4A2.25 2.25 0 0112.75 17h-8.5A2.25 2.25 0 012 14.75v-8.5A2.25 2.25 0 014.25 4h5a.75.75 0 010 1.5h-5z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M6.194 12.753a.75.75 0 001.06.053L16.5 4.44v2.81a.75.75 0 001.5 0v-4.5a.75.75 0 00-.75-.75h-4.5a.75.75 0 000 1.5h2.553l-9.056 8.194a.75.75 0 00-.053 1.06z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            @auth()
                                <a href="/cpr/dashboard" class="flex content-center rounded-lg bg-transparent px-4 py-2 font-semibold text-sky-800 hover:bg-slate-100 hover:text-red-700 focus:shadow-outline focus:bg-gray-200 focus:outline-none">
                                    CPR Dashboard
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                                    </svg>
                                </a>
                                <button wire:click="logout" class="flex content-center w-full rounded-lg uppercase bg-transparent px-4 py-2 font-semibold text-red-600 hover:bg-slate-100 hover:text-red-700 focus:shadow-outline focus:bg-gray-200 focus:outline-none">
                                    Logout
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                    </svg>
                                </button>
                            @else
                                <a href="/cpr-coming-soon"  class="flex content-center rounded-lg bg-transparent px-4 py-2 font-semibold text-sky-800 hover:bg-slate-100 hover:text-red-700 focus:shadow-outline focus:bg-gray-200 focus:outline-none">
                                    Chartered Practitioners Portal
                                </a>
{{--                                <a href="/login"  class="flex content-center rounded-lg bg-transparent px-4 py-2 font-semibold text-sky-800 hover:bg-slate-100 hover:text-red-700 focus:shadow-outline focus:bg-gray-200 focus:outline-none">--}}
{{--                                    Chartered Practitioners Portal--}}
{{--                                </a>--}}
                            @endauth
                        </div>
                    </div>
                </div>

            </div>

            <!-- Mobile Nav Top Bar -->
            <div @click.away="mob_open = false" class="relative w-full lg:hidden"
                 x-data="{ mob_open: false }">
                <div class="mt-3 flex w-full justify-between lg:hidden">
                    <a href="/" class="flex flex-row items-center">
                        <img src="{{ Vite::asset('resources/img/wcec-crest-small.png') }}" class="inline-block object-contain h-10" alt="WCEC Logo">
                    </a>
                    <button @click="mob_open = !mob_open" type="button"
                            class="outline-none"
                    >
                        <svg class="h-8 w-8 text-white hover:text-red-600"
                             fill="none"
                             stroke-linecap="round"
                             stroke-linejoin="round"
                             stroke-width="2"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                        >
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>


                    <div x-show="mob_open" x-cloak
                         class="fixed inset-0 h-full w-full">
                        <div id="mobile-nav-bg"
                             x-show="mob_open"
                             class="absolute inset-0 h-full w-full bg-slate-900"
                             :class="mob_open ? 'opacity-50' : 'opacity-0'"
                        ></div>
                        <nav id="mobile-nav"
                             x-show="mob_open"
                             class="fixed top-0 right-0 h-full w-fit bg-slate-100 shadow transition duration-500 ease-out"
{{--                             x-transition:enter="transition duration-700"--}}
                             x-transition:enter-start="translate-x-full"
                             x-transition:enter-end="translate-x-0"
{{--                             x-transition:leave="transition duration-700"--}}
                             x-transition:leave-start="translate-x-0"
                             x-transition:leave-end="translate-x-full"
                        >
                            <div class="border border-b-slate-200 bg-white">
                                <div class="flex flex-row justify-between p-5 px-4 content-center w-full">
                                    <a href="/" wire:navigate class="flex flex-row items-center">
                                        <img src="{{ Vite::asset('resources/img/wcec-crest-small.png') }}" class="inline-block object-contain h-10" alt="WCEC Logo">
                                        <span class="font-brand ml-2 text-2xl text-sky-900">WC-EC</span>
                                    </a>
                                    <button @click="mob_open = false"
                                            class="flex cursor-pointer items-center justify-center text-gray-600 outline-none mobile-menu-button-close"
                                    >
                                        <svg class="h-6 w-6 text-sky-900 hover:text-red-600" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>

                                <a href="/about" wire:navigate class="block px-4 py-3 text-sky-800 transition duration-300 hover:bg-slate-200">
                                    About
                                </a>

                                <div @click.away="mob_company_open = false" class="relative"
                                     x-data="{ mob_company_open: false }">
                                    <button @click="mob_company_open = !mob_company_open" type="button"
                                            class="flex items-center w-full content-start px-4 py-3 uppercase
                                                {{ @request()->is('membership', 'court', 'where-we-meet', 'history', 'supporters', 'supporting', 'our-church')  ? 'text-red-700' : 'text-sky-800' }}
                                                transition duration-300 bg-white hover:bg-slate-200">
                                        The Company
                                        <svg fill="currentColor" viewBox="0 0 20 20"
                                             :class="{'rotate-180': mob_company_open, 'rotate-0': !mob_company_open}"
                                             class="ml-2 inline h-4 w-4 transform transition-transform duration-200">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                    <div x-show="mob_company_open"
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="transform opacity-0"
                                         x-transition:enter-end="transform opacity-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="transform opacity-100"
                                         x-transition:leave-end="transform opacity-0"
                                         class="w-full">
                                        <div class="m-2 mt-0 p-2 bg-slate-50 rounded-lg">
                                            <a href="/membership" wire:navigate
                                               class="block rounded-md px-4 py-2
                                                   {{ @request()->is('membership') ? 'text-red-700' : 'text-sky-800' }}
                                                   hover:bg-slate-200 hover:text-red-700">
                                                Membership
                                            </a>
                                            <a href="/court" wire:navigate
                                               class="block rounded-md px-4 py-2
                                                   {{ @request()->is('officers') ? 'text-red-700' : 'text-sky-800' }}
                                                   hover:bg-slate-200 hover:text-red-700">
                                                Officers
                                            </a>
                                            <a href="/history" wire:navigate
                                               class="block rounded-md px-4 py-2
                                               {{ @request()->is('history') ? 'text-red-700' : 'text-sky-800' }}
                                               hover:bg-slate-200 hover:text-red-700">
                                                Our History
                                            </a>
                                            <a href="/supporting" wire:navigate
                                               class="block rounded-md px-4 py-2
                                               {{ @request()->is('supporting') ? 'text-red-700' : 'text-sky-800' }}
                                               hover:bg-slate-200 hover:text-red-700">
                                                Supporting Others
                                            </a>
                                        </div>
                                    </div>
                                </div>


                                <a href="/charitable-trust" wire:navigate class="block px-4 py-3 text-sky-800 transition duration-300 hover:bg-slate-200">
                                    Charitable Trust
                                </a>
                                <a href="/chartered-practitioners" wire:navigate class="block px-4 py-3 text-sky-800 transition duration-300 hover:bg-slate-200">
                                    Chartered Practitioners
                                </a>
                                <a href="/contact" wire:navigate class="block px-4 py-3 text-sky-800 transition duration-300 hover:bg-slate-200">
                                    Contact
                                </a>

                            </div>

                            <div class="m-3 rounded-xl border p-3 bg-slate-200">
                                <p class="text-lg block px-3 text-sky-800 text-center">Log in</p>
                                <div class="flex flex-col px-3">
                                    <a href="https://members.wc-ec.com" target="_blank"
                                       class="mt-3 rounded-full border-2 border-sky-800 bg-sky-800 px-6 py-2 text-center text-white transition-all duration-300 hover:bg-white hover:text-sky-800">
                                        LIVERY MEMBERS<br>AREA
                                    </a>
{{--                                    <a href="/login" target="_blank"--}}
{{--                                       class="mt-3 rounded-full border-2 border-sky-800 bg-sky-800 px-6 py-2 text-center text-white transition-all duration-300 hover:bg-white hover:text-sky-800">--}}
{{--                                        CHARTERED<br>PRACTITIONERS PORTAL--}}
{{--                                    </a>--}}
                                    <a href="/cpr-coming-soon" target="_blank"
                                       class="mt-3 rounded-full border-2 border-sky-800 bg-sky-800 px-6 py-2 text-center text-white transition-all duration-300 hover:bg-white hover:text-sky-800">
                                        CHARTERED<br>PRACTITIONERS PORTAL
                                    </a>
                                </div>
                            </div>

                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </nav>

</div>
