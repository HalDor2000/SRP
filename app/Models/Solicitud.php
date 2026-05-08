<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    //
    protected $table = 'solicitudes';
    protected $fillable = [
        'codigo',
        'nombre_proceso',
        'fecha',
        'total_estimado'
    ];
    protected $casts = [
        'fecha' => 'date',
        'total_estimado' => 'decimal:2',
    ];

    public function items()
    {
        return $this->hasMany(SolicitudItem::class);
    }

    public function recalcularTotal()
    {
        $this->total_estimado =
            $this->items()->sum('costo_total');

        $this->save();
    }
}
