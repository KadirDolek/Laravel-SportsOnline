<!-- resources/views/joueurs/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil du Joueur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('components.flash-messages')

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col md:flex-row items-center md:items-start">
                        <!-- Photo -->
                        <div class="w-48 h-48 mb-4 md:mb-0 md:mr-6">
                            <img src="{{ $joueur->photo_url }}" alt="{{ $joueur->prenom }} {{ $joueur->nom }}" class="w-full h-full object-cover rounded-lg">
                        </div>
                        
                        <!-- Informations -->
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold">{{ $joueur->prenom }} {{ $joueur->nom }}</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <p><strong>Âge:</strong> {{ $joueur->age }} ans</p>
                                    <p><strong>Pays:</strong> {{ $joueur->pays }}</p>
                                    <p><strong>Email:</strong> {{ $joueur->email }}</p>
                                    @if($joueur->phone)
                                        <p><strong>Téléphone:</strong> {{ $joueur->phone }}</p>
                                    @endif
                                </div>
                                
                                <div>
                                    <p><strong>Position:</strong> {{ $joueur->position->position }}</p>
                                    <p><strong>Genre:</strong> {{ $joueur->genre->genre }}</p>
                                    <p><strong>Équipe:</strong> 
                                        @if($joueur->equipe)
                                            <a href="{{ route('equipes.show', $joueur->equipe) }}" class="text-blue-600 hover:text-blue-800">
                                                {{ $joueur->equipe->nom }}
                                            </a>
                                        @else
                                            <span class="text-red-500">Sans équipe</span>
                                        @endif
                                    </p>
                                    
                                    @if($joueur->is_reserve)
                                        <span class="inline-block bg-yellow-200 text-yellow-800 text-xs px-2 py-1 rounded-full mt-2">JOUEUR RÉSERVE</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Boutons d'action -->
                    @can('is-staff')
                    <div class="mt-8 border-t pt-4">
                        <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Modifier
                        </a>
                        <form action="#" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce joueur?')">
                                Supprimer
                            </button>
                        </form>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>