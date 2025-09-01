<!-- resources/views/layouts/footer.blade.php -->
<footer class="bg-gray-800 text-white py-8 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-semibold mb-4">Plateforme Football</h3>
                <p class="text-gray-300">Gérez vos équipes et joueurs de football en toute simplicité.</p>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold mb-4">Liens rapides</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white">Accueil</a></li>
                    <li><a href="{{ route('equipes.index') }}" class="text-gray-300 hover:text-white">Équipes</a></li>
                    <li><a href="{{ route('joueurs.index') }}" class="text-gray-300 hover:text-white">Joueurs</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold mb-4">Contact</h3>
                <p class="text-gray-300">Email: contact@footballplatform.com</p>
                <p class="text-gray-300">Téléphone: +33 1 23 45 67 89</p>
            </div>
        </div>
        
        <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} Plateforme Football. Tous droits réservés.</p>
        </div>
    </div>
</footer>