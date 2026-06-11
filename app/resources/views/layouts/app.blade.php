<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="has-navbar-fixed-top">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body>
        <div class="app">
            <livewire:navigation />

            <section class="section">
                {{ $slot }}
            </section>

            <livewire:footer />

        </div>

        @livewireScripts
    </body>
</html>
