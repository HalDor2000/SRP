<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Oferta extends Model
{
    use HasFactory;

    protected $table = 'ofertas';

    protected $fillable = [
        'solicitud_id',
        'proveedor_id',
        'fecha_oferta',
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

    public function proveedor()
    {
        return $this->belongsTo(
            Proveedor::class
        );
    }

    public function detalles()
    {
        return $this->hasMany(
            OfertaDetalle::class
        );
    }
}