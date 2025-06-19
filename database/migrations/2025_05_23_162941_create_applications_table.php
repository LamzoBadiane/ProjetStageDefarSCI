<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('offer_id')->constrained()->onDelete('cascade');
            $table->text('motivation')->nullable();
            $table->string('motivation_file')->nullable(); // Fichier PDF/DOC
            $table->string('cv_file')->nullable(); // Fichier CV PDF/DOC
            $table->string('status')->default('en attente');
            $table->softDeletes(); // dans la migration
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
