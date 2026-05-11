<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OfertaDetalle extends Model
{
    use HasFactory;

    protected $table = 'oferta_detalles';

    protected $fillable = [
        'oferta_id',
        'solicitud_item_id',
        'precio_unitario',
        'no_oferto',
    ];

    protected $casts = [
        'no_oferto' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    public function oferta()
    {
        return $this->belongsTo(
            Oferta::class
        );
    }

    public function solicitudItem()
    {
        return $this->belongsTo(
            SolicitudItem::class
        );
    }
}