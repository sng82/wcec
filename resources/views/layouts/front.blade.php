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
{{--                @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
    </head>
    <body>
        <livewire:layout.header />
        <livewire:layout.navigation />
        {{ $slot }}
        <livewire:layout.footer />
        @livewire('wire-elements-modal')
    </body>
</html>
