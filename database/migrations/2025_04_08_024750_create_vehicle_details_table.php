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
        Schema::create('vehicle_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('model_year_id')->constrained();
            $table->string('fipe_code');
            $table->string('fuel');
            $table->string('fuel_acronym');
            $table->decimal('price', 12, 2);
            $table->string('model_year'); // Ano do modelo (pode ser diferente do ano de referência)
            $table->string('reference_month');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_details');
    }
};
