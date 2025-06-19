<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->enum('status', ['en attente', 'validée', 'refusée'])
                ->default('en attente')
                ->after('document');
            $table->timestamp('rejected_at')->nullable()->after('status');
        }); 
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['status', 'rejected_at']);
        });
    }
};
