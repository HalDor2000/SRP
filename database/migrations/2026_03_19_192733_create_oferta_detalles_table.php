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
        Schema::create('oferta_detalles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('oferta_id')->constrained('ofertas')->cascadeOnDelete();
            $table->foreignId('solicitud_item_id')->constrained('solicitud_items')->cascadeOnDelete();

            $table->decimal('precio_unitario', 12, 2)->nullable();
            $table->boolean('no_oferto')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oferta_detalles');
    }
};
