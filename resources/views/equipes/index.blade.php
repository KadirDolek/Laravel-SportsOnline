<!-- resources/views/equipes/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des Équipes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('components.flash-messages')

            <!-- Filtre par continent -->
            <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="GET" action="{{ route('equipes.index') }}">
                        <div class="flex items-center">
                            <label for="continent" class="mr-4">Filtrer par continent:</label>
                            <select name="continent" id="continent" onchange="this.form.submit()" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Tous les continents</option>
                                @foreach($continents as $continent)
                                    <option value="{{ $continent->id }}" {{ request('continent') == $continent->id ? 'selected' : '' }}>
                                        {{ $continent->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Bouton Ajouter (seulement pour staff) -->
            @can('is-staff')
            <div class="mb-6">
                <a href="{{ route('equipes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Ajouter une équipe
                </a>
            </div>
            @endcan

            <!-- Liste des équipes -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($equipes as $equipe)
                            <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                                <h3 class="text-xl font-semibold mb-2">{{ $equipe->nom }}</h3>
                                <p class="text-gray-600">{{ $equipe->ville }}, {{ $equipe->pays }}</p>
                                <p class="text-sm text-gray-500">Continent: {{ $equipe->continent->nom }}</p>
                                <p class="text-sm text-gray-500">Genre: {{ $equipe->genre->genre }}</p>
                                <p class="text-sm text-gray-500">{{ $equipe->joueurs->count() }} joueurs</p>
                                
                                <div class="mt-4">
                                    <a href="{{ route('equipes.show', $equipe) }}" class="text-blue-600 hover:text-blue-800">Voir détails</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($equipes->isEmpty())
                        <p class="text-center text-gray-500 mt-8">Aucune équipe trouvée.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>