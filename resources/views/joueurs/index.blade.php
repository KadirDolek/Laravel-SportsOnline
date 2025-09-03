<!-- resources/views/joueurs/index.blade.php -->
<x-app-layout>
    {{-- Pas de header slot pour éviter la barre blanche du layout --}}

    <!-- En-tête sombre interne -->
    <div class="relative">
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-[#0b153a]/40 via-[#0a0f2b]/60 to-black/80"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-white drop-shadow">Liste des joueurs</h1>
            <p class="mt-2 text-gray-300">Filtre par genre, ouvre chaque profil, et gère les actions si autorisé.</p>
        </div>
    </div>

    <!-- Corps sombre -->
    <div class="bg-gradient-to-b from-black via-[#070b1f] to-[#050713] py-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @include('components.flash-messages')

            <!-- Barre d’actions / filtre -->
            <div class="mb-8 rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-5">
                <form method="GET" action="{{ route('joueurs.index') }}" class="flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="flex items-center gap-3">
                        <label for="genre" class="text-gray-200 text-sm uppercase tracking-wider">Filtrer par genre</label>
                        <select
                            name="genre"
                            id="genre"
                            onchange="this.form.submit()"
                            class="rounded-xl border border-white/20 bg-white/10 text-white px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:border-sky-400/70"
                        >
                            <option value="" class="bg-slate-800 text-white">Tous les genres</option>
                            @foreach($genres as $genre)
                                <option
                                    value="{{ $genre->id }}"
                                    {{ request('genre') == $genre->id ? 'selected' : '' }}
                                    class="bg-slate-800 text-white"
                                >
                                    {{ $genre->genre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex-1"></div>

                    @can('create-joueur')
                        <a
                            href="{{ route('joueurs.create') }}"
                            class="inline-flex items-center justify-center rounded-xl px-5 py-2.5 bg-sky-500/90 hover:bg-sky-400 text-white font-semibold shadow-lg shadow-sky-500/20 transition"
                        >
                            + Ajouter un joueur
                        </a>
                    @endcan
                </form>
            </div>

            <!-- Grille joueurs -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($joueurs as $joueur)
                    @php
                        $genreLib = strtolower($joueur->genre->genre ?? '');
                        $fallback = match (true) {
                            str_contains($genreLib, 'hom') || str_contains($genreLib, 'male') || $genreLib === 'm' => asset('img/male1.jpg'),
                            str_contains($genreLib, 'fem') || str_contains($genreLib, 'female') || $genreLib === 'f' => asset('img/femme1.jpg'),
                            default => asset('img/mixt1.jpg'),
                        };
                        $photo = $joueur->photo_url ?: $fallback;
                    @endphp

                    <div class="group rounded-2xl bg-white/5 border border-white/10 p-5 backdrop-blur hover:border-sky-500/40 hover:shadow-lg hover:shadow-sky-900/20 transition">
                        <!-- En-tête carte avec avatar rond -->
                        <div class="mb-3 flex items-start justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <img
                                    src="{{ $photo }}"
                                    alt="{{ $joueur->prenom }} {{ $joueur->nom }}"
                                    class="w-12 h-12 rounded-full object-cover ring-2 ring-white/20 group-hover:ring-sky-400/50 transition"
                                />
                                <div>
                                    <h3 class="text-lg font-bold text-white leading-tight">
                                        {{ $joueur->prenom }} {{ $joueur->nom }}
                                    </h3>
                                    <p class="text-sm text-gray-300">{{ $joueur->age }} ans</p>
                                    @if($joueur->user?->name)
                                        <p class="text-[11px] text-gray-400">Créé par : {{ $joueur->user->name }}</p>
                                    @endif
                                </div>
                            </div>

                            @if($joueur->is_reserve)
                                <span class="shrink-0 inline-flex items-center rounded-full px-2.5 py-0.5 text-[10px] font-bold bg-amber-300/90 text-amber-900">
                                    RÉSERVE
                                </span>
                            @endif
                        </div>

                        <div class="space-y-1.5 text-sm">
                            <p class="text-gray-400">
                                <span class="text-gray-300">Position :</span>
                                {{ $joueur->position->position }}
                            </p>
                            <p class="text-gray-400">
                                <span class="text-gray-300">Genre :</span>
                                {{ $joueur->genre->genre }}
                            </p>
                            <p class="text-gray-400">
                                <span class="text-gray-300">Équipe :</span>
                                @if($joueur->equipe)
                                    {{ $joueur->equipe->nom }}
                                @else
                                    <span class="text-red-400">Sans équipe</span>
                                @endif
                            </p>
                        </div>

                        <div class="mt-4 flex flex-wrap items-center gap-3">
                            <a
                                href="{{ route('joueurs.show', $joueur) }}"
                                class="inline-flex items-center gap-1 rounded-lg px-3 py-1.5 text-sky-400 hover:text-sky-300 font-medium"
                            >
                                Voir profil
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            @can('manage-joueur', $joueur)
                                <a
                                    href="{{ route('joueurs.edit', $joueur) }}"
                                    class="inline-flex items-center gap-1 rounded-lg px-3 py-1.5 text-emerald-300 hover:text-emerald-200 font-medium"
                                >
                                    Modifier
                                </a>

                                <form action="{{ route('joueurs.destroy', $joueur) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce joueur ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="inline-flex items-center gap-1 rounded-lg px-3 py-1.5 text-red-300 hover:text-red-200 font-medium"
                                    >
                                        Supprimer
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>

            @if($joueurs->isEmpty())
                <p class="text-center text-gray-400 mt-10">Aucun joueur trouvé.</p>
            @endif

            @if(method_exists($joueurs, 'links'))
                <div class="mt-8">
                    <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-3 text-center">
                        {{ $joueurs->onEachSide(1)->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
