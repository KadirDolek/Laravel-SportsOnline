<!-- resources/views/joueurs/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un nouveau joueur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('components.flash-messages')

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('joueurs.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Photo -->
                            <div class="md:col-span-2">
                                <label for="photo" class="block text-gray-700 text-sm font-bold mb-2">Photo</label>
                                <input type="file" name="photo" id="photo"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('photo')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Prénom -->
                            <div>
                                <label for="prenom" class="block text-gray-700 text-sm font-bold mb-2">Prénom *</label>
                                <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('prenom')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nom -->
                            <div>
                                <label for="nom" class="block text-gray-700 text-sm font-bold mb-2">Nom *</label>
                                <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('nom')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Âge -->
                            <div>
                                <label for="age" class="block text-gray-700 text-sm font-bold mb-2">Âge *</label>
                                <input type="number" name="age" id="age" value="{{ old('age') }}" min="16" max="45" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('age')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email *</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('email')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Téléphone -->
                            <div>
                                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Téléphone</label>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @error('phone')
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

                            <!-- Position -->
                            <div>
                                <label for="position_id" class="block text-gray-700 text-sm font-bold mb-2">Position *</label>
                                <select name="position_id" id="position_id" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="">Sélectionner une position</option>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>
                                            {{ $position->position }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('position_id')
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

                            <!-- Équipe -->
                            <div>
                                <label for="equipe_id" class="block text-gray-700 text-sm font-bold mb-2">Équipe</label>
                                <select name="equipe_id" id="equipe_id"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="">Sans équipe</option>
                                    @foreach($equipes as $equipe)
                                        <option value="{{ $equipe->id }}" {{ old('equipe_id') == $equipe->id ? 'selected' : '' }}>
                                            {{ $equipe->nom }} ({{ $equipe->genre->genre }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('equipe_id')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-8">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Ajouter le joueur
                            </button>
                            <a href="{{ route('joueurs.index') }}" class="ml-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>