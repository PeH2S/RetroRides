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
        Schema::create('anuncios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('marca');
            $table->string('modelo');
            $table->string('ano_modelo');
            $table->string('ano_fabricacao');
            $table->string('cor');
            $table->string('combustivel');
            $table->integer('portas');
            $table->string('placa')->nullable();
            $table->string('situacao');
            $table->string('localizacao');
            $table->text('descricao')->nullable();
            $table->text('detalhes')->nullable();
            $table->integer('quilometragem');
            $table->decimal('preco', 10, 2);
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anuncios');
    }
};
