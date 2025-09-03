<!-- resources/views/joueurs/show.blade.php -->
<x-app-layout>
    {{-- Pas de header slot pour éviter la barre blanche du layout --}}

    <!-- En-tête sombre interne -->
    <div class="relative">
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-[#0b153a]/40 via-[#0a0f2b]/60 to-black/80"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-white drop-shadow">Profil du joueur</h1>
            <p class="mt-2 text-gray-300">Détails, équipe et contact.</p>
        </div>
    </div>

    @php
        $genreLib = strtolower(optional($joueur->genre)->genre ?? '');
        $fallback = match (true) {
            str_contains($genreLib, 'hom') || str_contains($genreLib, 'male') || $genreLib === 'm' => asset('img/male1.jpg'),
            str_contains($genreLib, 'fem') || str_contains($genreLib, 'female') || $genreLib === 'f' => asset('img/femme1.jpg'),
            default => asset('img/mixt1.jpg'),
        };
        $photo = $joueur->photo_url ?: $fallback;
    @endphp

    <!-- Corps sombre -->
    <div class="bg-gradient-to-b from-black via-[#070b1f] to-[#050713] py-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @include('components.flash-messages')

            <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur">
                <!-- Header du profil -->
                <div class="px-6 py-6 border-b border-white/10">
                    <div class="flex flex-col md:flex-row md:items-center gap-6">
                        <!-- Avatar rond -->
                        <div class="relative shrink-0">
                            <img
                                src="{{ $photo }}"
                                alt="{{ $joueur->prenom }} {{ $joueur->nom }}"
                                class="w-28 h-28 md:w-32 md:h-32 rounded-full object-cover ring-2 ring-white/20 shadow-xl"
                            />
                            @if($joueur->is_reserve)
                                <span class="absolute -bottom-1 -right-1 text-[10px] px-2 py-0.5 rounded-full bg-amber-300/90 text-amber-900 font-bold shadow">
                                    RÉSERVE
                                </span>
                            @endif
                        </div>

                        <!-- Nom + chips -->
                        <div class="flex-1">
                            <h2 class="text-2xl md:text-3xl font-extrabold text-white leading-tight">
                                {{ $joueur->prenom }} {{ $joueur->nom }}
                            </h2>

                            <div class="mt-3 flex flex-wrap gap-2">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-white/10 border border-white/15 text-gray-100">
                                    {{ $joueur->age }} ans
                                </span>

                                @if($joueur->position?->position)
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-white/10 border border-white/15 text-gray-100">
                                    {{ $joueur->position->position }}
                                </span>
                                @endif

                                @if($joueur->genre?->genre)
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-white/10 border border-white/15 text-gray-100">
                                    {{ $joueur->genre->genre }}
                                </span>
                                @endif

                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-white/10 border border-white/15 text-gray-100">
                                    {{ $joueur->pays }}
                                </span>

                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-white/10 border border-white/15 text-gray-100">
                                    @if($joueur->equipe)
                                        <a href="{{ route('equipes.show', $joueur->equipe) }}" class="hover:text-sky-300">
                                            {{ $joueur->equipe->nom }}
                                        </a>
                                    @else
                                        Sans équipe
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Infos détaillées -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="rounded-xl border border-white/10 bg-white/5 p-5">
                            <h3 class="text-white font-semibold mb-3">Identité</h3>
                            <ul class="space-y-2 text-sm">
                                <li class="text-gray-300"><span class="text-gray-400">Prénom :</span> {{ $joueur->prenom }}</li>
                                <li class="text-gray-300"><span class="text-gray-400">Nom :</span> {{ $joueur->nom }}</li>
                                <li class="text-gray-300"><span class="text-gray-400">Âge :</span> {{ $joueur->age }} ans</li>
                                <li class="text-gray-300"><span class="text-gray-400">Pays :</span> {{ $joueur->pays }}</li>
                            </ul>
                        </div>

                        <div class="rounded-xl border border-white/10 bg-white/5 p-5">
                            <h3 class="text-white font-semibold mb-3">Sport</h3>
                            <ul class="space-y-2 text-sm">
                                <li class="text-gray-300"><span class="text-gray-400">Position :</span> {{ $joueur->position->position }}</li>
                                <li class="text-gray-300"><span class="text-gray-400">Genre :</span> {{ $joueur->genre->genre }}</li>
                                <li class="text-gray-300">
                                    <span class="text-gray-400">Équipe :</span>
                                    @if($joueur->equipe)
                                        <a href="{{ route('equipes.show', $joueur->equipe) }}" class="text-sky-400 hover:text-sky-300">
                                            {{ $joueur->equipe->nom }}
                                        </a>
                                    @else
                                        <span class="text-red-400">Sans équipe</span>
                                    @endif
                                </li>
                            </ul>
                        </div>

                        <div class="rounded-xl border border-white/10 bg-white/5 p-5">
                            <h3 class="text-white font-semibold mb-3">Contact</h3>
                            <ul class="space-y-2 text-sm">
                                <li class="text-gray-300">
                                    <span class="text-gray-400">Email :</span>
                                    <a href="mailto:{{ $joueur->email }}" class="text-sky-400 hover:text-sky-300">
                                        {{ $joueur->email }}
                                    </a>
                                </li>
                                @if($joueur->phone)
                                <li class="text-gray-300">
                                    <span class="text-gray-400">Téléphone :</span>
                                    <a href="tel:{{ $joueur->phone }}" class="text-sky-400 hover:text-sky-300">
                                        {{ $joueur->phone }}
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    @can('is-staff')
                        <div class="mt-8 flex flex-wrap gap-3 border-t border-white/10 pt-5">
                            <a
                                href="{{ route('joueurs.edit', $joueur) }}"
                                class="rounded-xl px-5 py-2.5 bg-sky-500/90 hover:bg-sky-400 text-white font-semibold shadow-lg shadow-sky-500/20 transition"
                            >
                                Modifier
                            </a>

                            <form action="{{ route('joueurs.destroy', $joueur) }}" method="POST" onsubmit="return confirm('Supprimer ce joueur ?')" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="rounded-xl px-5 py-2.5 bg-red-500/90 hover:bg-red-500 text-white font-semibold shadow-lg shadow-red-500/20 transition"
                                >
                                    Supprimer
                                </button>
                            </form>

                            <a
                                href="{{ route('joueurs.index') }}"
                                class="rounded-xl px-5 py-2.5 border border-white/15 bg-white/5 hover:bg-white/10 text-white font-medium backdrop-blur transition"
                            >
                                Retour à la liste
                            </a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
