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
    public function edit(Equipe $equipe)
{
    $this->authorize('manage-equipe', $equipe); // Utilisation du nouveau Gate
        
    $continents = Continent::all();
    $genres = Genre::all();
    
    return view('equipes.edit', compact('equipe', 'continents', 'genres'));
}

public function update(Request $request, Equipe $equipe)
{
    $this->authorize('manage-equipe', $equipe);
    
    $request->validate([
        'nom' => 'required|unique:equipes,nom,' . $equipe->id,
        'ville' => 'required',
        'pays' => 'required',
        'continent_id' => 'required|exists:continents,id',
        'genre_id' => 'required|exists:genres,id'
    ]);
    
    $equipe->update($request->all());
    
    return redirect()->route('equipes.show', $equipe)->with('success', 'Équipe modifiée avec succès');
}

public function destroy(Equipe $equipe)
{
    $this->authorize('manage-equipe', $equipe);
    
    // Vérifier si l'utilisateur est admin - il peut supprimer même avec des joueurs
    if (auth()->user()->role !== 'admin') {
        // Pour les coaches, vérifier si l'équipe a des joueurs
        if ($equipe->joueurs()->count() > 0) {
            return redirect()->back()->with('error', 'Impossible de supprimer une équipe qui contient des joueurs');
        }
    } else {
        // Si admin, supprimer aussi les joueurs associés
        $equipe->joueurs()->delete();
    }
    
    $equipe->delete();
    
    return redirect()->route('equipes.index')->with('success', 'Équipe supprimée avec succès');
}
}
