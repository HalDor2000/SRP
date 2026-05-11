<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Razonabilidad extends Model
{
    protected $table = 'razonabilidades';

    protected $fillable = [
        'solicitud_id',
        'observaciones',
        'conclusion',
        'fecha',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    public function solicitud()
    {
        return $this->belongsTo(
            Solicitud::class
        );
    }

    public function detalles()
    {
        return $this->hasMany(
            RazonabilidadDetalle::class
        );
    }
}