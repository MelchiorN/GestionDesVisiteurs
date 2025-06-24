<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locataire extends Model
{
    use HasFactory;
    protected $fillable=[
        'nom',
        'prenom',
        'telephone',  
        'numero_etage',
        'numero_chambre',
    ];
    public function visiteurs()
    {
        return $this->hasMany(Visiteur::class);
    }
}
