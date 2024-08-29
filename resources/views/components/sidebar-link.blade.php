@props(['active', 'icon'])

@php
    $classes = 'inline-flex items-center py-3 lg:py-2 my-1 lg:my-0 font-medium border-l-2 border-transparent focus:outline-none ';
    $classes .= ($active ?? false)
                ? ' text-cyan-200 border-l-cyan-400 focus:border-indigo-700'
                : ' text-slate-200 hover:text-white hover:border-b-cyan-400 hover:bg-slate-800 focus:text-cyan-300 focus:border-gray-300 active:cursor-wait transition duration-150 ease-in-out';

    $icon_classes = 'w-6 h-6 mx-3 bg-transparent';
    $icon_classes .= ($active ?? false)
                    ? ' text-cyan-300'
                    : ' text-slate-200';
//    $active_icon_class = ($active ?? false) ? 'visible' : 'hidden';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @isset($icon)
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="1.5" stroke="currentColor" {{ $attributes->merge(['class' => $icon_classes]) }}>
            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}" />
        </svg>
    @endisset
    <span class="transition ease-in delay-1000" :class="{'hidden pr-0' : !sidebar_open, 'block pr-4' : sidebar_open }">
        {{ $slot }}
    </span>
</a>
