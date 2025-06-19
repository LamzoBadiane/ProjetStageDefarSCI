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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //  étudiant concerné
            $table->foreignId('application_id')->constrained()->onDelete('cascade'); // candidature liée
            $table->date('date');
            $table->time('time');
            $table->enum('mode', ['en ligne', 'présentiel']);
            $table->string('location')->nullable(); // lien visio ou lieu
            $table->text('message')->nullable();    // message facultatif pour l’étudiant
            $table->enum('status', ['prévu', 'terminé', 'annulé'])->default('prévu');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
