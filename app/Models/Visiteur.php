<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visiteur extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_carte',
        'numero_carte',
        'photo_carte',
        'nom',
        'prenom',
        'photo_visiteur',
        'date',
        'heure_arrive',
        'heure_depart',
        'statut',
        'motif',
        'user_id',
        'locataire_id',
        'banned',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function locataire()
    {
         return $this->belongsTo(Locataire::class);
     }

      public function scopeBanned($query)
    {
        return $query->where('banned', true);
    }

    // Scope pour les visiteurs non bannis
    public function scopeNotBanned($query)
    {
        return $query->where('banned', false);
    }

    // Méthode pour bannir un visiteur
    public function ban()
    {
        $this->update(['banned' => true]);
    }
    // Méthode pour lever le bannissement
    public function unban()
    {
        $this->update(['banned' => false]);
    }
}


