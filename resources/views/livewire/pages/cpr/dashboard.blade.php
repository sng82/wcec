<div>

    @if(session('success'))
        <span class="text-green-500 text-xs">{{ session('success') }}</span>
    @endif

    @if(session('error'))
        <div class="w-full font-bold bg-amber-500 rounded-2xl my-6 text-amber-700 p-5">
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="flex justify-between gap-12 p-12">
        <div class="bg-slate-100 rounded-lg grow p-6">
{{--            Hi, {{ Auth::user()->first_name }}--}}

            @if(Auth::user()->account_type === 'admin')
                <livewire:cpr.submission-dates />
                <livewire:cpr.prices />
            @endif
        </div>
        <div class="bg-white rounded-lg w-96 p-6">
            <h2>My Details</h2>
            <p>Name: {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</p>
            <p>Email: {{ Auth::user()->email }}</p>
            <p>Account Type: {{ Str::headline(Auth::user()->account_type) }}</p>
        </div>

    </div>
</div>
