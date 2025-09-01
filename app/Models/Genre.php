<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genre extends Model
{
    use HasFactory;
    
    protected $fillable = ['genre'];
    
    public function equipes()
    {
        return $this->hasMany(Equipe::class);
    }
    
    public function joueurs()
    {
        return $this->hasMany(Joueur::class);
    }
}
