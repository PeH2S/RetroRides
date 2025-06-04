<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('anuncio_fotos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('anuncio_id')
                  ->constrained('anuncios')
                  ->onDelete('cascade');

            $table->string('caminho');
            $table->boolean('principal')->default(false);
            $table->integer('ordem')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anuncio_fotos');
    }
};
