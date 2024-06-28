<div class="mx-6 my-6">
    <div class="mb-4">
        <h1 class="text-3xl">
            Expression of Interest
        </h1>
    </div>
    <div class="mb-6 text-lg">
        Applicant Name: {{ $applicant->first_name . ' ' . $applicant->last_name }}
    </div>

    <div class="mb-1">
        Current Role:
    </div>
    <div class="mb-6 border border-slate-300 trix-block px-3 py-6">
        {!! str($eoi->current_role)->replace('<h1>', '<h2 class="text-2xl">')->replace('</h1>', '</h2>') !!}
    </div>

    <div class="mb-1">
        Employment History:
    </div>
    <div class="mb-6 border border-slate-300 trix-block px-3 py-6">
        {!! str($eoi->employment_history)->replace('<h1>', '<h2 class="text-2xl">')->replace('</h1>', '</h2>') !!}
    </div>

    <div class="mb-1">
        Qualifications:
    </div>
    <div class="mb-6 border border-slate-300 trix-block px-3 py-6">
        {!! str($eoi->qualifications)->replace('<h1>', '<h2 class="text-2xl">')->replace('</h1>', '</h2>') !!}
    </div>

    <div class="mb-1">
        Training:
    </div>
    <div class="mb-6 border border-slate-300 trix-block px-3 py-6">
        {!! str($eoi->training)->replace('<h1>', '<h2 class="text-2xl">')->replace('</h1>', '</h2>') !!}
    </div>
</div>
