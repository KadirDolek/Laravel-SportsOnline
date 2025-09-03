<!-- resources/views/equipes/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de l\'équipe') }}: {{ $equipe->nom }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('components.flash-messages')

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Informations de l'équipe -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold mb-4">Informations</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p><strong>Ville:</strong> {{ $equipe->ville }}</p>
                                <p><strong>Pays:</strong> {{ $equipe->pays }}</p>
                                <p><strong>Continent:</strong> {{ $equipe->continent->nom }}</p>
                            </div>
                            <div>
                                <p><strong>Genre:</strong> {{ $equipe->genre->genre }}</p>
                                <p><strong>Nombre de joueurs:</strong> {{ $equipe->joueurs->count() }}</p>
                                <p><strong>Entraîneur:</strong> {{ $equipe->user->name }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Joueurs par position -->
                    <div>
                        <h3 class="text-2xl font-bold mb-4">Composition de l'équipe</h3>
                        
                        @foreach($positions as $position)
                            @if($position->position !== 'Réserve')
                                @php
                                    $joueursPosition = $joueurs->where('position_id', $position->id)->where('is_reserve', false);
                                @endphp
                                
                                <div class="mb-6">
                                    <h4 class="text-xl font-semibold mb-3">{{ $position->position }} ({{ $joueursPosition->count() }}/{{ $position->max_players }})</h4>
                                    
                                    @if($joueursPosition->count() > 0)
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            @foreach($joueursPosition as $joueur)
                                                <div class="border rounded p-3">
                                                    <a href="{{ route('joueurs.show', $joueur) }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                                                        {{ $joueur->prenom }} {{ $joueur->nom }}
                                                    </a>
                                                    <p class="text-sm text-gray-600">Âge: {{ $joueur->age }} ans</p>
                                                    <p class="text-sm text-gray-600">Pays: {{ $joueur->pays }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-gray-500">Aucun joueur dans cette position.</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach

                        <!-- Joueurs en réserve -->
                        @php
                            $reserves = $joueurs->where('is_reserve', true);
                        @endphp
                        
                        <div class="mb-6">
                            <h4 class="text-xl font-semibold mb-3">Réserves ({{ $reserves->count() }}/5)</h4>
                            
                            @if($reserves->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($reserves as $joueur)
                                        <div class="border rounded p-3 bg-yellow-50">
                                            <a href="{{ route('joueurs.show', $joueur) }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                                                {{ $joueur->prenom }} {{ $joueur->nom }}
                                            </a>
                                            <p class="text-sm text-gray-600">Position: {{ $joueur->position->position }}</p>
                                            <p class="text-sm text-gray-600">Âge: {{ $joueur->age }} ans</p>
                                            <span class="inline-block bg-yellow-200 text-yellow-800 text-xs px-2 py-1 rounded-full">RÉSERVE</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500">Aucun joueur en réserve.</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-8 border-t pt-4 mb-4 ms-4">
                    @can('manage-equipe', $equipe)
                        <a href="{{ route('equipes.edit', $equipe) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Modifier l'équipe
                        </a>
                        
                        @if($equipe->joueurs->count() === 0)
                            <form action="{{ route('equipes.destroy', $equipe) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette équipe?')">
                                    Supprimer l'équipe
                                </button>
                            </form>
                        @else
                            <span class="text-gray-500 text-sm ml-4">Impossible de supprimer : l'équipe contient des joueurs</span>
                        @endif
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>