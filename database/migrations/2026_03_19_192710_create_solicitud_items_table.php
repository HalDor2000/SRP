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
        Schema::create('solicitud_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solicitud_id')
                ->constrained('solicitudes')
                ->cascadeOnDelete();

            $table->string('item'); // ITEM 1
            $table->string('descripcion');
            $table->integer('cantidad');
            $table->string('unidad_medida')->default('UNIDAD');

            $table->decimal('costo_estimado_unitario', 12, 2);
            $table->decimal('costo_total', 12, 2)->nullable();

            $table->string('codigo_especifico')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_items');
    }
};
