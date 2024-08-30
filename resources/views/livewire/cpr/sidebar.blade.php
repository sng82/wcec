<nav x-data="{ sidebar_open: $persist(true) }"
     aria-label="Sidebar"
     class="h-full flex flex-shrink-0 bg-slate-700 overflow-y-auto transition duration-500 w-fit"
        {{--    :class="{ 'w-60' : sidebar_open , 'w-fit' : !sidebar_open }"--}}
>
    <div class=" w-full flex sticky-top space-y-2 flex-col">
        <div class="flex flex-col h-full justify-between">
            <div class="flex flex-col ">

                <div class="flex flex-col content-center w-full h-12 mb-2 ">
                    <button
                        @click="sidebar_open = !sidebar_open" title="Expand/Shrink Menu"
                        class="flex content-center py-2 px-3 mt-2 font-semibold transition-all ease-in-out duration-500 text-white hover:text-cyan-400"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                             class="transform transition-transform duration-200 w-6 h-6"
                             :class="{'rotate-180' : sidebar_open, 'rotate-0' : !sidebar_open }">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                        </svg>

                    </button>
                </div>

                @can('view dashboard')
                    <x-sidebar-link :href="route('dashboard')"
                                    :active="request()->routeIs('dashboard')"
                                    x-bind:title="sidebar_open ? null : 'Dashboard (Home)'"
                                    icon="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                                    wire:navigate>
                        {{ __('Dashboard') }}
                    </x-sidebar-link>
                @endcan

                @can('manage users')
                    <x-sidebar-link :href="route('registrants')"
                                    :active="request()->routeIs(['registrants', 'user-edit', 'user-add'])"
                                    x-bind:title="sidebar_open ? null : 'Registrants & Applicants'"
                                    icon="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"
                                    wire:navigate >
                        {{ __('Registrants') }}
                    </x-sidebar-link>
                @endcan

                @can('manage prices')
                    <x-sidebar-link :href="route('prices')"
                                    :active="request()->routeIs('prices')"
                                    x-bind:title="sidebar_open ? null : 'Prices'"
                                    icon="M14.121 7.629A3 3 0 0 0 9.017 9.43c-.023.212-.002.425.028.636l.506 3.541a4.5 4.5 0 0 1-.43 2.65L9 16.5l1.539-.513a2.25 2.25 0 0 1 1.422 0l.655.218a2.25 2.25 0 0 0 1.718-.122L15 15.75M8.25 12H12m9 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                    wire:navigate >
                        {{ __('Prices') }}
                    </x-sidebar-link>
                @endcan

                @can('manage admission dates')
                    <x-sidebar-link :href="route('admission-dates')"
                                    :active="request()->routeIs('admission-dates')"
                                    x-bind:title="sidebar_open ? null : 'Admission Dates'"
                                    icon="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z"
                                    wire:navigate>
                        {{ __('Admission Dates') }}
                    </x-sidebar-link>
                @endcan

                @can('manage public documents')
                    <x-sidebar-link :href="route('public-documents')"
                                    :active="request()->routeIs('public-documents')"
                                    x-bind:title="sidebar_open ? null : 'Public Documents'"
                                    icon="{{
                                        request()->routeIs('public-documents')
                                            ? 'M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776'
                                            : 'M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z'
                                    }}"
                                    wire:navigate>
                        {{ __('Public Documents') }}
                    </x-sidebar-link>
                @endcan

                @can('manage private documents')
                    <x-sidebar-link :href="route('private-documents')"
                                    :active="request()->routeIs('private-documents')"
                                    x-bind:title="sidebar_open ? null : 'Private Documents'"
                                    icon="{{
                                        request()->routeIs('private-documents')
                                            ? 'M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776'
                                            : 'M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z'
                                    }}"
                                    wire:navigate>
                        {{ __('Private Documents') }}
                    </x-sidebar-link>
                @endcan

{{--                @can('view eois')--}}
{{--                    <x-sidebar-link :href="route('eois')"--}}
{{--                                    :active="request()->routeIs('eois')"--}}
{{--                                    x-bind:title="sidebar_open ? null : 'EoIs'"--}}
{{--                                    icon="m7.875 14.25 1.214 1.942a2.25 2.25 0 0 0 1.908 1.058h2.006c.776 0 1.497-.4 1.908-1.058l1.214-1.942M2.41 9h4.636a2.25 2.25 0 0 1 1.872 1.002l.164.246a2.25 2.25 0 0 0 1.872 1.002h2.092a2.25 2.25 0 0 0 1.872-1.002l.164-.246A2.25 2.25 0 0 1 16.954 9h4.636M2.41 9a2.25 2.25 0 0 0-.16.832V12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 12V9.832c0-.287-.055-.57-.16-.832M2.41 9a2.25 2.25 0 0 1 .382-.632l3.285-3.832a2.25 2.25 0 0 1 1.708-.786h8.43c.657 0 1.281.287 1.709.786l3.284 3.832c.163.19.291.404.382.632M4.5 20.25h15A2.25 2.25 0 0 0 21.75 18v-2.625c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125V18a2.25 2.25 0 0 0 2.25 2.25Z"--}}
{{--                                    wire:navigate>--}}
{{--                        {{ __('EoIs') }}--}}
{{--                    </x-sidebar-link>--}}
{{--                @endcan--}}

{{--                --}}
{{--                @can('view submissions')--}}
{{--                    <x-sidebar-link :href="route('submissions')"--}}
{{--                                    :active="request()->routeIs('submissions')"--}}
{{--                                    x-bind:title="sidebar_open ? null : 'Submissions'"--}}
{{--                                    icon="m7.875 14.25 1.214 1.942a2.25 2.25 0 0 0 1.908 1.058h2.006c.776 0 1.497-.4 1.908-1.058l1.214-1.942M2.41 9h4.636a2.25 2.25 0 0 1 1.872 1.002l.164.246a2.25 2.25 0 0 0 1.872 1.002h2.092a2.25 2.25 0 0 0 1.872-1.002l.164-.246A2.25 2.25 0 0 1 16.954 9h4.636M2.41 9a2.25 2.25 0 0 0-.16.832V12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 12V9.832c0-.287-.055-.57-.16-.832M2.41 9a2.25 2.25 0 0 1 .382-.632l3.285-3.832a2.25 2.25 0 0 1 1.708-.786h8.43c.657 0 1.281.287 1.709.786l3.284 3.832c.163.19.291.404.382.632M4.5 20.25h15A2.25 2.25 0 0 0 21.75 18v-2.625c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125V18a2.25 2.25 0 0 0 2.25 2.25Z"--}}
{{--                                    wire:navigate>--}}
{{--                        {{ __('Submissions') }}--}}
{{--                    </x-sidebar-link>--}}
{{--                @endcan--}}

                @can('submit cpd')
                    <x-sidebar-link :href="route('registrant-cpd')"
                                    :active="request()->routeIs('registrant-cpd')"
                                    x-bind:title="sidebar_open ? null : 'Submit CPD'"
                                    icon="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                    wire:navigate>
                        {{ __('Submit CPD') }}
                    </x-sidebar-link>
                @endcan

                @can('submit eoi')
                    @if(Auth::user()->registration_fee_paid && !in_array(Auth::user()->eoi_status, ['accepted', 'submitted', 'rejected']))
                        <x-sidebar-link :href="route('applicant-eoi')"
                                        :active="request()->routeIs('applicant-eoi')"
                                        x-bind:title="sidebar_open ? null : 'Expression of Interest'"
                                        icon="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                        wire:navigate>
                            {{ __('Expression of Interest') }}
                        </x-sidebar-link>
                    @endif
                @endcan

                @can('view applicant help')
                    <x-sidebar-link :href="route('applicant-help')"
                                    :active="request()->routeIs('applicant-help')"
                                    x-bind:title="sidebar_open ? null : 'Help'"
                                    icon="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"
                                    wire:navigate>
                        {{ __('Help') }}
                    </x-sidebar-link>
                @endcan

                @can('edit own details')
                    <x-sidebar-link :href="route('my-details')"
                                    :active="request()->routeIs('my-details')"
                                    x-bind:title="sidebar_open ? null : 'My Details'"
                                    icon="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                    wire:navigate>
                        {{ __('My Details') }}
                    </x-sidebar-link>
                @endcan

                @can('view logs')
                    <x-sidebar-link href="/log-viewer-hj7czz2wuptr" target="_blank" class=""
                                    x-bind:title="sidebar_open ? null : 'Log Viewer'"
                                    icon="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                    >
                        {{ __('Log Viewer') }}
                    </x-sidebar-link>
                @endcan
            </div>

            <div class="flex flex-col pb-2">
                <x-sidebar-link href="/" icon="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3">
                    Back to website
                </x-sidebar-link>

                <button wire:click="logout"
                        class="inline-flex items-center py-3 lg:py-2 my-1 lg:my-0
                        font-medium border-l-2 border-transparent focus:outline-none text-slate-200
                        hover:text-white hover:border-b-cyan-400 hover:bg-red-500
                        focus:text-gray-700 focus:border-gray-300 active:cursor-wait transition duration-150 ease-in-out"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         class="w-6 h-6 mx-3 text-red-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    <span class="transition ease-in delay-1000" :class="{'hidden pr-0' : !sidebar_open, 'block pr-4' : sidebar_open }">
                        Logout
                    </span>
                </button>

            </div>
        </div>
    </div>

</nav>
