<!-- resources/views/equipes/index.blade.php -->
<x-app-layout>
    {{-- Pas de header slot pour éviter la barre blanche du layout --}}

    <!-- En-tête sombre interne -->
    <div class="relative">
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-[#0b153a]/40 via-[#0a0f2b]/60 to-black/80"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-white drop-shadow">Liste des équipes</h1>
            <p class="mt-2 text-gray-300">Filtre par continent, ouvre chaque fiche et gère les clubs (si autorisé).</p>
        </div>
    </div>

    <!-- Corps sombre -->
    <div class="bg-gradient-to-b from-black via-[#070b1f] to-[#050713] py-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @include('components.flash-messages')

            <!-- Barre d’actions / filtre -->
            <div class="mb-8 rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-5">
                <form method="GET" action="{{ route('equipes.index') }}" class="flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="flex items-center gap-3">
                        <label for="continent" class="text-gray-200 text-sm uppercase tracking-wider">Filtrer par continent</label>
                        <select
                            name="continent"
                            id="continent"
                            onchange="this.form.submit()"
                            class="rounded-xl border border-white/20 bg-white/10 text-white px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:border-sky-400/70"
                        >
                            <option value="" class="bg-slate-800 text-white">Tous les continents</option>
                            @foreach($continents as $continent)
                                <option
                                    value="{{ $continent->id }}"
                                    {{ request('continent') == $continent->id ? 'selected' : '' }}
                                    class="bg-slate-800 text-white"
                                >
                                    {{ $continent->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex-1"></div>

                    @can('is-staff')
                        <a
                            href="{{ route('equipes.create') }}"
                            class="inline-flex items-center justify-center rounded-xl px-5 py-2.5 bg-sky-500/90 hover:bg-sky-400 text-white font-semibold shadow-lg shadow-sky-500/20 transition"
                        >
                            + Ajouter une équipe
                        </a>
                    @endcan
                </form>
            </div>

            <!-- Grille équipes -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($equipes as $equipe)
                    @php
                        $logo = $equipe->logo_url ?? asset('img/logo.jpg');
                    @endphp
                    <div class="group rounded-2xl bg-white/5 border border-white/10 p-5 backdrop-blur hover:border-sky-500/40 hover:shadow-lg hover:shadow-sky-900/20 transition">
                        <!-- Header: avatar + titre + badge genre -->
                        <div class="mb-3 flex items-start justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <img
                                    src="{{ $logo }}"
                                    alt="Logo {{ $equipe->nom }}"
                                    class="w-12 h-12 rounded-full object-cover ring-2 ring-white/20 group-hover:ring-sky-400/50 transition"
                                />
                                <div>
                                    <h3 class="text-lg font-bold text-white leading-tight">{{ $equipe->nom }}</h3>
                                    <p class="text-sm text-gray-300">{{ $equipe->ville }}, {{ $equipe->pays }}</p>
                                </div>
                            </div>

                            @if($equipe->genre?->genre)
                                <span class="shrink-0 inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold bg-white/10 border border-white/15 text-gray-200">
                                    {{ $equipe->genre->genre }}
                                </span>
                            @endif
                        </div>

                        <!-- Meta -->
                        <div class="space-y-1.5 text-sm">
                            <p class="text-gray-400">
                                <span class="text-gray-300">Continent :</span>
                                {{ $equipe->continent->nom }}
                            </p>
                            @if($equipe->user?->name)
                                <p class="text-gray-400">
                                    <span class="text-gray-300">Entraîneur :</span>
                                    {{ $equipe->user->name }}
                                </p>
                            @endif
                            <p class="text-gray-400">
                                <span class="text-gray-300">Joueurs :</span>
                                {{ $equipe->joueurs->count() }}
                            </p>
                        </div>

                        <!-- Actions -->
                        <div class="mt-4 flex flex-wrap items-center gap-3">
                            <a
                                href="{{ route('equipes.show', $equipe) }}"
                                class="inline-flex items-center gap-1 rounded-lg px-3 py-1.5 text-sky-400 hover:text-sky-300 font-medium"
                            >
                                Voir détails
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            @can('manage-equipe', $equipe)
                                <a
                                    href="{{ route('equipes.edit', $equipe) }}"
                                    class="inline-flex items-center gap-1 rounded-lg px-3 py-1.5 text-emerald-300 hover:text-emerald-200 font-medium"
                                >
                                    Modifier
                                </a>

                                @if(auth()->user()->role === 'admin' ||
                                    (auth()->user()->role === 'coach' && $equipe->user_id === auth()->id()))
                                    <form action="{{ route('equipes.destroy', $equipe) }}" method="POST" class="inline-block"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette équipe ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="inline-flex items-center gap-1 rounded-lg px-3 py-1.5 text-red-300 hover:text-red-200 font-medium"
                                        >
                                            Supprimer
                                        </button>
                                    </form>
                                @endif
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>

            @if($equipes->isEmpty())
                <p class="text-center text-gray-400 mt-10">Aucune équipe trouvée.</p>
            @endif

            @if(method_exists($equipes, 'links'))
                <div class="mt-8">
                    <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-3 text-center">
                        {{ $equipes->onEachSide(1)->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
