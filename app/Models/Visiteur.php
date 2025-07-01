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

     
}


