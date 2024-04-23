<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ isset($title) ? 'WCEC : ' . $title : 'WCEC' }}</title>
        @isset($description)
            <meta name="description" content="{{ $description}}">
        @endisset
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
        @if (Str::startsWith($current = url()->current(), 'https://www.'))
            <link rel="canonical" href="{{ str_replace('https://www.', 'https://', $current) }}">
        @else
            <link rel="canonical" href="{{ $current }}">
        @endif
        <link rel="apple-touch-icon" sizes="180x180" href="/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/icons/favicon-16x16.png">
        <link rel="manifest" href="/icons/site.webmanifest">
        <link rel="mask-icon" href="/icons/safari-pinned-tab.svg" color="#3C4D8E">
        <link rel="shortcut icon" href="/icons/favicon.ico">
        <meta name="msapplication-TileColor" content="#2b5797">
        <meta name="msapplication-config" content="/icons/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body class="font-sans text-gray-900 antialiased">
{{--        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-100">--}}
{{--            <div>--}}
{{--                <a href="/" wire:navigate>--}}
{{--                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--                </a>--}}
{{--            </div>--}}
            <livewire:layout.header />
            <livewire:layout.navigation />

            <div class="flex flex-wrap flex-col content-center w-full bg-slate-100 sm:py-44">
                <div class="w-full sm:max-w-md sm:my-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>

            <livewire:layout.footer />
{{--        </div>--}}
    </body>
</html>
