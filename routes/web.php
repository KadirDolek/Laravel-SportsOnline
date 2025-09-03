<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;


// Routes publiques
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/equipes', [EquipeController::class, 'index'])->name('equipes.index');
Route::get('/joueurs', [JoueurController::class, 'index'])->name('joueurs.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/joueurs/create', [JoueurController::class, 'create'])->name('joueurs.create');
    Route::post('/joueurs', [JoueurController::class, 'store'])->name('joueurs.store');
});
// Routes protégées
Route::middleware(['auth', 'can:is-staff'])->group(function () {
// Routes joueurs
    Route::get('/joueurs/{joueur}/edit', [JoueurController::class, 'edit'])->name('joueurs.edit'); 
    Route::put('/joueurs/{joueur}', [JoueurController::class, 'update'])->name('joueurs.update'); 
    Route::delete('joueurs/{joueur}', [JoueurController::class, 'destroy'])->name('joueurs.destroy');
    
    // Routes équipes
    Route::get('/equipes/create', [EquipeController::class, 'create'])->name('equipes.create');
    Route::post('/equipes', [EquipeController::class, 'store'])->name('equipes.store');
    Route::get('/equipes/{equipe}/edit', [EquipeController::class, 'edit'])->name('equipes.edit');
    Route::put('/equipes/{equipe}', [EquipeController::class, 'update'])->name('equipes.update');
    Route::delete('/equipes/{equipe}', [EquipeController::class, 'destroy'])->name('equipes.destroy'); 
});
    Route::get('/joueurs/{joueur}', [JoueurController::class, 'show'])->name('joueurs.show');
    Route::get('/equipes/{equipe}', [EquipeController::class, 'show'])->name('equipes.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'can:is-admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); 
});

// Routes d'authentification Breeze
require __DIR__.'/auth.php';