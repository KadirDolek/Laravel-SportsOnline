<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Joueur;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Équipes européennes
        $europeanTeams = Equipe::withCount('joueurs')
            ->whereHas('continent', function($query) {
                $query->where('nom', 'Europe');
            })
            ->inRandomOrder()
            ->limit(8)
            ->get();

        // Joueurs aléatoires d'équipes européennes
        $europeanPlayers = Joueur::with(['equipe', 'position'])
            ->whereHas('equipe.continent', function($query) {
                $query->where('nom', 'Europe');
            })
            ->inRandomOrder()
            ->limit(8)
            ->get();

        // Équipes hors Europe
        $nonEuropeanTeams = Equipe::with('continent')
            ->whereHas('continent', function($query) {
                $query->where('nom', '!=', 'Europe');
            })
            ->inRandomOrder()
            ->limit(4)
            ->get();

        // Joueuses hors Europe
        $nonEuropeanFemalePlayers = Joueur::with(['equipe', 'position'])
            ->whereHas('equipe.continent', function($query) {
                $query->where('nom', '!=', 'Europe');
            })
            ->whereHas('genre', function($query) {
                $query->where('genre', 'Femme');
            })
            ->inRandomOrder()
            ->limit(8)
            ->get();

        // Joueurs sans équipe
        $playersWithoutTeam = Joueur::with('position')
            ->whereNull('equipe_id')
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('home', compact(
            'europeanTeams',
            'europeanPlayers',
            'nonEuropeanTeams',
            'nonEuropeanFemalePlayers',
            'playersWithoutTeam'
        ));
    }
}
