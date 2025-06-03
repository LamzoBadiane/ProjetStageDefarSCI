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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom de l’entreprise
            $table->string('sector'); // Secteur d’activité
            $table->text('description')->nullable(); // Description
            $table->string('logo')->nullable(); // Logo

            $table->string('contact_name'); // Nom du contact RH
            $table->string('contact_email'); // Email du contact RH
            $table->string('contact_phone'); // Téléphone du contact RH

            $table->string('address'); // Adresse complète
            $table->string('city');
            $table->string('postal_code');
            $table->string('country');

            $table->string('email')->unique(); // Email de connexion
            $table->string('password'); // Mot de passe sécurisé
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
