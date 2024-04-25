<div class="flex overflow-hidden ">
    <nav aria-label="Sidebar" class="hidden lg:block flex-shrink-0 bg-slate-800 overflow-y-auto">
        <div class="relative w-50 flex space-y-2 flex-col py-3 px-6">

            <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </x-sidebar-link>

            @if(Auth::user()->account_type === 'admin')
                <x-sidebar-link :href="route('submission-dates')" :active="request()->routeIs('submission-dates')" wire:navigate>
                    {{ __('Submission Dates') }}
                </x-sidebar-link>
            @endif

            <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </x-sidebar-link>

            <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </x-sidebar-link>

            <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </x-sidebar-link>

        </div>
    </nav>
</div>
