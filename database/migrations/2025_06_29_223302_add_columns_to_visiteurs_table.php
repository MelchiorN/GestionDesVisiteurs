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
        Schema::table('visiteurs', function (Blueprint $table) {
             $table->string('type_carte')->after('id');
            $table->string('numero_carte')->after('type_carte');
            $table->string('photo_carte')->after('numero_carte');
            $table->string('photo_visiteur')->after('prenom');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visiteurs', function (Blueprint $table) {
             $table->dropColumn('type_carte');
             $table->dropColumn('numero_carte');
             $table->dropColumn('photo_carte');
             $table->dropColumn('photo_visiteur');
                //
        });
    }
};
