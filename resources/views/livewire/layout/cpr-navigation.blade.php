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

<div class="sticky top-0 z-10">
    <nav class="flex bg-slate-700">
        <div class="w-full mx-auto my-2 flex justify-end font-semibold uppercase pr-2">
            <button wire:click="logout"
                    class="flex flex-row content-center gap-2 rounded-lg uppercase bg-transparent pt-1 pl-3 pr-2
                    font-normal text-red-500 transition-all ease-in-out duration-500
                    hover:bg-slate-600 focus:shadow-outline focus:bg-gray-200 focus:outline-none">
                <span>logout</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                     class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                </svg>
            </button>
        </div>
    </nav>
</div>
