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
    // Si une photo upload existe, on l'utilise
    if ($this->photo) {
        return asset('storage/' . $this->photo->src);
    }

    // 1=Homme, 2=Femme, 3=Mixte (comme dans tes seeders)
    $byGenre = [
        1 => ['img/male1.jpg', 'img/male2.jpg', 'img/male3.jpg'],
        2 => ['img/femme1.jpg', 'img/femme2.jpg', 'img/femme3.jpg'],
        3 => ['img/mixt1.jpg', 'img/mixt2.jpg', 'img/mixt3.jpg'],
    ];

    $candidates = $byGenre[$this->genre_id] ?? ['img/mixt1.jpg'];

    // Choix déterministe pour que chaque joueur garde la même image
    $index = 0;
    if (!empty($candidates)) {
        $index = max(0, (($this->id ?? 0) % count($candidates)));
    }

    return asset($candidates[$index]);
}

}
