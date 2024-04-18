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
    </head>
    <body>
        <livewire:layout.header />
        <livewire:layout.navigation />
        {{ $slot }}
        <livewire:layout.footer />
        @livewire('wire-elements-modal')
    </body>
</html>
