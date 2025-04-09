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
        Schema::table('users', function (Blueprint $table) {
            $table->date('birth_date')->nullable()->after('phone');
            $table->string('rg', 20)->nullable()->after('birth_date');
            $table->string('company_name', 150)->nullable()->after('rg');
            $table->string('fantasy_name', 150)->nullable()->after('company_name');
            $table->string('company_email', 150)->nullable()->after('fantasy_name');
            $table->string('company_phone', 20)->nullable()->after('company_email');
            $table->string('state_registration', 50)->nullable()->after('company_phone');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'birth_date',
                'rg',
                'company_name',
                'fantasy_name',
                'company_email',
                'company_phone',
                'state_registration',
            ]);
        });
    }
};
