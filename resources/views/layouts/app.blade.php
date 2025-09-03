<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#030617"/>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-b from-black via-[#070b1f] to-[#050713] text-white scroll-smooth">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Page Heading (optionnel) -->
        @if (isset($header))
            <header class="border-b border-white/10 bg-[#030617]/60 backdrop-blur">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="text-white">
                        {{ $header }}
                    </div>
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="pt-16">
            {{ $slot }}
        </main>

        @include('layouts.footer')
    </div>
</body>
</html>
