@props([
    'logged_in_user',
    'next_admission_date',
])

<div {{ $attributes->class(['bg-slate-50 rounded-lg p-3 xl:p-4 pb-4 mb-4 xl:mb-6 shadow-md shadow-slate-300']) }}>
    <p class="my-2">
        Hi, {{ explode(" ", $logged_in_user->first_name)[0] }},
    </p>
    <p class="mb-2">
        Your application to join the register has been accepted. You will be admitted on the next admission date: <span class="font-bold">{{ $next_admission_date ?? '' }}</span>.
    </p>
</div>


