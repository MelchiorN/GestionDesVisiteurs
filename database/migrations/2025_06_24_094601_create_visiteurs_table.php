<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('visiteurs', function (Blueprint $table) {
            $table->id();
              $table->string('type_carte');
              $table->string('numero_carte');
              $table->string('photo_carte');
            $table->string('nom');
            $table->string('prenom');
             $table->string('photo_visiteur');
            $table->date('date');
            $table->time('heure_arrive');
            $table->time('heure_depart')->nullable();
            $table->string('statut')->nullable();
            $table->string('motif');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('locataire_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visiteurs');
    }
};
