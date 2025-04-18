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
        Schema::create('refusees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidature_id')->constrained();
            $table->string('nom');
            $table->string('prenom');
            $table->string('cin')->unique();
            $table->date('date_naissance');
            $table->string('email')->unique();
            $table->string('tel')->unique();
            $table->string('niveau_scolaire');
            $table->string('baccalaureat_path');
            $table->string('cin_path');
            $table->string('acte_path');
            $table->string('releve_notes_path');
            $table->string('photo_path');
            $table->foreignId('admin_id')->constrained('users');
            $table->text('raison_refus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refusees');
    }
};