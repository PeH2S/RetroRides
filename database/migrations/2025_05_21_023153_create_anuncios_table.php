<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('anuncios', function (Blueprint $table) {
            $table->id();
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
