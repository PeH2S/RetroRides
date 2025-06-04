<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Coluna gênero (string/nullable)
            $table->string('gender')->nullable()->after('password');
            // Coluna data de nascimento (date/nullable)
            $table->date('birthdate')->nullable()->after('gender');
            // Coluna CPF (string/nullable)
            $table->string('cpf', 14)->nullable()->after('birthdate');
            // Coluna telefone (string/nullable)
            $table->string('phone', 20)->nullable()->after('cpf');
            // Coluna flag para exibir telefone no anúncio (boolean/nullable)
            $table->boolean('show_phone')->default(false)->after('phone');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['gender', 'birthdate', 'cpf', 'phone', 'show_phone']);
        });
    }
};
