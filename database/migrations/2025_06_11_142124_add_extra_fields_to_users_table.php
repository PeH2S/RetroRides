<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'cpf')) {
                $table->string('cpf')->nullable();
            }
            if (! Schema::hasColumn('users', 'birthdate')) {
                $table->date('birthdate')->nullable();
            }
            if (! Schema::hasColumn('users', 'gender')) {
                $table->enum('gender', ['masculino','feminino','outro'])->nullable();
            }
            if (! Schema::hasColumn('users', 'cep')) {
                $table->string('cep', 9)->nullable();
            }
            if (! Schema::hasColumn('users', 'state')) {
                $table->string('state', 2)->nullable();
            }
            if (! Schema::hasColumn('users', 'city')) {
                $table->string('city')->nullable();
            }
            if (! Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (! Schema::hasColumn('users', 'show_phone')) {
                $table->boolean('show_phone')->default(false);
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'cpf')) {
                $table->dropColumn('cpf');
            }
            if (Schema::hasColumn('users', 'birthdate')) {
                $table->dropColumn('birthdate');
            }
            if (Schema::hasColumn('users', 'gender')) {
                $table->dropColumn('gender');
            }
            if (Schema::hasColumn('users', 'cep')) {
                $table->dropColumn('cep');
            }
            if (Schema::hasColumn('users', 'state')) {
                $table->dropColumn('state');
            }
            if (Schema::hasColumn('users', 'city')) {
                $table->dropColumn('city');
            }
            if (Schema::hasColumn('users', 'phone')) {
                $table->dropColumn('phone');
            }
            if (Schema::hasColumn('users', 'show_phone')) {
                $table->dropColumn('show_phone');
            }
        });
    }
};
