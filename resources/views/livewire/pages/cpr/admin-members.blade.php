<div class="flex h-full w-full overflow-hidden">

    <livewire:cpr.sidebar/>

    <div class="right w-full flex grow flex-col p-6 gap-8 overflow-y-auto">

        <div>
            <h2 class="text-2xl text-sky-800 mb-2">
                Members
            </h2>
            <div class="w-full flex grow flex-col gap-5">
                <livewire:component.active-members
{{--                    :$active_members --}}
                />
                <livewire:component.lapsed-members :$lapsed_members />
            </div>

        </div>

        <div>
            <h2 class="text-2xl text-sky-800 mb-2">
                Applicants
            </h2>
            <div class="w-full flex grow flex-col gap-5">
                <livewire:component.accepted-applicants :$accepted_applicants />
                <livewire:component.pending-applicants :$applicants />
                <livewire:component.declined-applicants :$blocked_applicants />
            </div>
        </div>


    </div>
</div>

