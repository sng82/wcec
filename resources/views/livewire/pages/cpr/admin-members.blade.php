<div class="flex h-full w-full overflow-y-auto">

    <livewire:cpr.sidebar/>

    <div class="right w-full flex flex-col grow min-w-80 overflow-y-scroll">

{{--        <livewire:layout.cpr-navigation />--}}

        <div class="flex flex-col px-3 xl:px-6">

            <div x-data="tabSwitch()">
                <ul class="flex flex-col xl:flex-row justify-center items-center my-6 gap-0 xl:gap-3 2xl:gap-8">
                    <template x-for="(tab, index) in tabs" :key="index">
                        <li class="cursor-pointer pt-1 text-sky-800 border-b-2 text-center"
                            :class="activeTab === index ? 'text-sky-800 border-red-600' : 'text-slate-400 hover:text-sky-600 border-transparent '"
                            @click="activeTab = index"
                            x-text="tab"></li>
                    </template>
                    <li>
                        <button wire:click="addMember" title="Add new registrant/applicant" class="rounded-full bg-sky-700 text-white px-5 py-1 hover:bg-sky-600">
                            Add&nbsp;New
                        </button>
                    </li>
                </ul>

                <div class="">
                    <div x-show="activeTab===0">
                        <livewire:component.active-registrants />
                    </div>
                    <div x-show="activeTab===1">
                        <livewire:component.accepted-applicants />
                    </div>
                    <div x-show="activeTab===2">
                        <livewire:component.pending-applicants
                            :$pending_waiting_approval_count
                            :$pending_eoi_submitted_count
                            :$pending_applicant_count
                        />
                    </div>
                    <div x-show="activeTab===3">
                        <livewire:component.declined-applicants />
                    </div>
                    <div x-show="activeTab===4">
                        <livewire:component.lapsed-registrants />
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    function tabSwitch() {
        return {
            activeTab: 0,
            tabs: [
                "Active Registrants [{{ $active_registrant_count }}]",
                "Accepted Applicants [{{ $accepted_applicant_count }}]",
                "Pending Applicants [{{ $pending_applicant_count . '/' . $pending_eoi_submitted_count . '/' . $pending_waiting_approval_count }}]",
                "Declined Applicants [{{ $blocked_applicant_count }}]",
                "Lapsed Registrants [{{ $lapsed_registrant_count }}]",
            ]
        };
    }
</script>
