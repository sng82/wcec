<nav
    x-data="{ sidebar_open: $persist(true) }"
    aria-label="Sidebar"
    class="h-full flex flex-shrink-0 bg-slate-600 overflow-y-auto transition duration-500 w-fit"
{{--    :class="{ 'w-fit' : sidebar_open , 'w-12' : !sidebar_open }"--}}
>
    <div class=" w-full flex sticky-top space-y-2 flex-col">

        <div class="flex flex-col h-full justify-between">
            <div class="flex flex-col ">

                <div class="flex flex-col content-center w-full h-12 px-3 mb-2 ">
                    <button
                        @click="sidebar_open = !sidebar_open"
                        class="flex content-center py-2 mt-2 font-semibold transition-all ease-in-out duration-500 text-white hover:text-cyan-400"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                             class="transform transition-transform duration-200 w-5 h-5"
                             :class="{'rotate-180' : sidebar_open, 'rotate-0' : !sidebar_open }">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                        </svg>

                    </button>
                </div>

                <x-sidebar-link :href="route('dashboard')"
                                :active="request()->routeIs('dashboard')"
                                icon="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                                wire:navigate>
                    {{ __('Dashboard') }}
                </x-sidebar-link>

                @if(Auth::user()->hasRole('admin'))

        {{--            <h2 class="text-cyan-200 ml-3 text-md">ADMIN</h2>--}}

                    <x-sidebar-link :href="route('members')"
                                    :active="request()->routeIs(['members', 'member-edit'])"
                                    icon="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"
                                    wire:navigate >
                        {{ __('Members') }}
                    </x-sidebar-link>

                    <x-sidebar-link :href="route('prices')"
                                    :active="request()->routeIs('prices')"
                                    icon="M14.121 7.629A3 3 0 0 0 9.017 9.43c-.023.212-.002.425.028.636l.506 3.541a4.5 4.5 0 0 1-.43 2.65L9 16.5l1.539-.513a2.25 2.25 0 0 1 1.422 0l.655.218a2.25 2.25 0 0 0 1.718-.122L15 15.75M8.25 12H12m9 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                    wire:navigate >
                        {{ __('Prices') }}
                    </x-sidebar-link>

{{--                    <x-sidebar-link href="#"--}}
{{--                                    class="text-red-500"--}}
{{--                                    icon="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z">--}}
{{--                        {{ __('Applicant Submissions') }}--}}
{{--                    </x-sidebar-link>--}}

                    <x-sidebar-link :href="route('submission-dates')"
                                    :active="request()->routeIs('submission-dates')"
                                    icon="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z"
                                    wire:navigate>
                        {{ __('Submission Dates') }}
                    </x-sidebar-link>

        {{--            <x-sidebar-link href="#" icon="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z">--}}
        {{--                {{ __('Expiring Memberships') }}--}}
        {{--            </x-sidebar-link>--}}

        {{--            <hr>--}}
                @endif

                @if(Auth::user()->hasRole('member') || Auth::user()->hasRole('lapsed member'))
                    <x-sidebar-link href="#">
                        {{ __('My Details') }}
                    </x-sidebar-link>

                    <x-sidebar-link href="#">
                        {{ __('Submit CPD') }}
                    </x-sidebar-link>

                    <x-sidebar-link href="#">
                        {{ __('Create Recurring Payment') }}
                    </x-sidebar-link>

                    <x-sidebar-link href="#">
                        {{ __('Manage My Payments') }}
                    </x-sidebar-link>

        {{--            <hr>--}}

                @endif

                @if(Auth::user()->hasRole('applicant'))
                    @if(Auth::user()->eoi_status !== 'submitted')
                        <x-sidebar-link :href="route('applicant-eoi')"
                                        :active="request()->routeIs('applicant-eoi')"
                                        title="Expression of Interest"
                                        icon="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                        wire:navigate>
                            {{ __('Expression of Interest') }}
                        </x-sidebar-link>
                    @endif

{{--                    <x-sidebar-link :href="route('applicant-documents')"--}}
{{--                                    :active="request()->routeIs('applicant-documents')"--}}
{{--                                    icon="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13"--}}
{{--                                    wire:navigate>--}}
{{--                        {{ __('My Documents') }}--}}
{{--                    </x-sidebar-link>--}}

{{--                    <x-sidebar-link :href="route('applicant-fees')"--}}
{{--                                    :active="request()->routeIs('applicant-fees')"--}}
{{--                                    title="Fees"--}}
{{--                                    icon="M14.121 7.629A3 3 0 0 0 9.017 9.43c-.023.212-.002.425.028.636l.506 3.541a4.5 4.5 0 0 1-.43 2.65L9 16.5l1.539-.513a2.25 2.25 0 0 1 1.422 0l.655.218a2.25 2.25 0 0 0 1.718-.122L15 15.75M8.25 12H12m9 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"--}}
{{--                                    wire:navigate >--}}
{{--                        {{ __('Fees Payable') }}--}}
{{--                    </x-sidebar-link>--}}

{{--                    <x-sidebar-link href="#">--}}
{{--                        {{ __('Pay Submission Fee') }}--}}
{{--                    </x-sidebar-link>--}}

{{--                    <x-sidebar-link href="#">--}}
{{--                        {{ __('My Application') }}--}}
{{--                    </x-sidebar-link>--}}

{{--                    <x-sidebar-link href="#">--}}
{{--                        {{ __('Complete Application') }}--}}
{{--                    </x-sidebar-link>--}}

                    <x-sidebar-link :href="route('applicant-help')"
                                    :active="request()->routeIs('applicant-help')"
                                    title="Help"
                                    icon="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"
                                    wire:navigate>
                        {{ __('Help') }}
                    </x-sidebar-link>

                @endif

                @if(Auth::user()->hasRole('accepted applicant'))

                    <x-sidebar-link :href="route('applicant-help')"
                                    :active="request()->routeIs('applicant-help')"
                                    icon="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"
                                    wire:navigate>
                        {{ __('Help') }}
                    </x-sidebar-link>
                    <x-sidebar-link :href="route('applicant-documents')"
                                    :active="request()->routeIs('applicant-documents')"
                                    icon="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                    wire:navigate>
                        {{ __('My Documentation') }}
                    </x-sidebar-link>

                    <x-sidebar-link href="#">
                        {{ __('Pay Application Fee') }}
                    </x-sidebar-link>

                    <x-sidebar-link href="#">
                        {{ __('My Application') }}
                    </x-sidebar-link>

                    <x-sidebar-link href="#">
                        {{ __('Complete Application') }}
                    </x-sidebar-link>

                    {{--            <hr>--}}

                @endif
            </div>

            <div class="flex flex-col pb-2">
                <x-sidebar-link href="/" icon="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3">
                    Return to site
                </x-sidebar-link>
            </div>
        </div>
    </div>

{{--    <div class="position-absolute top-1 left-2">--}}
{{--        <a href="/" class="flex content-center bg-transparent px-2 py-2 font-semibold transition-all ease-in-out duration-500 text-white hover:text-cyan-400">--}}
{{--            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">--}}
{{--                <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />--}}
{{--            </svg>--}}

{{--        </a>--}}
{{--    </div>--}}
</nav>
