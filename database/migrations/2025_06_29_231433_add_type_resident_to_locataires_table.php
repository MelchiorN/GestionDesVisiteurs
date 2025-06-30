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
        Schema::table('locataires', function (Blueprint $table) {
              $table->string('email')->after('prenom');
             $table->string('type_resident')->after('email');
        
                  
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locataires', function (Blueprint $table) {
             $table->dropColumn('type_resident');
              $table->dropColumn('email');
            //
        });
    }
};
