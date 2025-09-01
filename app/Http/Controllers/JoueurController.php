<?php

namespace App\Http\Controllers;

use App\Models\Joueur;
use App\Models\Equipe;
use App\Models\Position;
use App\Models\Genre;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JoueurController extends Controller
{
    public function index(Request $request)
    {
        $genreId = $request->input('genre');
        $query = Joueur::with(['equipe', 'position', 'genre']);
        
        if ($genreId) {
            $query->where('genre_id', $genreId);
        }
        
        $joueurs = $query->get();
        $genres = Genre::all();
        
        return view('joueurs.index', compact('joueurs', 'genres'));
    }
    
    public function show(Joueur $joueur)
    {
        return view('joueurs.show', compact('joueur'));
    }
    
    public function create()
    {
        $this->authorize('is-staff');
        
        $equipes = Equipe::all();
        $positions = Position::where('position', '!=', 'Réserve')->get();
        $genres = Genre::all();
        
        return view('joueurs.create', compact('equipes', 'positions', 'genres'));
    }
    
    public function store(Request $request)
    {
        $this->authorize('is-staff');
        
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'age' => 'required|integer|min:16|max:45',
            'email' => 'required|email|unique:joueurs',
            'pays' => 'required',
            'position_id' => 'required|exists:positions,id',
            'equipe_id' => 'nullable|exists:equipes,id',
            'genre_id' => 'required|exists:genres,id',
            'photo' => 'nullable|image|max:2048'
        ]);
        
        $equipe = null;
        $isReserve = false;
        
        if ($request->equipe_id) {
            $equipe = Equipe::find($request->equipe_id);
            
            // Vérifier que le genre correspond
            if ($equipe->genre_id != $request->genre_id) {
                return back()->with('error', 'Le genre du joueur ne correspond pas à celui de l\'équipe')->withInput();
            }
            
            // Vérifier si l'équipe peut accepter un nouveau joueur
            if (!$equipe->canAddPlayer($request->position_id)) {
                return back()->with('error', 'L\'équipe a atteint son quota maximum de joueurs')->withInput();
            }
            
            // Vérifier si la position est complète
            $positionCount = $equipe->getJoueursCountByPosition($request->position_id);
            $position = Position::find($request->position_id);
            
            if ($positionCount >= $position->max_players) {
                $isReserve = true;
                
                // Vérifier si la réserve est complète
                if ($equipe->getReserveCount() >= 5) {
                    return back()->with('error', 'L\'équipe a atteint son quota maximum de réserves')->withInput();
                }
            }
        }
        
        // Gestion de l'upload de photo
        $photoId = null;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('players', 'public');
            $photo = Photo::create(['src' => $path]);
            $photoId = $photo->id;
        }
        
        Joueur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'age' => $request->age,
            'phone' => $request->phone,
            'email' => $request->email,
            'pays' => $request->pays,
            'position_id' => $request->position_id,
            'equipe_id' => $request->equipe_id,
            'genre_id' => $request->genre_id,
            'photo_id' => $photoId,
            'user_id' => Auth::id(),
            'is_reserve' => $isReserve
        ]);
        
        $message = $request->equipe_id ? 
            'Joueur ajouté à l\'équipe' . ($isReserve ? ' en tant que réserve' : '') : 
            'Joueur créé sans équipe';
            
        return redirect()->route('joueurs.index')->with('success', $message);
    }
    public function edit(Joueur $joueur)
{
    $this->authorize('is-staff');
    
    $equipes = Equipe::all();
    $positions = Position::where('position', '!=', 'Réserve')->get();
    $genres = Genre::all();
    
    return view('joueurs.edit', compact('joueur', 'equipes', 'positions', 'genres'));
    }

    public function update(Request $request, Joueur $joueur)
{
    $this->authorize('is-staff');
    
    $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'age' => 'required|integer|min:16|max:45',
        'email' => 'required|email|unique:joueurs,email,' . $joueur->id,
        'pays' => 'required',
        'position_id' => 'required|exists:positions,id',
        'equipe_id' => 'nullable|exists:equipes,id',
        'genre_id' => 'required|exists:genres,id',
        'photo' => 'nullable|image|max:2048'
    ]);
    
    $equipe = null;
    $isReserve = false;
    
    if ($request->equipe_id) {
        $equipe = Equipe::find($request->equipe_id);
        
        // Vérifier que le genre correspond
        if ($equipe->genre_id != $request->genre_id) {
            return back()->with('error', 'Le genre du joueur ne correspond pas à celui de l\'équipe')->withInput();
        }
        
        // Vérifier si l'équipe peut accepter un nouveau joueur (en excluant le joueur actuel)
        if (!$equipe->canAddPlayer($request->position_id, $joueur->id)) {
            return back()->with('error', 'L\'équipe a atteint son quota maximum de joueurs')->withInput();
        }
        
        // Vérifier si la position est complète (en excluant le joueur actuel)
        $positionCount = $equipe->getJoueursCountByPosition($request->position_id, $joueur->id);
        $position = Position::find($request->position_id);
        
        if ($positionCount >= $position->max_players) {
            $isReserve = true;
            
            // Vérifier si la réserve est complète (en excluant le joueur actuel)
            if ($equipe->getReserveCount($joueur->id) >= 5) {
                return back()->with('error', 'L\'équipe a atteint son quota maximum de réserves')->withInput();
            }
        }
    }
    
    // Gestion de l'upload de photo
    $photoId = $joueur->photo_id;
    if ($request->hasFile('photo')) {
        // Supprimer l'ancienne photo si elle existe
        if ($joueur->photo) {
            Storage::disk('public')->delete($joueur->photo->src);
            $joueur->photo->delete();
        }
        
        $path = $request->file('photo')->store('players', 'public');
        $photo = Photo::create(['src' => $path]);
        $photoId = $photo->id;
    }
    
    $joueur->update([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'age' => $request->age,
        'phone' => $request->phone,
        'email' => $request->email,
        'pays' => $request->pays,
        'position_id' => $request->position_id,
        'equipe_id' => $request->equipe_id,
        'genre_id' => $request->genre_id,
        'photo_id' => $photoId,
        'is_reserve' => $isReserve
    ]);
    
    $message = $request->equipe_id ? 
        'Joueur modifié' . ($isReserve ? ' (en tant que réserve)' : '') : 
        'Joueur modifié sans équipe';
        
    return redirect()->route('joueurs.show', $joueur)->with('success', $message);
    }
    
}
