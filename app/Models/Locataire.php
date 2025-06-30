<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Locataire extends Model
{
    use HasFactory,Notifiable;
    protected $fillable=[
        'nom',
        'prenom',
        'email',
        'type_resident',
        'telephone',  
        'numero_etage',
        'numero_chambre',
        'photo',
    ];
    public function visiteurs()
    {
        return $this->hasMany(Visiteur::class);
    }
   
}
