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

            <!-- Settings Dropdown (RESTYLÉ: profil, admin, logout) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown
                        align="right"
                        width="56"
                        contentClasses="p-2 bg-white/5 backdrop-blur rounded-2xl border border-white/10 shadow-2xl shadow-sky-900/30"
                    >
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center gap-3 px-3 py-2 text-sm rounded-xl text-white/90 hover:text-white
                                       hover:bg-white/10 border border-white/10 hover:border-white/20 transition"
                            >
                                <!-- Avatar rond avec initiale -->
                                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full
                                             bg-gradient-to-br from-sky-500/30 to-indigo-500/30
                                             ring-1 ring-white/20 text-white font-semibold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>

                                <div class="flex items-center gap-2">
                                    <div class="font-medium">{{ Auth::user()->name }}</div>

                                    @can('is-admin')
                                        <span class="text-[10px] uppercase tracking-wider px-2 py-0.5 rounded-full
                                                     bg-white/10 border border-white/15 text-amber-300/90">
                                            Admin
                                        </span>
                                    @endcan
                                </div>

                                <svg class="ms-1 h-4 w-4 text-white/70" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5.23 7.21a.75.75 0 011.06.02L10 11.19l3.71-3.96a.75.75 0 111.08 1.04l-4.24 4.53a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Carte utilisateur -->
                            <div class="px-3 py-3 rounded-xl bg-white/5 border border-white/10 mb-2">
                                <div class="flex items-center gap-3">
                                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-full
                                                 bg-gradient-to-br from-sky-500/30 to-indigo-500/30
                                                 ring-1 ring-white/20 text-white font-bold">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </span>
                                    <div class="min-w-0">
                                        <div class="text-white font-semibold truncate">{{ Auth::user()->name }}</div>
                                        <div class="text-white/70 text-xs truncate">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="my-1 h-px bg-white/10"></div>

                            <!-- Profil -->
                            <x-dropdown-link
                                :href="route('profile.edit')"
                                class="group flex items-center gap-2 px-3 py-2 rounded-lg text-gray-100
                                       hover:bg-white/10 transition"
                            >
                                <svg class="w-4 h-4 opacity-80 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5.121 17.804A4 4 0 019 16h6a4 4 0 013.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ __('Profil') }}
                            </x-dropdown-link>

                            <!-- Lien Administration si admin -->
                            @can('is-admin')
                                <x-dropdown-link
                                    :href="route('admin.users.index')"
                                    class="group flex items-center gap-2 px-3 py-2 rounded-lg text-amber-200
                                           hover:bg-amber-400/10 hover:text-amber-100 transition"
                                >
                                    <svg class="w-4 h-4 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l.796 2.455a1 1 0 00.95.69h2.58c.969 0 1.371 1.24.588 1.81l-2.09 1.52a1 1 0 00-.364 1.118l.796 2.455c.3.921-.755 1.688-1.54 1.118l-2.09-1.52a1 1 0 00-1.176 0l-2.09 1.52c-.784.57-1.838-.197-1.54-1.118l.797-2.455a1 1 0 00-.365-1.118l-2.09-1.52c-.783-.57-.38-1.81.588-1.81h2.58a1 1 0 00.95-.69l.796-2.455z"/>
                                    </svg>
                                    {{ __('Administration') }}
                                </x-dropdown-link>
                            @endcan

                            <div class="my-1 h-px bg-white/10"></div>

                            <!-- Déconnexion (destructive) -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link
                                    :href="route('logout')"
                                    class="group flex items-center gap-2 px-3 py-2 rounded-lg
                                           text-red-300 hover:text-red-200 hover:bg-red-500/10 transition"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                >
                                    <svg class="w-4 h-4 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1"/>
                                    </svg>
                                    {{ __('Se déconnecter') }}
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

        <!-- Responsive Settings Options (RESTYLÉ) -->
        @auth
            <div class="pt-4 pb-1 border-t border-white/10">
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-white/70">{{ Auth::user()->email }}</div>
                    @can('is-admin')
                        <div class="mt-1 text-[10px] uppercase tracking-wider inline-flex px-2 py-0.5 rounded-full
                                    bg-white/10 border border-white/15 text-amber-300/90">Admin</div>
                    @endcan
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-white/90">
                        {{ __('Profil') }}
                    </x-responsive-nav-link>

                    @can('is-admin')
                        <x-responsive-nav-link :href="route('admin.users.index')" class="text-amber-100 hover:bg-amber-400/10">
                            {{ __('Administration') }}
                        </x-responsive-nav-link>
                    @endcan

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link
                            :href="route('logout')"
                            class="text-red-300 hover:text-red-200 hover:bg-red-500/10"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                        >
                            {{ __('Se déconnecter') }}
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
