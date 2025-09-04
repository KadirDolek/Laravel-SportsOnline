<!DOCTYPE html>
<html lang="{{ str_replace('', '-', app()->getLocale()) }}">
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
    <body class="font-sans antialiased">
        <div class="min-h-screen relative isolate bg-gradient-to-b from-black via-[#070b1f] to-[#050713]">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 pt-10 sm:pt-16 flex flex-col items-center">
                <a href="/" class="group">
                    <x-application-logo class="w-20 h-20 text-sky-400 group-hover:text-sky-300 transition" />
                </a>
                <p class="mt-3 text-sky-400 uppercase tracking-widest text-sm">Sports Online</p>
                <div
                    class="w-full sm:max-w-md mt-6 p-6 sm:p-8
                           rounded-xl bg-white/5 border border-white/10 shadow-lg backdrop-blur
                           text-gray-200
                           [&label]:text-gray-200
                           [&.text-gray-700]:!text-gray-200
                           [&_.text-gray-600]:!text-gray-300
                           [&_input]:bg-white/10 [&_input]:border-white/20 [&_input]:text-white [&_input]:placeholder-gray-400
                           [&_select]:bg-white/10 [&_select]:border-white/20 [&_select]:text-white
                           [&_textarea]:bg-white/10 [&_textarea]:border-white/20 [&_textarea]:text-white
                           [&_a]:text-sky-400 hover:[&_a]:text-sky-300
                           [&_button]:bg-sky-500/90 hover:[&_button]:bg-sky-400 [&_button]:text-white
                           [&_button]:shadow-lg [&_button]:shadow-sky-500/20
                           transition">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
