@props(['active'])

@php
    $classes = 'inline-flex items-center pt-2 font-medium border-2 border-transparent focus:outline-none ';
    $classes .= ($active ?? false)
                ? 'text-white border-b-red-600 focus:border-indigo-700'
                : 'text-slate-300 hover:text-white hover:border-b-sky-700 focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
