<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visiteur extends Model
{
    use HasFactory;
    protected $fillable = [
        'cni',
        'nom',
        'prenom',
        'date',
        'heure_arrive',
        'heure_depart',
        'motif',
        'user_id',
        'locataire_id'
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
