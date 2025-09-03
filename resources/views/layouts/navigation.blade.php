<!-- resources/views/layouts/navigation.blade.php -->
<nav x-data="{ open: false }"
     class="fixed top-0 inset-x-0 z-50 bg-[#030617]/95 backdrop-blur border-b border-white/10 text-white shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto text-white" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-white/80 hover:text-white">
                        {{ __('Accueil') }}
                    </x-nav-link>
                    <x-nav-link :href="route('equipes.index')" :active="request()->routeIs('equipes.index')" class="text-white/80 hover:text-white">
                        {{ __('Équipes') }}
                    </x-nav-link>
                    <x-nav-link :href="route('joueurs.index')" :active="request()->routeIs('joueurs.index')" class="text-white/80 hover:text-white">
                        {{ __('Joueurs') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48" contentClasses="py-1 bg-[#0b153a] text-white border border-white/10">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm rounded-md text-white/80 hover:text-white">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5.23 7.21a.75.75 0 011.06.02L10 11.19l3.71-3.96a.75.75 0 111.08 1.04l-4.24 4.53a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z"/>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="hover:bg-white/10">Profile</x-dropdown-link>

                            @can('is-admin')
                                <x-dropdown-link :href="route('admin.users.index')" class="hover:bg-white/10">Administration</x-dropdown-link>
                            @endcan

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="hover:bg-white/10"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="hidden space-x-6 sm:flex">
                        <x-nav-link :href="route('login')" class="text-white/80 hover:text-white">Login</x-nav-link>
                        <x-nav-link :href="route('register')" class="text-white/80 hover:text-white">Register</x-nav-link>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="p-2 rounded-md text-white/70 hover:text-white hover:bg-white/10 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#030617]/95 border-t border-white/10">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-white/90">
                {{ __('Accueil') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('equipes.index')" :active="request()->routeIs('equipes.index')" class="text-white/90">
                {{ __('Équipes') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('joueurs.index')" :active="request()->routeIs('joueurs.index')" class="text-white/90">
                {{ __('Joueurs') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-white/10">
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-white/70">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-white/90">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" class="text-white/90"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-white/10">
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')" class="text-white/90">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" class="text-white/90">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        @endauth
    </div>
</nav>
