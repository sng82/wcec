@props(['messages'])

{{--@if ($messages)--}}
{{--    <ul {{ $attributes->merge(['class' => 'error text-white space-y-1']) }}>--}}
{{--        @foreach ((array) $messages as $message)--}}
{{--            <li class="bg-red-500 border-red-600 px-4 py-2 rounded-lg flex flex-row items-center gap-2 w-fit">--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 min-w-8">--}}
{{--                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />--}}
{{--                </svg>--}}
{{--                <span class="font-semibold">Error: </span>--}}
{{--                {{ $message }}--}}
{{--            </li>--}}
{{--        @endforeach--}}
{{--    </ul>--}}
{{--@endif--}}

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'error text-white space-y-1']) }}>
        @foreach ((array) $messages as $message)
            @if(is_array($message))
                @foreach($message as $m)
                    <li class="bg-red-500 border-red-600 px-4 py-2 rounded-lg flex flex-row items-center gap-2 w-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 min-w-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                        {{ $m }}
                    </li>
                @endforeach
            @else
                <li class="bg-red-500 border-red-600 px-4 py-2 rounded-lg flex flex-row items-center gap-2 w-fit">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 min-w-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                    {{ $message }}
                </li>
            @endif
        @endforeach
    </ul>
@endif
