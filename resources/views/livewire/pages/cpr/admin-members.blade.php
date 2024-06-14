<div class="flex h-full w-full overflow-y-auto">

    <livewire:cpr.sidebar/>

    <div class="right w-full flex flex-col grow min-w-80 overflow-y-auto">

        <livewire:layout.cpr-navigation />

        <div class="flex flex-col px-3 xl:px-6 mt-3">

            <div x-data="tabSwitch()">
                <ul class="flex flex-col lg:flex-row justify-center items-center my-4 gap-0 lg:gap-6">
                    <template x-for="(tab, index) in tabs" :key="index">
                        <li class="cursor-pointer pt-1 text-sky-800 border-b-2 text-center"
                            :class="activeTab===index ? 'text-sky-800 border-red-600' : 'text-slate-400 hover:text-sky-600 border-transparent '"
                            @click="activeTab = index"
                            x-text="tab"></li>
                    </template>
                    <li>
                        <button wire:click="addMember" title="Add new member/applicant" class="rounded-full bg-sky-700 text-white px-5 py-1 hover:bg-sky-600">
                            Add New
                        </button>
                    </li>
                </ul>

                <div class="w-full bg-white mx-auto border rounded-lg">
                    <div x-show="activeTab===0">
                        <livewire:component.active-members />
                    </div>
                    <div x-show="activeTab===1">
                        <livewire:component.accepted-applicants />
                    </div>
                    <div x-show="activeTab===2">
                        <livewire:component.pending-applicants :$pending_waiting_approval_count />
                    </div>
                    <div x-show="activeTab===3">
                        <livewire:component.declined-applicants />
                    </div>
                    <div x-show="activeTab===4">
                        <livewire:component.lapsed-members />
                    </div>
                </div>

            </div>
        </div>

{{--        <div class="flex flex-col p-3 xl:p-6 gap-5">--}}

{{--            <div>--}}
{{--                <h2 class="text-2xl text-sky-800 mb-2">--}}
{{--                    Members--}}
{{--                </h2>--}}
{{--                <div class="w-full flex grow flex-col gap-5">--}}
{{--                    <livewire:component.active-members />--}}
{{--                    <livewire:component.lapsed-members />--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div>--}}
{{--                <h2 class="text-2xl text-sky-800 mb-2">--}}
{{--                    Applicants--}}
{{--                </h2>--}}
{{--                <div class="w-full flex grow flex-col gap-5">--}}
{{--                    <livewire:component.accepted-applicants />--}}
{{--                    <livewire:component.pending-applicants />--}}
{{--                    <livewire:component.declined-applicants />--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>

<script>
    function tabSwitch() {
        return {
            activeTab: 0,
            tabs: [
                "Active Members [{{ $active_member_count }}]",
                "Accepted Applicants [{{ $accepted_applicant_count }}]",
                "Pending Applicants [{{ $pending_waiting_approval_count . '/' . $pending_applicant_count }}]",
                "Declined Applicants [{{ $blocked_applicant_count }}]",
                "Lapsed Members [{{ $lapsed_member_count }}]",
            ]
        };
    };
</script>

