<!-- resources/views/equipes/show.blade.php -->
<x-app-layout>
    {{-- Pas de header slot pour éviter la barre blanche du layout --}}

    <!-- En-tête sombre interne -->
    <div class="relative">
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-[#0b153a]/40 via-[#0a0f2b]/60 to-black/80"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-white drop-shadow">Détails de l’équipe</h1>
            <p class="mt-2 text-gray-300">Infos, effectif et réserves.</p>
        </div>
    </div>

    @php
        $logo = $equipe->logo_url ?? asset('img/logo.jpg');
    @endphp

    <!-- Corps sombre -->
    <div class="bg-gradient-to-b from-black via-[#070b1f] to-[#050713] py-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @include('components.flash-messages')

            <!-- Carte Infos équipe -->
            <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur overflow-hidden">
                <div class="px-6 py-6 border-b border-white/10">
                    <div class="flex flex-col md:flex-row md:items-center gap-6">
                        <!-- Logo -->
                        <img src="{{ $logo }}" alt="Logo {{ $equipe->nom }}"
                             class="w-20 h-20 rounded-full object-cover ring-2 ring-white/20 shadow" />

                        <div class="flex-1">
                            <h2 class="text-2xl md:text-3xl font-extrabold text-white leading-tight">
                                {{ $equipe->nom }}
                            </h2>

                            <div class="mt-3 flex flex-wrap gap-2">
                                @if($equipe->genre?->genre)
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-white/10 border border-white/15 text-gray-100">
                                        {{ $equipe->genre->genre }}
                                    </span>
                                @endif
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-white/10 border border-white/15 text-gray-100">
                                    {{ $equipe->ville }}, {{ $equipe->pays }}
                                </span>
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-white/10 border border-white/15 text-gray-100">
                                    {{ $equipe->continent->nom }}
                                </span>
                                @if($equipe->user?->name)
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-white/10 border border-white/15 text-gray-100">
                                        Entraîneur : {{ $equipe->user->name }}
                                    </span>
                                @endif
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-white/10 border border-white/15 text-gray-100">
                                    {{ $equipe->joueurs->count() }} joueurs
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Composition -->
                <div class="p-6">
                    <h3 class="text-white font-semibold mb-4 text-lg">Composition de l’équipe</h3>

                    @foreach($positions as $position)
                        @if($position->position !== 'Réserve')
                            @php
                                $joueursPosition = $joueurs->where('position_id', $position->id)->where('is_reserve', false);
                                $count = $joueursPosition->count();
                                $max = (int) ($position->max_players ?? 0);
                                $ratio = $max > 0 ? min(100, round(($count / $max) * 100)) : 0;
                            @endphp

                            <div class="mb-6 rounded-xl border border-white/10 bg-white/5 p-5">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-white font-semibold">
                                        {{ $position->position }} <span class="text-gray-300">({{ $count }}{{ $max ? "/$max" : '' }})</span>
                                    </h4>
                                    @if($max)
                                        <div class="w-40 h-2 bg-white/10 rounded-full overflow-hidden">
                                            <div class="h-full bg-sky-400/80" style="width: {{ $ratio }}%"></div>
                                        </div>
                                    @endif
                                </div>

                                @if($count > 0)
                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @foreach($joueursPosition as $joueur)
                                            @php
                                                $genreLib = strtolower($joueur->genre->genre ?? '');
                                                $fallback = match (true) {
                                                    str_contains($genreLib, 'hom') || str_contains($genreLib, 'male') || $genreLib === 'm' => asset('img/male1.jpg'),
                                                    str_contains($genreLib, 'fem') || str_contains($genreLib, 'female') || $genreLib === 'f' => asset('img/femme1.jpg'),
                                                    default => asset('img/mixt1.jpg'),
                                                };
                                                $photo = $joueur->photo_url ?: $fallback;
                                            @endphp
                                            <div class="rounded-lg border border-white/10 bg-white/5 p-3 flex items-center gap-3">
                                                <img src="{{ $photo }}" alt="{{ $joueur->prenom }} {{ $joueur->nom }}"
                                                     class="w-10 h-10 rounded-full object-cover ring-2 ring-white/10">
                                                <div class="min-w-0">
                                                    <a href="{{ route('joueurs.show', $joueur) }}" class="text-sky-400 hover:text-sky-300 font-medium truncate">
                                                        {{ $joueur->prenom }} {{ $joueur->nom }}
                                                    </a>
                                                    <p class="text-xs text-gray-400">Âge {{ $joueur->age }} • {{ $joueur->pays }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="mt-3 text-gray-400">Aucun joueur dans cette position.</p>
                                @endif
                            </div>
                        @endif
                    @endforeach

                    <!-- Réserves -->
                    @php
                        $reserves = $joueurs->where('is_reserve', true);
                    @endphp

                    <div class="mb-2 rounded-xl border border-amber-400/30 bg-amber-400/10 p-5">
                        <div class="flex items-center justify-between">
                            <h4 class="text-white font-semibold">Réserves <span class="text-gray-300">({{ $reserves->count() }}/5)</span></h4>
                        </div>

                        @if($reserves->count() > 0)
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($reserves as $joueur)
                                    @php
                                        $genreLib = strtolower($joueur->genre->genre ?? '');
                                        $fallback = match (true) {
                                            str_contains($genreLib, 'hom') || str_contains($genreLib, 'male') || $genreLib === 'm' => asset('img/male1.jpg'),
                                            str_contains($genreLib, 'fem') || str_contains($genreLib, 'female') || $genreLib === 'f' => asset('img/femme1.jpg'),
                                            default => asset('img/mixt1.jpg'),
                                        };
                                        $photo = $joueur->photo_url ?: $fallback;
                                    @endphp
                                    <div class="rounded-lg border border-white/10 bg-white/5 p-3 flex items-center gap-3">
                                        <img src="{{ $photo }}" alt="{{ $joueur->prenom }} {{ $joueur->nom }}"
                                             class="w-10 h-10 rounded-full object-cover ring-2 ring-amber-300/40">
                                        <div class="min-w-0">
                                            <a href="{{ route('joueurs.show', $joueur) }}" class="text-sky-400 hover:text-sky-300 font-medium truncate">
                                                {{ $joueur->prenom }} {{ $joueur->nom }}
                                            </a>
                                            <p class="text-xs text-gray-400">
                                                {{ $joueur->position->position }} • {{ $joueur->age }} ans
                                                <span class="ml-2 inline-block align-middle rounded-full px-2 py-0.5 text-[10px] font-bold bg-amber-300/90 text-amber-900">RÉSERVE</span>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="mt-3 text-gray-400">Aucun joueur en réserve.</p>
                        @endif
                    </div>

                    <!-- Actions -->
                    @can('manage-equipe', $equipe)
                        <div class="mt-8 flex flex-wrap gap-3 border-t border-white/10 pt-5">
                            <a
                                href="{{ route('equipes.edit', $equipe) }}"
                                class="rounded-xl px-5 py-2.5 bg-sky-500/90 hover:bg-sky-400 text-white font-semibold shadow-lg shadow-sky-500/20 transition"
                            >
                                Modifier l’équipe
                            </a>

                            @if($equipe->joueurs->count() === 0)
                                <form action="{{ route('equipes.destroy', $equipe) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette équipe ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="rounded-xl px-5 py-2.5 bg-red-500/90 hover:bg-red-500 text-white font-semibold shadow-lg shadow-red-500/20 transition"
                                    >
                                        Supprimer l’équipe
                                    </button>
                                </form>
                            @else
                                <span class="self-center text-sm text-white/70">
                                    Impossible de supprimer : l’équipe contient des joueurs
                                </span>
                            @endif
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
