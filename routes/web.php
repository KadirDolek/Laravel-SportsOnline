<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\ProfileController;

// Routes publiques
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/equipes', [EquipeController::class, 'index'])->name('equipes.index');
Route::get('/equipes/{equipe}', [EquipeController::class, 'show'])->name('equipes.show');
Route::get('/joueurs', [JoueurController::class, 'index'])->name('joueurs.index');
Route::get('/joueurs/{joueur}', [JoueurController::class, 'show'])->name('joueurs.show');

// Routes protégées
Route::middleware(['auth', 'can:is-staff'])->group(function () {
    // Routes joueurs
    Route::get('/joueurs/create', [JoueurController::class, 'create'])->name('joueurs.create');
    Route::post('/joueurs', [JoueurController::class, 'store'])->name('joueurs.store');
    Route::get('/joueurs/{joueur}/edit', [JoueurController::class, 'edit'])->name('joueurs.edit'); 
    Route::put('/joueurs/{joueur}', [JoueurController::class, 'update'])->name('joueurs.update'); 
    
    // Routes équipes
    Route::get('/equipes/create', [EquipeController::class, 'create'])->name('equipes.create');
    Route::post('/equipes', [EquipeController::class, 'store'])->name('equipes.store');
});

// Routes de profil (si vous les voulez)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes d'authentification Breeze
require __DIR__.'/auth.php';