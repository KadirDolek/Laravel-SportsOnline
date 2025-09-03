<!-- resources/views/joueurs/edit.blade.php -->
<x-app-layout>
    {{-- Pas de header slot pour éviter la barre blanche du layout --}}

    <!-- En-tête sombre interne -->
    <div class="relative">
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-[#0b153a]/40 via-[#0a0f2b]/60 to-black/80"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-white drop-shadow">Modifier le joueur</h1>
            <p class="mt-2 text-gray-300">Mets à jour les informations puis enregistre.</p>
        </div>
    </div>

    @php
        $genreLib = strtolower(optional($joueur->genre)->genre ?? '');
        $fallback = match (true) {
            str_contains($genreLib, 'hom') || str_contains($genreLib, 'male') || $genreLib === 'm' => asset('img/male1.jpg'),
            str_contains($genreLib, 'fem') || str_contains($genreLib, 'female') || $genreLib === 'f' => asset('img/femme1.jpg'),
            default => asset('img/mixt1.jpg'),
        };
        $currentPhoto = $joueur->photo_url ?? null;
    @endphp

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
                    <h2 class="text-xl font-bold text-white">Informations du joueur</h2>
                </div>

                <div class="p-6">
                    <form method="POST" action="{{ route('joueurs.update', $joueur) }}" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Photo -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-200 mb-3">Photo (optionnelle)</label>

                                <div class="flex items-center gap-4">
                                    <!-- Aperçu rond -->
                                    <div
                                        id="avatarPreview"
                                        data-male="{{ asset('img/male1.jpg') }}"
                                        data-femme="{{ asset('img/femme1.jpg') }}"
                                        data-mixt="{{ asset('img/mixt1.jpg') }}"
                                        class="relative"
                                    >
                                        <img
                                            id="avatarImg"
                                            src="{{ $currentPhoto ?: $fallback }}"
                                            alt="Aperçu photo"
                                            class="w-20 h-20 md:w-24 md:h-24 rounded-full object-cover ring-2 ring-white/20 shadow"
                                        />
                                    </div>

                                    <div class="flex-1">
                                        <input
                                            type="file"
                                            name="photo"
                                            id="photo"
                                            accept="image/*"
                                            class="block w-full cursor-pointer rounded-xl border border-white/20 bg-white/10 text-white file:mr-4 file:rounded-lg file:border-0 file:bg-sky-500/90 file:px-4 file:py-2 file:text-white hover:file:bg-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:border-sky-400/70"
                                        >
                                        <p class="mt-2 text-xs text-gray-400">PNG/JPG jusqu’à ~5 Mo.</p>
                                        @error('photo')
                                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Prénom -->
                            <div>
                                <label for="prenom" class="block text-sm font-semibold text-gray-200 mb-2">
                                    Prénom <span class="text-red-400">*</span>
                                </label>
                                <input
                                    type="text" name="prenom" id="prenom" required
                                    value="{{ old('prenom', $joueur->prenom) }}"
                                    class="w-full rounded-xl border border-white/20 bg-white/10 text-white placeholder-gray-400 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:border-sky-400/70 @error('prenom') ring-2 ring-red-500/50 @enderror"
                                    placeholder="Ex. Kylian"
                                >
                                @error('prenom')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nom -->
                            <div>
                                <label for="nom" class="block text-sm font-semibold text-gray-200 mb-2">
                                    Nom <span class="text-red-400">*</span>
                                </label>
                                <input
                                    type="text" name="nom" id="nom" required
                                    value="{{ old('nom', $joueur->nom) }}"
                                    class="w-full rounded-xl border border-white/20 bg-white/10 text-white placeholder-gray-400 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:border-sky-400/70 @error('nom') ring-2 ring-red-500/50 @enderror"
                                    placeholder="Ex. Mbappé"
                                >
                                @error('nom')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Âge -->
                            <div>
                                <label for="age" class="block text-sm font-semibold text-gray-200 mb-2">
                                    Âge <span class="text-red-400">*</span>
                                </label>
                                <input
                                    type="number" name="age" id="age" min="16" max="45" required
                                    value="{{ old('age', $joueur->age) }}"
                                    class="w-full rounded-xl border border-white/20 bg-white/10 text-white placeholder-gray-400 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:border-sky-400/70 @error('age') ring-2 ring-red-500/50 @enderror"
                                    placeholder="Ex. 24"
                                >
                                @error('age')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-200 mb-2">
                                    Email <span class="text-red-400">*</span>
                                </label>
                                <input
                                    type="email" name="email" id="email" required
                                    value="{{ old('email', $joueur->email) }}"
                                    class="w-full rounded-xl border border-white/20 bg-white/10 text-white placeholder-gray-400 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:border-sky-400/70 @error('email') ring-2 ring-red-500/50 @enderror"
                                    placeholder="nom@domaine.com"
                                >
                                @error('email')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Téléphone -->
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-200 mb-2">
                                    Téléphone
                                </label>
                                <input
                                    type="tel" name="phone" id="phone"
                                    value="{{ old('phone', $joueur->phone) }}"
                                    class="w-full rounded-xl border border-white/20 bg-white/10 text-white placeholder-gray-400 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:border-sky-400/70 @error('phone') ring-2 ring-red-500/50 @enderror"
                                    placeholder="+32 4 12 34 56 78"
                                >
                                @error('phone')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Pays -->
                            <div>
                                <label for="pays" class="block text-sm font-semibold text-gray-200 mb-2">
                                    Pays <span class="text-red-400">*</span>
                                </label>
                                <input
                                    type="text" name="pays" id="pays" required
                                    value="{{ old('pays', $joueur->pays) }}"
                                    class="w-full rounded-xl border border-white/20 bg-white/10 text-white placeholder-gray-400 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:border-sky-400/70 @error('pays') ring-2 ring-red-500/50 @enderror"
                                    placeholder="Ex. France"
                                >
                                @error('pays')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Position -->
                            <div>
                                <label for="position_id" class="block text-sm font-semibold text-gray-200 mb-2">
                                    Position <span class="text-red-400">*</span>
                                </label>
                                <select
                                    name="position_id" id="position_id" required
                                    class="w-full rounded-xl border border-white/20 bg-white/10 text-white px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:border-sky-400/70 @error('position_id') ring-2 ring-red-500/50 @enderror"
                                >
                                    <option value="" class="bg-slate-800 text-white">Sélectionner une position</option>
                                    @foreach($positions as $position)
                                        <option
                                            value="{{ $position->id }}"
                                            {{ (int) old('position_id', $joueur->position_id) === (int) $position->id ? 'selected' : '' }}
                                            class="bg-slate-800 text-white"
                                        >
                                            {{ $position->position }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('position_id')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Genre -->
                            <div>
                                <label for="genre_id" class="block text-sm font-semibold text-gray-200 mb-2">
                                    Genre <span class="text-red-400">*</span>
                                </label>
                                <select
                                    name="genre_id" id="genre_id" required
                                    class="w-full rounded-xl border border-white/20 bg-white/10 text-white px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:border-sky-400/70 @error('genre_id') ring-2 ring-red-500/50 @enderror"
                                >
                                    <option value="" class="bg-slate-800 text-white">Sélectionner un genre</option>
                                    @foreach($genres as $genre)
                                        <option
                                            value="{{ $genre->id }}"
                                            {{ (int) old('genre_id', $joueur->genre_id) === (int) $genre->id ? 'selected' : '' }}
                                            class="bg-slate-800 text-white"
                                        >
                                            {{ $genre->genre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('genre_id')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Équipe -->
                            <div>
                                <label for="equipe_id" class="block text-sm font-semibold text-gray-200 mb-2">
                                    Équipe (optionnel)
                                </label>
                                <select
                                    name="equipe_id" id="equipe_id"
                                    class="w-full rounded-xl border border-white/20 bg-white/10 text-white px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:border-sky-400/70 @error('equipe_id') ring-2 ring-red-500/50 @enderror"
                                >
                                    <option value="" class="bg-slate-800 text-white">Sans équipe</option>
                                    @foreach($equipes as $equipe)
                                        <option
                                            value="{{ $equipe->id }}"
                                            {{ (int) old('equipe_id', $joueur->equipe_id) === (int) $equipe->id ? 'selected' : '' }}
                                            class="bg-slate-800 text-white"
                                        >
                                            {{ $equipe->nom }} ({{ $equipe->genre->genre }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('equipe_id')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="pt-2 flex items-center gap-3">
                            <button
                                type="submit"
                                class="rounded-xl px-5 py-2.5 bg-sky-500/90 hover:bg-sky-400 text-white font-semibold shadow-lg shadow-sky-500/20 transition"
                            >
                                Modifier le joueur
                            </button>

                            <a
                                href="{{ route('joueurs.index') }}"
                                class="rounded-xl px-5 py-2.5 border border-white/15 bg-white/5 hover:bg-white/10 text-white font-medium backdrop-blur transition"
                            >
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Aperçu live de la photo + fallback genre -->
    <script>
        (function () {
            const fileInput = document.getElementById('photo');
            const img = document.getElementById('avatarImg');
            const preview = document.getElementById('avatarPreview');
            const genreSelect = document.getElementById('genre_id');

            const srcMale  = preview?.dataset.male;
            const srcFemme = preview?.dataset.femme;
            const srcMixt  = preview?.dataset.mixt;

            function updateFallbackByGenre() {
                if (!fileInput.files || fileInput.files.length === 0) {
                    const selected = genreSelect?.options[genreSelect.selectedIndex]?.text?.toLowerCase() || '';
                    if (selected.includes('hom')) img.src = srcMale;
                    else if (selected.includes('fem')) img.src = srcFemme;
                    else img.src = srcMixt;
                }
            }

            if (fileInput) {
                fileInput.addEventListener('change', (e) => {
                    const file = e.target.files?.[0];
                    if (!file) { updateFallbackByGenre(); return; }
                    const reader = new FileReader();
                    reader.onload = (ev) => { img.src = ev.target.result; };
                    reader.readAsDataURL(file);
                });
            }

            if (genreSelect) {
                genreSelect.addEventListener('change', updateFallbackByGenre);
            }
        })();
    </script>
</x-app-layout>
