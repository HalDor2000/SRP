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
        Schema::create('razonabilidad_detalles', function (Blueprint $table) {
            $table->id();
            /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */
            $table->foreignId('razonabilidad_id')
                ->constrained('razonabilidades')
                ->onDelete('cascade');

            $table->foreignId('solicitud_item_id')
                ->constrained('solicitud_items')
                ->onDelete('cascade');

            $table->foreignId('proveedor_id')
                ->constrained('proveedores')
                ->onDelete('cascade');
            /*
    |--------------------------------------------------------------------------
    | RESULTADO
    |--------------------------------------------------------------------------
    */
            $table->decimal(
                'precio_recomendado',
                12,
                2
            );
            $table->text('observacion')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('razonabilidad_detalles');
    }
};
