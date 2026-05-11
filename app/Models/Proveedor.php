<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';
    protected $fillable = [
        'nombre',
        'correo',
        'contacto',
        'telefono',
        'activo',
        'nit',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function ofertas()
    {
        return $this->hasMany(
            Oferta::class
        );
    }

    public function razonabilidadDetalles()
    {
        return $this->hasMany(
            RazonabilidadDetalle::class
        );
    }
}
