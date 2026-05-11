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
        Schema::create('razonabilidades', function (Blueprint $table) {
            $table->id();

            /*
    |--------------------------------------------------------------------------
    | RELACIÓN
    |--------------------------------------------------------------------------
    */
            $table->foreignId('solicitud_id')
                ->constrained('solicitudes')
                ->onDelete('cascade');
            /*
    |--------------------------------------------------------------------------
    | GENERAL
    |--------------------------------------------------------------------------
    */
            $table->text('observaciones')
                ->nullable();

            $table->text('conclusion')
                ->nullable();

            $table->date('fecha')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('razonabilidads');
    }
};
