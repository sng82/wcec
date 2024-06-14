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
{{--        @vite(['resources/scss/app.scss', 'resources/scss/cpr.scss', 'resources/js/app.js'])--}}

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
    <body class="cpp flex flex-col h-screen bg-slate-200 overflow-hidden">

    {{--    <body x-data="{ sidebar_open: $persist(true) }" class="cpp flex flex-col h-screen bg-slate-200 overflow-hidden">--}}
{{--        <livewire:layout.cpr-navigation />--}}
        {{ $slot }}

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <x-livewire-alert::scripts />

    </body>
</html>
