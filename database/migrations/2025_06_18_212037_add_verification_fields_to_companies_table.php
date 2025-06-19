<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVerificationFieldsToCompaniesTable extends Migration
{
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            if (!Schema::hasColumn('companies', 'ninea')) {
                $table->string('ninea')->nullable()->after('name');
            }
            if (!Schema::hasColumn('companies', 'rccm')) {
                $table->string('rccm')->nullable()->after('ninea');
            }
            if (!Schema::hasColumn('companies', 'address')) {
                $table->string('address')->nullable()->after('rccm');
            }
            if (!Schema::hasColumn('companies', 'contact_phone')) {
                $table->string('contact_phone')->nullable()->after('address');
            }
            if (!Schema::hasColumn('companies', 'company_story')) {
                $table->text('company_story')->nullable()->after('contact_phone');
            }

            if (!Schema::hasColumn('companies', 'document')) {
                $table->string('document')->nullable()->after('company_story');
            }

            if (!Schema::hasColumn('companies', 'status')) {
                $table->enum('status', ['en attente', 'validée', 'refusée'])->default('en attente')->after('document');            
            }
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'ninea',
                'rccm',
                'address',
                'contact_phone',
                'company_story',
                'document',
                'status',
            ]);
        });
    }
}