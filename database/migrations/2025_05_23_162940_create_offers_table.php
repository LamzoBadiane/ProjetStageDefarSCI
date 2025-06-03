<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécuter les migrations.
     */
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Titre de l'offre
            $table->text('description'); // Description détaillée
            $table->string('domain'); // Domaine (ex : Informatique, Marketing)
            $table->string('type'); // Type (Stage, CDI, CDD)
            $table->string('location'); // Lieu géographique
            $table->date('deadline'); // Date limite de candidature
            $table->timestamps();
        });
    }

    /**
     * Annuler les migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
