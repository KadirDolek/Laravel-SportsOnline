<!-- resources/views/equipes/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer une nouvelle équipe') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('components.flash-messages')

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('equipes.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nom -->
                            <div>
                                <label for="nom" class="block text-gray-700 text-sm font-bold mb-2">Nom *</label>
                                <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('nom')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Ville -->
                            <div>
                                <label for="ville" class="block text-gray-700 text-sm font-bold mb-2">Ville *</label>
                                <input type="text" name="ville" id="ville" value="{{ old('ville') }}" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('ville')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Pays -->
                            <div>
                                <label for="pays" class="block text-gray-700 text-sm font-bold mb-2">Pays *</label>
                                <input type="text" name="pays" id="pays" value="{{ old('pays') }}" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('pays')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Continent -->
                            <div>
                                <label for="continent_id" class="block text-gray-700 text-sm font-bold mb-2">Continent *</label>
                                <select name="continent_id" id="continent_id" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="">Sélectionner un continent</option>
                                    @foreach($continents as $continent)
                                        <option value="{{ $continent->id }}" {{ old('continent_id') == $continent->id ? 'selected' : '' }}>
                                            {{ $continent->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('continent_id')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Genre -->
                            <div>
                                <label for="genre_id" class="block text-gray-700 text-sm font-bold mb-2">Genre *</label>
                                <select name="genre_id" id="genre_id" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="">Sélectionner un genre</option>
                                    @foreach($genres as $genre)
                                        <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                            {{ $genre->genre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('genre_id')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-8">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Créer l'équipe
                            </button>
                            <a href="{{ route('equipes.index') }}" class="ml-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>