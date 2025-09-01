<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Continent extends Model
{
    use HasFactory;
    
    protected $fillable = ['nom'];
    
    public function equipes()
    {
        return $this->hasMany(Equipe::class);
    }
}
