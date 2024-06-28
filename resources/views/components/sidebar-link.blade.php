@props(['active', 'icon'])

@php
    $classes = 'inline-flex items-center py-2 font-medium border-l-2 border-transparent focus:outline-none ';
    $classes .= ($active ?? false)
                ? ' text-cyan-100 border-l-cyan-400 focus:border-indigo-700'
                : ' text-slate-200 hover:text-white hover:border-b-cyan-400 hover:bg-slate-500 focus:text-gray-700 focus:border-gray-300 active:cursor-wait transition duration-150 ease-in-out';

    $active_icon_class = ($active ?? false) ? 'visible' : 'hidden';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @isset($icon)
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}" />
        </svg>
    @endisset
    <span class="transition ease-in delay-1000" :class="{'hidden pr-0' : !sidebar_open, 'block pr-4' : sidebar_open }">
        {{ $slot }}
    </span>
</a>
