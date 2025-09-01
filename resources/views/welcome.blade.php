<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gradient-to-b from-slate-500 to-black text-[#1b1b18] min-h-screen flex flex-col">
        
        {{-- Header collé en haut --}}
        <header class="w-full border-b border-gray-200 dark:border-gray-800 bg-gradient-to-t from-slate-500 to-black">
            <div class="max-w-6xl mx-auto flex items-center justify-between px-6 py-4">
                {{-- Logo ou titre du site --}}
                <a href="{{ url('/') }}" class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">
                    SportOnline
                </a>

                {{-- Navigation --}}
                @if (Route::has('login'))
                    <nav class="flex items-center gap-3">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="px-4 py-2 text-sm font-medium text-white bg-[#1b1b18] dark:bg-[#3E3E3A] rounded-md hover:bg-[#2a2a24] dark:hover:bg-[#62605b] transition-colors"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="px-4 py-2 text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] border border-gray-300 dark:border-[#3E3E3A] rounded-md hover:bg-gray-100 dark:hover:bg-[#2c2c29] transition-colors"
                            >
                                Se connecter
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="px-4 py-2 text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] border border-gray-300 dark:border-[#3E3E3A] rounded-md hover:bg-gray-100 dark:hover:bg-[#2c2c29] transition-colors"
                                >
                                    Inscription
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        {{-- Contenu principal --}}
        <main class="flex-1 max-w-6xl mx-auto px-6 py-8">
            <section>
                <h2 class="text-2xl font-semibold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Home</h2>
                
            </section>
        </main>

        {{-- Footer optionnel --}}
        <footer class="w-full border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-[#1b1b18]">
            <div class="max-w-6xl mx-auto px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                © {{ date('Y') }} SportOnline. Tous droits réservés.
            </div>
        </footer>

    </body>
</html>
