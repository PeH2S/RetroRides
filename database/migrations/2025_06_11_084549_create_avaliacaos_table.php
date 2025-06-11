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
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('avaliador_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('anunciante_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('anuncio_id')->constrained('anuncios')->onDelete('cascade');
            $table->integer('nota')->unsigned()->between(1, 5);
            $table->text('comentario')->nullable();
            $table->timestamps();

            $table->unique(['avaliador_id', 'anuncio_id']); // Cada usuário só pode avaliar um anúncio uma vez
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacaos');
    }
};
