<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gradient-to-br from-rose-100 via-indigo-100 to-sky-100 text-gray-700">

    <div class="min-h-screen flex flex-col">

        {{-- Navigacija --}}
        @include('layouts.navigation')

        {{-- Header --}}
        @isset($header)
            <header class="backdrop-blur-xl bg-white/50 border-b border-white/40 shadow-sm">
                <div class="max-w-7xl mx-auto py-6 px-6 lg:px-8">
                    <h1 class="text-2xl font-semibold text-indigo-700 drop-shadow-sm">
                        {{ $header }}
                    </h1>
                </div>
            </header>
        @endisset

        {{-- Sadržaj --}}
        <main class="flex-1 py-10 px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>

    </div>

</body>
</html>
