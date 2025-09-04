<!-- resources/views/layouts/footer.blade.php -->
<footer class="mt-16 border-t border-white/10 bg-[#030617]/80 backdrop-blur text-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Brand -->
            <div>
                <h3 class="text-lg font-semibold">Plateforme Football</h3>
                <p class="mt-2 text-gray-300">
                    Gérez vos équipes et joueurs de football en toute simplicité.
                </p>
            </div>

            <!-- Quick links -->
            <div>
                <h3 class="text-lg font-semibold">Liens rapides</h3>
                <ul class="mt-3 space-y-2">
                    <li>
                        <a href="{{ route('home') }}" class="text-white/80 hover:text-white">
                            Accueil
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('equipes.index') }}" class="text-white/80 hover:text-white">
                            Équipes
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('joueurs.index') }}" class="text-white/80 hover:text-white">
                            Joueurs
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-lg font-semibold">Contact</h3>
                <ul class="mt-3 space-y-2 text-white/80">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M2.94 6.34l6.47 4.62c.36.26.82.26 1.18 0l6.47-4.62A2 2 0 0016.5 4h-13a2 2 0 00-1.56 2.34z"/><path d="M18 8.12l-6.14 4.39a3 3 0 01-3.72 0L2 8.12V14a2 2 0 002 2h12a2 2 0 002-2V8.12z"/></svg>
                        <a href="mailto:contact@footballplatform.com" class="hover:text-white">
                            contact@footballplatform.com
                        </a>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 5a2 2 0 012-2h3l2 4-2 1a12 12 0 005 5l1-2 4 2v3a2 2 0 01-2 2h-1C9.163 18 6 14.837 6 11V10"/>
                        </svg>
                        <a href="tel:+33123456789" class="hover:text-white">
                            +33 1 23 45 67 89
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-10 border-t border-white/10 pt-6 flex flex-col md:flex-row items-center justify-between gap-3 text-sm text-white/60">
            <p>&copy; {{ date('Y') }} Plateforme Football. Tous droits réservés. Projet réalisé par Kadir Dolek & Ali Jaber</p>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-white">Mentions légales</a>
                <a href="#" class="hover:text-white">Confidentialité</a>
            </div>
        </div>
    </div>
</footer>
