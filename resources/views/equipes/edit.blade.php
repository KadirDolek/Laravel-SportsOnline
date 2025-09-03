<!-- resources/views/equipes/edit.blade.php -->
<x-app-layout>
    {{-- Pas de header slot pour éviter la barre blanche du layout --}}

    <!-- En-tête sombre interne -->
    <div class="relative">
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-[#0b153a]/40 via-[#0a0f2b]/60 to-black/80"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-white drop-shadow">
                Modifier l’équipe : {{ $equipe->nom }}
            </h1>
            <p class="mt-2 text-gray-300">Ajuste les informations puis enregistre.</p>
        </div>
    </div>

    <!-- Corps sombre -->
    <div class="bg-gradient-to-b from-black via-[#070b1f] to-[#050713] py-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @include('components.flash-messages')

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-500/30 bg-red-500/10 text-red-200 px-4 py-3">
                    <p class="font-semibold">Oups, certains champs sont invalides.</p>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur">
                <div class="px-6 py-5 border-b border-white/10">
                    <h2 class="text-xl font-bold text-white">Informations de l’équipe</h2>
                </div>

                <div class="p-6">
                    <form method="POST" action="{{ route('equipes.update', $equipe) }}" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nom de l'équipe -->
                            <div>
                                <label for="nom" class="block text-sm font-semibold text-gray-200 mb-2">
                                    Nom de l’équipe <span class="text-red-400">*</span>
                                </label>
                                <input
                                    id="nom" name="nom" type="text" required
                                    value="{{ old('nom', $equipe->nom) }}"
                                    class="w-full rounded-xl border border-white/20 bg-white/10 text-white placeholder-gray-400 px-4 py-2.5
                                           focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:border-sky-400/70 @error('nom') ring-2 ring-red-500/50 @enderror"
                                    placeholder="Ex. Paris Saint-Germain"
                                >
                                @error('nom') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <!-- Ville -->
                            <div>
                                <label for="ville" class="block text-sm font-semibold text-gray-200 mb-2">
                                    Ville <span class="text-red-400">*</span>
                                </label>
                                <input
                                    id="ville" name="ville" type="text" required
                                    value="{{ old('ville', $equipe->ville) }}"
                                    class="w-full rounded-xl border border-white/20 bg-white/10 text-white placeholder-gray-400 px-4 py-2.5
                                           focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:border-sky-400/70 @error('ville') ring-2 ring-red-500/50 @enderror"
                                    placeholder="Ex. Paris"
                                >
                                @error('ville') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <!-- Pays -->
                            <div>
                                <label for="pays" class="block text-sm font-semibold text-gray-200 mb-2">
                                    Pays <span class="text-red-400">*</span>
                                </label>
                                <input
                                    id="pays" name="pays" type="text" required
                                    value="{{ old('pays', $equipe->pays) }}"
                                    class="w-full rounded-xl border border-white/20 bg-white/10 text-white placeholder-gray-400 px-4 py-2.5
                                           focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:border-sky-400/70 @error('pays') ring-2 ring-red-500/50 @enderror"
                                    placeholder="Ex. France"
                                >
                                @error('pays') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <!-- Continent -->
                            <div>
                                <label for="continent_id" class="block text-sm font-semibold text-gray-200 mb-2">
                                    Continent <span class="text-red-400">*</span>
                                </label>
                                <select
                                    id="continent_id" name="continent_id" required
                                    class="w-full rounded-xl border border-white/20 bg-white/10 text-white px-4 py-2.5
                                           focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:border-sky-400/70 @error('continent_id') ring-2 ring-red-500/50 @enderror"
                                >
                                    <option value="" class="bg-slate-800 text-white">Sélectionner un continent</option>
                                    @foreach($continents as $continent)
                                        <option
                                            value="{{ $continent->id }}"
                                            {{ (int) old('continent_id', $equipe->continent_id) === (int) $continent->id ? 'selected' : '' }}
                                            class="bg-slate-800 text-white"
                                        >
                                            {{ $continent->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('continent_id') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                            </div>

                            <!-- Genre -->
                            <div>
                                <label for="genre_id" class="block text-sm font-semibold text-gray-200 mb-2">
                                    Genre <span class="text-red-400">*</span>
                                </label>
                                <select
                                    id="genre_id" name="genre_id" required
                                    class="w-full rounded-xl border border-white/20 bg-white/10 text-white px-4 py-2.5
                                           focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:border-sky-400/70 @error('genre_id') ring-2 ring-red-500/50 @enderror"
                                >
                                    <option value="" class="bg-slate-800 text-white">Sélectionner un genre</option>
                                    @foreach($genres as $genre)
                                        <option
                                            value="{{ $genre->id }}"
                                            {{ (int) old('genre_id', $equipe->genre_id) === (int) $genre->id ? 'selected' : '' }}
                                            class="bg-slate-800 text-white"
                                        >
                                            {{ $genre->genre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('genre_id') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="pt-2 flex items-center gap-3">
                            <a
                                href="{{ route('equipes.show', $equipe) }}"
                                class="rounded-xl px-5 py-2.5 border border-white/15 bg-white/5 hover:bg-white/10 text-white font-medium backdrop-blur transition"
                            >
                                Annuler
                            </a>
                            <button
                                type="submit"
                                class="rounded-xl px-5 py-2.5 bg-sky-500/90 hover:bg-sky-400 text-white font-semibold shadow-lg shadow-sky-500/20 transition"
                            >
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
