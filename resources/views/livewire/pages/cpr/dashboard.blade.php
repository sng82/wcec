<div class="flex flex-grow">

    <livewire:cpr.sidebar />

    <div class="flex flex-col grow p-6 gap-5">

        <div class="flex flex-col content-center mt-8 mb-6">
            <img src="{{ Vite::asset('resources/img/wcec-crest-updated.webp') }}" class="inline-block object-contain h-30 lg:h-[200px]" alt="WCEC Logo">
            <h2 class="text-center mx-auto mt-6 text-sky-900 text-2xl border-b-4 border-red-700 pb-2">Chartered Practitioners Portal</h2>
        </div>

        @if(session('success'))
            <div class="w-full font-bold bg-green-100 rounded-2xl text-green-600 px-5 py-2">
                <span class="text-sm">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="w-full font-bold bg-red-200 rounded-2xl text-red-700 px-5 py-2">
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="w-full font-bold bg-red-200 rounded-2xl text-red-700 px-5 py-2">
            <span class="text-sm">Dummy Error</span>
        </div>

        <div class="w-full font-bold bg-green-100 rounded-2xl text-green-700 px-5 py-2">
            <span class="text-sm">Dummy Success</span>
        </div>

        @if(Auth::user()->account_type === 'admin')

            <div class="bg-slate-50 rounded-lg p-6 shadow">
                <p class="mb-4">
                    Hi, {{ Auth::user()->first_name }},
                </p>
                <p>
                    The next Submission Date is
                    <span class="font-bold">{{ $nextSubmissionDate }}</span>
                    ({{ $nextSubmissionDateDifference }}).
                </p>
            </div>

        @endif


    </div>

</div>
