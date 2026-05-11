<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RazonabilidadDetalle extends Model
{
    protected $table = 'razonabilidad_detalles';

    protected $fillable = [
        'razonabilidad_id',
        'solicitud_item_id',
        'proveedor_id',
        'precio_recomendado',
        'observacion',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    public function razonabilidad()
    {
        return $this->belongsTo(
            Razonabilidad::class
        );
    }

    public function solicitudItem()
    {
        return $this->belongsTo(
            SolicitudItem::class
        );
    }

    public function proveedor()
    {
        return $this->belongsTo(
            Proveedor::class
        );
    }
}