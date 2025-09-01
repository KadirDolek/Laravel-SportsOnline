<!-- resources/views/home.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Plateforme de Gestion de Football') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('components.flash-messages')

            <!-- Carrousel -->
            <div class="mb-12 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">Les meilleures équipes de football</h3>
                    <div class="relative w-full h-64 overflow-hidden rounded-lg">
                        <div class="absolute inset-0 flex transition-transform duration-500 ease-in-out" x-data="{ currentIndex: 0, slides: [
                            'https://images.unsplash.com/photo-1575361204480-aadea25e6e68?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80',
                            'https://images.unsplash.com/photo-1529900748604-07564a03e7a6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80',
                            'https://images.unsplash.com/photo-1596510913920-85d87a1800d2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1469&q=80'
                        ] }" x-init="setInterval(() => { currentIndex = (currentIndex + 1) % slides.length }, 3000)">
                            <template x-for="(slide, index) in slides" :key="index">
                                <img :src="slide" alt="Football" class="w-full h-64 object-cover absolute inset-0 transition-opacity duration-500" :class="{ 'opacity-100': currentIndex === index, 'opacity-0': currentIndex !== index }">
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Équipes européennes -->
            <div class="mb-12 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">Équipes Européennes</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($europeanTeams as $team)
                            <div class="bg-gray-100 p-4 rounded-lg shadow">
                                <h4 class="font-semibold text-lg">{{ $team->nom }}</h4>
                                <p class="text-gray-600">{{ $team->ville }}, {{ $team->pays }}</p>
                                <p class="text-sm text-gray-500">{{ $team->joueurs_count }} joueurs</p>
                                <a href="{{ route('equipes.show', $team) }}" class="mt-2 inline-block text-blue-600 hover:text-blue-800">Voir détails</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Joueurs aléatoires d'équipes européennes -->
            <div class="mb-12 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">8 Joueurs Aléatoires d'Équipes Européennes</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($europeanPlayers as $player)
                            <div class="bg-gray-100 p-4 rounded-lg shadow">
                                <h4 class="font-semibold text-lg">{{ $player->prenom }} {{ $player->nom }}</h4>
                                <p class="text-gray-600">{{ $player->age }} ans</p>
                                <p class="text-sm text-gray-500">{{ $player->position->position }} - {{ $player->equipe->nom }}</p>
                                <a href="{{ route('joueurs.show', $player) }}" class="mt-2 inline-block text-blue-600 hover:text-blue-800">Voir profil</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Équipes hors Europe -->
            <div class="mb-12 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">4 Équipes Aléatoires Hors Europe</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($nonEuropeanTeams as $team)
                            <div class="bg-gray-100 p-4 rounded-lg shadow">
                                <h4 class="font-semibold text-lg">{{ $team->nom }}</h4>
                                <p class="text-gray-600">{{ $team->ville }}, {{ $team->pays }}</p>
                                <p class="text-sm text-gray-500">{{ $team->continent->nom }}</p>
                                <a href="{{ route('equipes.show', $team) }}" class="mt-2 inline-block text-blue-600 hover:text-blue-800">Voir détails</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Joueuses hors Europe -->
            <div class="mb-12 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">8 Joueuses Aléatoires Hors Europe</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($nonEuropeanFemalePlayers as $player)
                            <div class="bg-gray-100 p-4 rounded-lg shadow">
                                <h4 class="font-semibold text-lg">{{ $player->prenom }} {{ $player->nom }}</h4>
                                <p class="text-gray-600">{{ $player->age }} ans</p>
                                <p class="text-sm text-gray-500">{{ $player->position->position }} - {{ $player->equipe->nom }}</p>
                                <a href="{{ route('joueurs.show', $player) }}" class="mt-2 inline-block text-blue-600 hover:text-blue-800">Voir profil</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Joueurs sans équipe -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">4 Joueurs Sans Équipe</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($playersWithoutTeam as $player)
                            <div class="bg-gray-100 p-4 rounded-lg shadow">
                                <h4 class="font-semibold text-lg">{{ $player->prenom }} {{ $player->nom }}</h4>
                                <p class="text-gray-600">{{ $player->age }} ans</p>
                                <p class="text-sm text-gray-500">{{ $player->position->position }} - Sans équipe</p>
                                <a href="{{ route('joueurs.show', $player) }}" class="mt-2 inline-block text-blue-600 hover:text-blue-800">Voir profil</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>