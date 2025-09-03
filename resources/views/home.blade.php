<!-- resources/views/home.blade.php -->
<x-app-layout>
    {{-- Pas de header slot pour éviter la barre blanche du layout --}}

    <div class="relative isolate">
        <!-- Hero vidéo fixe en fond -->
        <div class="relative h-[48rem] overflow-hidden">
            <div class=" inset-0 -z-10">
                <div class="absolute inset-0 bg-gradient-to-b from-[#0b153a]/90 via-[#0a0f2b]/90 to-black/95"></div>
                <iframe
                    class="absolute inset-0 w-full h-full scale-110"
                    src="https://www.youtube.com/embed/KriBQVhsgZk?autoplay=1&mute=1&controls=0&loop=1&playlist=KriBQVhsgZk&modestbranding=1&rel=0&showinfo=0&playsinline=1"
                    title="UEFA style intro"
                    frameborder="0"
                    allow="autoplay; fullscreen"
                    loading="lazy"
                ></iframe>
            </div>

            <!-- Texte par-dessus la vidéo -->
            <div class="relative z-10 max-w-7xl mx-auto h-full px-6 lg:px-8 flex flex-col justify-center">
                <p class="text-sky-400 uppercase tracking-widest text-sm mb-3">Sports Online</p>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white drop-shadow-xl">
                    Plateforme de gestion de football
                </h1>
                <p class="mt-6 text-lg md:text-xl text-gray-200 max-w-2xl">
                    Créez des équipes, ajoutez des joueurs, respectez les quotas par poste, et parcourez l’élite du foot.
                </p>
                <div class="mt-8 flex gap-4">
                    <a href="{{ route('equipes.index') }}"
                       class="rounded-xl px-5 py-3 bg-sky-500/90 hover:bg-sky-400 text-white font-semibold shadow-lg shadow-sky-500/20 transition">
                        Voir les équipes
                    </a>
                    <a href="{{ route('joueurs.index') }}"
                       class="rounded-xl px-5 py-3 bg-white/10 hover:bg-white/20 text-white font-semibold border border-white/20 backdrop-blur transition">
                        Voir les joueurs
                    </a>
                </div>
            </div>
        </div>

        <!-- Contenu principal sombre -->
        <div class="bg-gradient-to-b from-black via-[#070b1f] to-[#050713] py-16">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                @include('components.flash-messages')

                {{-- Équipes européennes --}}
                <section class="mb-12">
                    <h3 class="text-2xl font-bold text-white mb-4">Équipes européennes</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($europeanTeams as $team)
                            <div class="rounded-xl bg-white/5 border border-white/10 p-4 backdrop-blur hover:border-sky-500/40 transition">
                                <h4 class="font-semibold text-lg text-white">{{ $team->nom }}</h4>
                                <p class="text-gray-300">{{ $team->ville }}, {{ $team->pays }}</p>
                                <p class="text-sm text-gray-400">{{ $team->joueurs_count }} joueurs</p>
                                <a href="{{ route('equipes.show', $team) }}"
                                   class="mt-2 inline-block text-sky-400 hover:text-sky-300 font-medium">
                                    Voir détails →
                                </a>
                            </div>
                        @endforeach
                    </div>
                </section>

                {{-- 8 joueurs d’équipes européennes --}}
                <section class="mb-12">
                    <h3 class="text-2xl font-bold text-white mb-4">8 joueurs d’équipes européennes</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($europeanPlayers as $player)
                            <div class="rounded-xl bg-white/5 border border-white/10 p-4 backdrop-blur hover:border-sky-500/40 transition">
                                <h4 class="font-semibold text-lg text-white">{{ $player->prenom }} {{ $player->nom }}</h4>
                                <p class="text-gray-300">{{ $player->age }} ans</p>
                                <p class="text-sm text-gray-400">{{ $player->position->position }} — {{ $player->equipe->nom }}</p>
                                <a href="{{ route('joueurs.show', $player) }}"
                                   class="mt-2 inline-block text-sky-400 hover:text-sky-300 font-medium">
                                    Voir profil →
                                </a>
                            </div>
                        @endforeach
                    </div>
                </section>

                {{-- 4 équipes hors Europe --}}
                <section class="mb-12">
                    <h3 class="text-2xl font-bold text-white mb-4">4 équipes hors Europe</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($nonEuropeanTeams as $team)
                            <div class="rounded-xl bg-white/5 border border-white/10 p-4 backdrop-blur hover:border-sky-500/40 transition">
                                <h4 class="font-semibold text-lg text-white">{{ $team->nom }}</h4>
                                <p class="text-gray-300">{{ $team->ville }}, {{ $team->pays }}</p>
                                <p class="text-sm text-gray-400">{{ $team->continent->nom }}</p>
                                <a href="{{ route('equipes.show', $team) }}"
                                   class="mt-2 inline-block text-sky-400 hover:text-sky-300 font-medium">
                                    Voir détails →
                                </a>
                            </div>
                        @endforeach
                    </div>
                </section>

                {{-- 8 joueuses hors Europe --}}
                <section class="mb-12">
                    <h3 class="text-2xl font-bold text-white mb-4">8 joueuses hors Europe</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($nonEuropeanFemalePlayers as $player)
                            <div class="rounded-xl bg-white/5 border border-white/10 p-4 backdrop-blur hover:border-sky-500/40 transition">
                                <h4 class="font-semibold text-lg text-white">{{ $player->prenom }} {{ $player->nom }}</h4>
                                <p class="text-gray-300">{{ $player->age }} ans</p>
                                <p class="text-sm text-gray-400">{{ $player->position->position }} — {{ $player->equipe->nom }}</p>
                                <a href="{{ route('joueurs.show', $player) }}"
                                   class="mt-2 inline-block text-sky-400 hover:text-sky-300 font-medium">
                                    Voir profil →
                                </a>
                            </div>
                        @endforeach
                    </div>
                </section>

                {{-- 4 joueurs/joueuses sans équipe --}}
                <section>
                    <h3 class="text-2xl font-bold text-white mb-4">4 joueurs/joueuses sans équipe</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($playersWithoutTeam as $player)
                            <div class="rounded-xl bg-white/5 border border-white/10 p-4 backdrop-blur hover:border-sky-500/40 transition">
                                <h4 class="font-semibold text-lg text-white">{{ $player->prenom }} {{ $player->nom }}</h4>
                                <p class="text-gray-300">{{ $player->age }} ans</p>
                                <p class="text-sm text-gray-400">{{ $player->position->position }} — Sans équipe</p>
                                <a href="{{ route('joueurs.show', $player) }}"
                                   class="mt-2 inline-block text-sky-400 hover:text-sky-300 font-medium">
                                    Voir profil →
                                </a>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
