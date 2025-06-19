<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('applications', 'deleted_at')) {
            Schema::table('applications', function (Blueprint $table) {
                $table->softDeletes();
            });
        }

        if (!Schema::hasColumn('interviews', 'deleted_at')) {
            Schema::table('interviews', function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }

    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('interviews', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
