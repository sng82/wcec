<div class="flex h-full w-full overflow-y-auto">

    <livewire:cpr.sidebar/>

    <div class="right w-full flex flex-col grow overflow-y-auto">

        <livewire:layout.cpr-navigation />

        <div class="flex flex-col p-6 gap-5">

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
</div>

