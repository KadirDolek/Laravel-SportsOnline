<!-- resources/views/admin/users/edit.blade.php -->
<x-app-layout>
    {{-- Pas de header slot pour éviter la barre blanche du layout --}}

    <!-- En-tête sombre interne -->
    <div class="relative">
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-[#0b153a]/40 via-[#0a0f2b]/60 to-black/80"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-white drop-shadow">
                Modifier le rôle utilisateur
            </h1>
            <p class="mt-2 text-gray-300">Sélectionne un rôle et enregistre. Utilisateur actuel : <span class="font-semibold">{{ $user->name }}</span></p>
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
                <div class="px-6 py-5 border-b border-white/10 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-white">Rôle de {{ $user->name }}</h2>
                        <div class="mt-2">
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-white/10 border border-white/15 text-gray-100">
                                Rôle actuel : {{ ucfirst($user->role) }}
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.index') }}"
                       class="hidden sm:inline-flex rounded-xl px-4 py-2 border border-white/15 bg-white/5 hover:bg-white/10 text-white font-medium backdrop-blur transition">
                        ← Retour à la liste
                    </a>
                </div>

                <div class="p-6">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="role" class="block text-sm font-semibold text-gray-200 mb-2">
                                Rôle
                            </label>
                            <select
                                id="role"
                                name="role"
                                class="w-full rounded-xl border border-white/20 bg-white/10 text-white px-4 py-2.5
                                       focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:border-sky-400/70"
                                required
                            >
                                @php $current = old('role', $user->role); @endphp
                                <option value="utilisateur" {{ $current === 'utilisateur' ? 'selected' : '' }} class="bg-slate-800 text-white">
                                    Utilisateur
                                </option>
                                <option value="coach" {{ $current === 'coach' ? 'selected' : '' }} class="bg-slate-800 text-white">
                                    Coach
                                </option>
                                <option value="admin" {{ $current === 'admin' ? 'selected' : '' }} class="bg-slate-800 text-white">
                                    Administrateur
                                </option>
                            </select>
                            @error('role') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror

                            <p class="mt-2 text-xs text-white/60">
                                • <span class="font-medium">Utilisateur</span> : accès basique.<br>
                                • <span class="font-medium">Coach</span> : gère ses équipes et joueurs.<br>
                                • <span class="font-medium">Administrateur</span> : accès complet.
                            </p>
                        </div>

                        <div class="pt-2 flex items-center gap-3">
                            <button
                                type="submit"
                                class="rounded-xl px-5 py-2.5 bg-sky-500/90 hover:bg-sky-400 text-white font-semibold shadow-lg shadow-sky-500/20 transition"
                            >
                                Mettre à jour
                            </button>
                            <a
                                href="{{ route('admin.users.index') }}"
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
</x-app-layout>
