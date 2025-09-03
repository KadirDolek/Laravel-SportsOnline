<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('is-admin'); // Seul l'admin peut accéder
        
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $this->authorize('is-admin');
        
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('is-admin');
        
        $request->validate([
            'role' => 'required|in:admin,coach,utilisateur'
        ]);

        $user->update([
            'role' => $request->role
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Rôle utilisateur mis à jour avec succès');
    }

    public function destroy(User $user)
{
    $this->authorize('is-admin'); // Seul l'admin peut supprimer
    
    // Empêcher l'admin de se supprimer lui-même
    if ($user->id === auth()->id()) {
        return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
    }
    
    $user->delete();
    
    return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès');
}
}
