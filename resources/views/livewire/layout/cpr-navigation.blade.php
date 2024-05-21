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
    <nav class="flex bg-slate-700">
        <div class="w-full mx-auto my-3 flex justify-end font-semibold uppercase">
{{--            <button--}}
{{--                @click="sidebar_open = !sidebar_open"--}}
{{--                    class="flex content-center bg-transparent py-2 font-semibold transition-all ease-in-out duration-500 text-white hover:text-cyan-400"--}}
{{--                    >--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" fill="none"--}}
{{--                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"--}}
{{--                     class="transform transition-transform duration-200 w-6 h-6"--}}
{{--                     :class="{'rotate-180' : sidebar_open, 'rotate-0' : !sidebar_open }">--}}
{{--                    <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />--}}
{{--                </svg>--}}

{{--            </button>--}}
            <button wire:click="logout" class="flex content-center float-end rounded-lg uppercase bg-transparent pl-4 pr-2 mr-4 py-2 font-semibold text-red-600 transition-all ease-in-out duration-500 hover:bg-slate-100 hover:text-red-700 focus:shadow-outline focus:bg-gray-200 focus:outline-none">
                Logout
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                </svg>
            </button>
        </div>
    </nav>
</div>
