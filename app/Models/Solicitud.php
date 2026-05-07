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
    ];
}
