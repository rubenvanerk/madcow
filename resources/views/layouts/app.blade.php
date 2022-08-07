<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased h-full">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <div class="min-h-full">
                <div class="py-10">
                    @if(isset($header))
                        <header>
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                <h1 class="text-3xl font-bold leading-tight text-gray-900">{{ $header }}</h1>
                            </div>
                        </header>
                    @endif

                    <!-- Page Content -->
                    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        {{ $slot }}
                    </main>
                </div>
            </div>

        </div>

        @livewireScripts
    </body>
</html>
