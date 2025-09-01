<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;
    
    protected $fillable = ['src'];
    
    public function joueur()
    {
        return $this->hasOne(Joueur::class);
    }
}
