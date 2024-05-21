<div class="flex h-full w-full overflow-hidden">

    <livewire:cpr.sidebar/>

    <div class="right w-full flex grow flex-col p-6 gap-8 overflow-y-auto">

        <div>
            <h2 class="text-2xl text-sky-800 mb-2">
                Members
            </h2>
            <div class="w-full flex grow flex-col gap-5">
                <livewire:component.active-members />
                <livewire:component.lapsed-members />
            </div>
        </div>

        <div>
            <h2 class="text-2xl text-sky-800 mb-2">
                Applicants
            </h2>
            <div class="w-full flex grow flex-col gap-5">
                <livewire:component.accepted-applicants />
                <livewire:component.pending-applicants />
                <livewire:component.declined-applicants />
            </div>
        </div>

    </div>
</div>

