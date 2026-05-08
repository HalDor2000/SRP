<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SolicitudItem extends Model
{
    use HasFactory;

    protected $table = 'solicitud_items';

    protected $fillable = [
        'solicitud_id',
        'item',
        'descripcion',
        'cantidad',
        'unidad_medida',
        'costo_estimado_unitario',
        'costo_total',
        'codigo_especifico',
    ];

    protected $casts = [

        'cantidad' => 'integer',
        'costo_estimado_unitario' => 'decimal:2',
        'costo_total' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }
}
