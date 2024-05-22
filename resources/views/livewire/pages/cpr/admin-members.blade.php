<div class="flex h-full w-full overflow-y-auto">

    <livewire:cpr.sidebar/>

    <div class="right w-full flex flex-col grow min-w-80 overflow-y-auto">

        <livewire:layout.cpr-navigation />

        <div class="flex flex-col p-3 xl:p-6 ">

            <div x-data="tabSwitch()">
                <ul class="flex flex-col lg:flex-row justify-start items-center my-4 gap-4">
                    <template x-for="(tab, index) in tabs" :key="index">
                        <li class="cursor-pointer py-2 text-gray-500 border-b-4"
                            :class="activeTab===index ? 'text-cyan-600 border-cyan-400' : 'border-slate-300'" @click="activeTab = index"
                            x-text="tab"></li>
                    </template>
                </ul>

                <div class="w-full bg-white  mx-auto border rounded-lg">
                    <div x-show="activeTab===0">
                        <livewire:component.active-members />
                    </div>
                    <div x-show="activeTab===1">
                        <livewire:component.lapsed-members />
                    </div>
                    <div x-show="activeTab===2">
                        <livewire:component.accepted-applicants />
                    </div>
                    <div x-show="activeTab===3">
                        <livewire:component.pending-applicants />
                    </div>
                    <div x-show="activeTab===4">
                        <livewire:component.declined-applicants />
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
                "Active Members",
                "Lapsed Members",
                "Accepted Applicants",
                "Pending Applicants",
                "Declined Applicants",
            ]
        };
    };
</script>

