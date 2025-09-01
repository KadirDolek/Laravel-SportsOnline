<?php

use App\Http\Controllers\EquipeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/equipes', [EquipeController::class, 'index'])->name('equipes.index');
Route::get('/equipes/{equipe}', [EquipeController::class, 'show'])->name('equipes.show');
Route::middleware(['auth', 'can:is-staff'])->group(function () {
    Route::get('/equipes/create', [EquipeController::class, 'create'])->name('equipes.create');
    Route::post('/equipes', [EquipeController::class, 'store'])->name('equipes.store');
});

// Routes pour les joueurs

Route::get('/joueurs/{joueur}', [JoueurController::class, 'show'])->name('joueurs.show');
Route::middleware(['auth', 'can:is-staff'])->group(function () {
    Route::get('/joueurs/create', [JoueurController::class, 'create'])->name('joueurs.create');
    Route::post('/joueurs', [JoueurController::class, 'store'])->name('joueurs.store');
    Route::get('/joueurs', [ProfileController::class, 'edit'])->name('joueurs.edit');
});
Route::get('/joueurs', [JoueurController::class, 'index'])->name('joueurs.index');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Routes d'authentification Breeze
require __DIR__.'/auth.php';
