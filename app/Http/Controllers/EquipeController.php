<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Continent;
use App\Models\Genre;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EquipeController extends Controller
{
    public function index(Request $request)
    {
        $continentId = $request->input('continent');
        $query = Equipe::with(['continent', 'genre']);
        
        if ($continentId) {
            $query->where('continent_id', $continentId);
        }
        
        $equipes = $query->get();
        $continents = Continent::all();
        
        return view('equipes.index', compact('equipes', 'continents'));
    }
    
    public function show(Equipe $equipe)
    {
        $joueurs = $equipe->joueurs()->with('position')->get();
        $positions = Position::all();
        
        return view('equipes.show', compact('equipe', 'joueurs', 'positions'));
    }
    
    public function create()
    {
        $this->authorize('is-staff');
        
        $continents = Continent::all();
        $genres = Genre::all();
        
        return view('equipes.create', compact('continents', 'genres'));
    }
    
    public function store(Request $request)
    {
        $this->authorize('is-staff');
        
        $request->validate([
            'nom' => 'required|unique:equipes',
            'ville' => 'required',
            'pays' => 'required',
            'continent_id' => 'required|exists:continents,id',
            'genre_id' => 'required|exists:genres,id'
        ]);
        
        Equipe::create([
            'nom' => $request->nom,
            'ville' => $request->ville,
            'pays' => $request->pays,
            'continent_id' => $request->continent_id,
            'genre_id' => $request->genre_id,
            'user_id' => Auth::id()
        ]);
        
        return redirect()->route('equipes.index')->with('success', 'Équipe créée avec succès');
    }
}
