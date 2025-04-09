<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executa as migrações.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 150)->unique();
            $table->string('password');
            $table->string('phone', 20)->nullable();
            $table->string('cpf_cnpj', 14)->unique()->comment('Armazenado sem formatação, apenas números');
            $table->text('address')->nullable();
            $table->rememberToken(); // Adicionado para autenticação
            $table->timestamp('email_verified_at')->nullable(); // Para verificação de email
            $table->softDeletes(); // Para exclusão lógica
            $table->timestamps();
            
            // Índices adicionais para melhor performance
            $table->index('name');
            $table->index('email');
        });
    }

    /**
     * Reverte as migrações.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};