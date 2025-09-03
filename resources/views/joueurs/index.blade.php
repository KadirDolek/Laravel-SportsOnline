<!-- resources/views/joueurs/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des Joueurs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('components.flash-messages')

            <!-- Filtre par genre -->
            <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="GET" action="{{ route('joueurs.index') }}">
                        <div class="flex items-center">
                            <label for="genre" class="mr-4">Filtrer par genre:</label>
                            <select name="genre" id="genre" onchange="this.form.submit()" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Tous les genres</option>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                                        {{ $genre->genre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Bouton Ajouter (pour tous les utilisateurs connectés) -->
            @can('create-joueur')
            <div class="mb-6">
                <a href="{{ route('joueurs.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Ajouter un joueur
                </a>
            </div>
            @endcan

            <!-- Liste des joueurs -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($joueurs as $joueur)
                            <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                                <div class="flex items-center mb-3">
                                    <img src="{{ $joueur->photo_url }}" alt="{{ $joueur->prenom }} {{ $joueur->nom }}" class="w-16 h-16 object-cover rounded-full mr-4">
                                    <div>
                                        <h3 class="text-xl font-semibold">{{ $joueur->prenom }} {{ $joueur->nom }}</h3>
                                        <p class="text-gray-600">{{ $joueur->age }} ans</p>
                                        <p class="text-xs text-gray-500">Créé par: {{ $joueur->user->name }}</p>
                                    </div>
                                </div>
                                
                                <p class="text-sm text-gray-500">Position: {{ $joueur->position->position }}</p>
                                <p class="text-sm text-gray-500">Genre: {{ $joueur->genre->genre }}</p>
                                <p class="text-sm text-gray-500">
                                    Équipe: 
                                    @if($joueur->equipe)
                                        {{ $joueur->equipe->nom }}
                                    @else
                                        <span class="text-red-500">Sans équipe</span>
                                    @endif
                                </p>
                                
                                @if($joueur->is_reserve)
                                    <span class="inline-block bg-yellow-200 text-yellow-800 text-xs px-2 py-1 rounded-full mt-2">RÉSERVE</span>
                                @endif
                                
                                <div class="mt-4 space-x-2">
                                    <a href="{{ route('joueurs.show', $joueur) }}" class="text-blue-600 hover:text-blue-800">Voir profil</a>
                                    
                                    @can('manage-joueur', $joueur)
                                        <a href="{{ route('joueurs.edit', $joueur) }}" class="text-green-600 hover:text-green-800">Modifier</a>
                                        <form action="{{ route('joueurs.destroy', $joueur) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce joueur?')">
                                                Supprimer
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($joueurs->isEmpty())
                        <p class="text-center text-gray-500 mt-8">Aucun joueur trouvé.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>