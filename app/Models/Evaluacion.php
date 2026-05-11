<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluacion extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones';

    protected $fillable = [

        'solicitud_id',

        'observaciones',

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
}