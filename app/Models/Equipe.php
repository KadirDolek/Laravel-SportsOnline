<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipe extends Model
{
    use HasFactory;
    
    protected $fillable = ['nom', 'ville', 'pays', 'continent_id', 'genre_id', 'user_id'];
    
    public function continent()
    {
        return $this->belongsTo(Continent::class);
    }
    
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function joueurs()
    {
        return $this->hasMany(Joueur::class);
    }
    
    public function getJoueursCountByPosition($position_id)
    {
        return $this->joueurs()->where('position_id', $position_id)->where('is_reserve', false)->count();
    }
    
    public function getReserveCount()
    {
        return $this->joueurs()->where('is_reserve', true)->count();
    }
    
    public function canAddPlayer($position_id = null)
    {
        $max_players = 15;
        $max_reserve = 5;
        
        if ($this->joueurs()->count() >= $max_players) {
            return false;
        }
        
        if ($position_id) {
            $position = Position::find($position_id);
            if ($this->getJoueursCountByPosition($position_id) >= $position->max_players) {
                if ($this->getReserveCount() >= $max_reserve) {
                    return false;
                }
            }
        }
        
        return true;
    }

}
