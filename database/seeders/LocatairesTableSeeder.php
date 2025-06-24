<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Locataire;

class LocatairesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $locataires=[
            [
                'nom'=>'PPPP',
                'prenom'=>'mm',
                'telephone'=>'345276',
                'numero_etage'=>'12',
                'numero_chambre'=>'3',
            
            ],
            [
                'nom'=>'NEO START',
                'prenom'=>'TECHNOLOGY',
                'telephone'=>'90198273',
                'numero_etage'=>'2',
                'numero_chambre'=>'20',
            
            ],[
                'nom'=>'AZERT',
                'prenom'=>'iuop',
                'telephone'=>'22342563',
                'numero_etage'=>'1',
                'numero_chambre'=>'9',
            
            ],[
                'nom'=>'NNN',
                'prenom'=>'services',
                'telephone'=>'64534563',
                'numero_etage'=>'4',
                'numero_chambre'=>'12',
            
            ],
        ];
        foreach($locataires as $locataire){
            Locataire::create($locataire);
        }
        //
    }
}
