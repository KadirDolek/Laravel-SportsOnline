<!-- resources/views/profile/edit.blade.php -->
<x-app-layout>
    {{-- En-tête sombre cohérent avec la DA --}}
    <div class="relative isolate">
        <div class="relative h-48">
            <div class="absolute inset-0 -z-10">
                <div class="absolute inset-0 bg-gradient-to-b from-[#0b153a]/90 via-[#0a0f2b]/90 to-black/95"></div>
            </div>
            <div class="relative z-10 max-w-7xl mx-auto h-full px-6 lg:px-8 flex flex-col justify-center">
                <p class="text-sky-400 uppercase tracking-widest text-sm">Sports Online</p>
                <h1 class="text-3xl md:text-4xl font-extrabold text-white drop-shadow-xl">Profil</h1>
                <p class="mt-2 text-gray-300">Gérez vos informations, mot de passe et compte.</p>
            </div>
        </div>

        <!-- Contenu principal sombre -->
        <div class="bg-gradient-to-b from-black via-[#070b1f] to-[#050713] py-16">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-8">
                @include('components.flash-messages')

                <!-- Infos profil -->
                <section class="rounded-xl bg-white/5 border border-white/10 p-6 sm:p-8 backdrop-blur hover:border-sky-500/40 transition">
                    <header class="mb-4">
                        <h2 class="text-xl font-bold text-white">Informations du profil</h2>
                        <p class="text-sm text-gray-400">Mettez à jour votre nom, email, etc.</p>
                    </header>

                    <div
                        class="max-w-2xl text-gray-200
                               [&_label]:text-gray-200
                               [&_.text-gray-700]:!text-gray-200
                               [&_.text-gray-600]:!text-gray-300
                               [&_input]:bg-white/10 [&_input]:border-white/20 [&_input]:text-white [&_input]:placeholder-gray-400
                               [&_select]:bg-white/10 [&_select]:border-white/20 [&_select]:text-white
                               [&_textarea]:bg-white/10 [&_textarea]:border-white/20 [&_textarea]:text-white
                               [&_a]:text-sky-400 hover:[&_a]:text-sky-300">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </section>

                <!-- Mot de passe -->
                <section class="rounded-xl bg-white/5 border border-white/10 p-6 sm:p-8 backdrop-blur hover:border-sky-500/40 transition">
                    <header class="mb-4">
                        <h2 class="text-xl font-bold text-white">Mettre à jour le mot de passe</h2>
                        <p class="text-sm text-gray-400">Choisissez un mot de passe fort et unique.</p>
                    </header>

                    <div
                        class="max-w-2xl text-gray-200
                               [&_label]:text-gray-200
                               [&_.text-gray-700]:!text-gray-200
                               [&_input]:bg-white/10 [&_input]:border-white/20 [&_input]:text-white [&_input]:placeholder-gray-400">
                        @include('profile.partials.update-password-form')
                    </div>
                </section>

                <!-- Suppression du compte -->
                <section class="rounded-xl bg-white/5 border border-white/10 p-6 sm:p-8 backdrop-blur hover:border-sky-500/40 transition">
                    <header class="mb-4">
                        <h2 class="text-xl font-bold text-white">Supprimer le compte</h2>
                        <p class="text-sm text-gray-400">Action irréversible — supprime vos données et votre compte.</p>
                    </header>

                    <div
                        class="max-w-2xl text-gray-200
                               [&_label]:text-gray-200
                               [&_.text-gray-700]:!text-gray-200
                               [&_input]:bg-white/10 [&_input]:border-white/20 [&_input]:text-white
                               [&_button]:bg-red-600 [&_button:hover]:bg-red-500">
                        @include('profile.partials.delete-user-form')
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>