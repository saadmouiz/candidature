<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('beneficiaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidature_id');
            $table->foreign('candidature_id')->references('id')->on('candidatures');
            // Ajouter les mêmes champs que la table candidatures
            $table->string('nom');
            $table->string('prenom');
            $table->string('cin');
            $table->date('date_naissance');
            $table->string('email');
            $table->string('tel');
            $table->string('niveau_scolaire');
            $table->string('baccalaureat_path');
            $table->string('cin_path');
            $table->string('acte_path');
            $table->string('releve_notes_path');
            $table->string('photo_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiaires');
    }
};
