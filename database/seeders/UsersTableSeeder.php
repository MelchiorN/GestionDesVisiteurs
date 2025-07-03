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
            'nom' => 'Admin',
            'prenom' => 'Hubert',
            'telephone' => '90546756',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('agent1243'),
            'role' => 'admin',
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
