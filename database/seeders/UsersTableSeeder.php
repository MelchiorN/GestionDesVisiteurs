<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
{
    $agents = [
        [
            'nom' => 'Dupont',
            'prenom' => 'Jean',
            'telephone' => '243653553',
            'email' => 'jeandupont@gmail.com',
            'password' => Hash::make('agent123'),
            'role' => 'agent',
        ],
        [
            'nom' => 'Rene',
            'prenom' => 'Jacques',
            'telephone' => '33453764',
            'email' => 'jacquesrene2@gmail.com',
            'password' => Hash::make('agent2123'),
            // pas de role défini ici
        ],
        [
            'nom' => 'Lorentz',
            'prenom' => 'Hubert',
            'telephone' => '345347',
            'email' => 'lrtzhub23@gmail.com',
            'password' => Hash::make('agent1243'),
            'role' => 'admin',
        ],
        [
            'nom' => 'Yve',
            'prenom' => 'Yves',
            'telephone' => '24563474',
            'email' => 'yyves23t@gmail.com',
            'password' => Hash::make('agent1234'),
            // pas de role défini ici
        ],
    ];

    foreach ($agents as $agent) {
        if (!isset($agent['role'])) {
            $agent['role'] = 'agent'; // valeur par défaut
        }
        User::create($agent);
    }
}

}
