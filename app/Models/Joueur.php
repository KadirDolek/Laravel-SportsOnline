<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Joueur extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nom', 'prenom', 'age', 'phone', 'email', 'pays', 
        'position_id', 'equipe_id', 'genre_id', 'photo_id', 'user_id', 'is_reserve'
    ];
    
    public function position()
    {
        return $this->belongsTo(Position::class);
    }
    
    public function equipe()
    {
        return $this->belongsTo(Equipe::class);
    }
    
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo->src);
        }
        
        $defaultImages = [
            1 => 'default_male.jpg',
            2 => 'default_female.jpg',
            3 => 'default_mixed.jpg'
        ];
        
        return asset('images/' . ($defaultImages[$this->genre_id] ?? 'default.jpg'));
    }
}
