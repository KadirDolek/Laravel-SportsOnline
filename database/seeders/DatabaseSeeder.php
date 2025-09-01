<?php

namespace Database\Seeders;

use App\Models\Continent;
use App\Models\Equipe;
use App\Models\Genre;
use App\Models\Joueur;
use App\Models\Position;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Création des genres
        $genres = ['Homme', 'Femme', 'Mixte'];
        foreach ($genres as $genre) {
           Genre::create(['genre' => $genre]);
        }
        
        // Création des continents
        $continents = ['Europe', 'Amérique du Nord', 'Amérique du Sud', 'Afrique', 'Asie', 'Océanie'];
        foreach ($continents as $continent) {
            Continent::create(['nom' => $continent]);
        }
        
        // Création des positions
        $positions = [
            ['position' => 'Gardien', 'max_players' => 2],
            ['position' => 'Défenseur', 'max_players' => 4],
            ['position' => 'Milieu', 'max_players' => 4],
            ['position' => 'Attaquant', 'max_players' => 4],
            ['position' => 'Réserve', 'max_players' => 5]
        ];
        foreach ($positions as $position) {
        Position::create($position);
        }
        
        // Création des utilisateurs avec rôles
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
        
        User::factory()->create([
            'name' => 'Coach User',
            'email' => 'coach@example.com',
            'password' => bcrypt('password'),
            'role' => 'coach',
        ]);
        
        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => 'utilisateur',
        ]);
        
        // Création des équipes (8 équipes)
        Equipe::factory()->count(8)->create();
        
        // Création des joueurs (40 joueurs)
        Joueur::factory()->count(40)->create();
    }
}
