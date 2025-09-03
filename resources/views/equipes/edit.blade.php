<!-- resources/views/equipes/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier l\'équipe') }}: {{ $equipe->nom }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('components.flash-messages')

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('equipes.update', $equipe) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nom de l'équipe -->
                            <div>
                                <x-input-label for="nom" :value="__('Nom de l\'équipe')" />
                                <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom', $equipe->nom)" required autofocus />
                                <x-input-error :messages="$errors->get('nom')" class="mt-2" />
                            </div>
                            
                            <!-- Ville -->
                            <div>
                                <x-input-label for="ville" :value="__('Ville')" />
                                <x-text-input id="ville" class="block mt-1 w-full" type="text" name="ville" :value="old('ville', $equipe->ville)" required />
                                <x-input-error :messages="$errors->get('ville')" class="mt-2" />
                            </div>
                            
                            <!-- Pays -->
                            <div>
                                <x-input-label for="pays" :value="__('Pays')" />
                                <x-text-input id="pays" class="block mt-1 w-full" type="text" name="pays" :value="old('pays', $equipe->pays)" required />
                                <x-input-error :messages="$errors->get('pays')" class="mt-2" />
                            </div>
                            
                            <!-- Continent -->
                            <div>
                                <x-input-label for="continent_id" :value="__('Continent')" />
                                <select id="continent_id" name="continent_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                    <option value="">Sélectionner un continent</option>
                                    @foreach($continents as $continent)
                                        <option value="{{ $continent->id }}" {{ old('continent_id', $equipe->continent_id) == $continent->id ? 'selected' : '' }}>
                                            {{ $continent->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('continent_id')" class="mt-2" />
                            </div>
                            
                            <!-- Genre -->
                            <div>
                                <x-input-label for="genre_id" :value="__('Genre')" />
                                <select id="genre_id" name="genre_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                    <option value="">Sélectionner un genre</option>
                                    @foreach($genres as $genre)
                                        <option value="{{ $genre->id }}" {{ old('genre_id', $equipe->genre_id) == $genre->id ? 'selected' : '' }}>
                                            {{ $genre->genre }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('genre_id')" class="mt-2" />
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('equipes.show', $equipe) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-4">
                                Annuler
                            </a>
                            <x-primary-button class="ml-4">
                                {{ __('Mettre à jour') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>