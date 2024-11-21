<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>WCEC EOI</title>
{{--        @vite(['resources/scss/app.scss', 'resources/js/app.js'])--}}
        @vite(['resources/scss/app.scss', 'resources/scss/cpr.scss', 'resources/js/app.js'])
    </head>
    <body class="">
        {{ $slot }}
    </body>
</html>
