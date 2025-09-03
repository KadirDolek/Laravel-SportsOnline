<!-- resources/views/auth/confirm-password.blade.php -->
<x-guest-layout>
    <!-- En-tête sombre interne -->
    <div class="relative">
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-[#0b153a]/40 via-[#0a0f2b]/60 to-black/80"></div>
        <div class="max-w-md mx-auto px-6 lg:px-8 py-10">
            <h1 class="text-2xl md:text-3xl font-extrabold text-white drop-shadow">
                Confirmer le mot de passe
            </h1>
            <p class="mt-2 text-gray-300">
                Pour continuer dans cette zone sécurisée, merci de confirmer votre mot de passe.
            </p>
        </div>
    </div>

    <!-- Corps sombre -->
    <div class="bg-gradient-to-b from-black via-[#070b1f] to-[#050713] py-6 pb-12">
        <div class="max-w-md mx-auto px-6 lg:px-8">
            <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur overflow-hidden">
                <div class="p-6">
                    <form method="POST" action="{{ route('password.confirm') }}" x-data="{ show: false }" class="space-y-6">
                        @csrf

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-200 mb-2">
                                Mot de passe
                            </label>
                            <div class="relative">
                                <input
                                    id="password"
                                    name="password"
                                    :type="show ? 'text' : 'password'"
                                    required
                                    autocomplete="current-password"
                                    class="w-full rounded-xl border border-white/20 bg-white/10 text-white placeholder-gray-400 px-4 py-2.5
                                           focus:outline-none focus:ring-2 focus:ring-sky-500/70 focus:border-sky-400/70"
                                    placeholder="••••••••"
                                />
                                <button
                                    type="button"
                                    @click="show = !show"
                                    class="absolute inset-y-0 right-2 my-auto px-2 rounded-lg text-white/70 hover:text-white hover:bg-white/10"
                                    aria-label="Afficher/Masquer"
                                >
                                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.74-4.362M6.18 6.18A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.97 9.97 0 01-3.26 4.568M15 12a3 3 0 00-3-3m0 0a3 3 0 013 3m-3-3L3 21" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-2 flex items-center justify-end gap-3">
                            <a href="javascript:history.back()"
                               class="rounded-xl px-5 py-2.5 border border-white/15 bg-white/5 hover:bg-white/10 text-white font-medium backdrop-blur transition">
                                Annuler
                            </a>
                            <button
                                type="submit"
                                class="rounded-xl px-5 py-2.5 bg-sky-500/90 hover:bg-sky-400 text-white font-semibold shadow-lg shadow-sky-500/20 transition"
                            >
                                Confirmer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Aide -->
            <p class="mt-6 text-center text-xs text-white/60">
                Problème de mot de passe ?
                <a href="{{ route('password.request') }}" class="text-sky-400 hover:text-sky-300">Réinitialiser</a>
            </p>
        </div>
    </div>
</x-guest-layout>
