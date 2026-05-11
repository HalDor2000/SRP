<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\Models\OfertaDetalle;
use App\Models\Proveedor;
use App\Models\Solicitud;
use Illuminate\Http\Request;

class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(
        Solicitud $solicitud
    ) {
        $solicitud->load('items');
        $proveedores = Proveedor::where(
            'activo',
            1
        )->orderBy(
            'nombre'
        )->get();

        return view(
            'ofertas.create',
            compact(
                'solicitud',
                'proveedores'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        Request $request,
        Solicitud $solicitud
    ) {
        /*
    |--------------------------------------------------------------------------
    | CREAR OFERTA
    |--------------------------------------------------------------------------
    */
        $oferta = Oferta::create([
            'solicitud_id' => $solicitud->id,
            'proveedor_id' => $request->proveedor_id,
            'fecha_oferta' => $request->fecha_oferta,
        ]);
        /*
    |--------------------------------------------------------------------------
    | DETALLES
    |--------------------------------------------------------------------------
    */
        foreach ($request->items as $item) {
            OfertaDetalle::create([
                'oferta_id' => $oferta->id,
                'solicitud_item_id' =>
                $item['solicitud_item_id'],
                'precio_unitario' =>
                $item['precio_unitario'] ?? 0,
                'no_oferto' =>
                isset($item['no_oferto'])
                    ? 1
                    : 0,
            ]);
        }
        /*
    |--------------------------------------------------------------------------
    | REDIRECT
    |--------------------------------------------------------------------------
    */
        return redirect()
            ->route(
                'solicitudes.show',
                $solicitud
            )
            ->with(
                'success',
                'Oferta registrada correctamente'
            );
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Oferta $oferta
    ) {
        /*
        | LOAD
        */
        $oferta->load([
            'solicitud.items',
            'proveedor',
            'detalles',
        ]);
        /*
        | PROVEEDORES
        */
        $proveedores = Proveedor::where(
            'activo',
            1
        )->orderBy(
            'nombre'
        )->get();
        /*
        | VIEW
        */
        return view(
            'ofertas.edit',
            compact(
                'oferta',
                'proveedores'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        Oferta $oferta
    ) {
        /*
        | UPDATE OFERTA
        */
        $oferta->update([
            'proveedor_id' =>
            $request->proveedor_id,
            'fecha_oferta' =>
            $request->fecha_oferta,
        ]);
        /*
        | DETALLES
        */
        foreach ($request->items as $item) {
            $detalle = OfertaDetalle::where(
                'oferta_id',
                $oferta->id
            )->where(
                'solicitud_item_id',
                $item['solicitud_item_id']
            )->first();
            if ($detalle) {
                $detalle->update([
                    'precio_unitario' =>
                    $item['precio_unitario'] ?? 0,
                    'no_oferto' =>
                    isset($item['no_oferto'])
                        ? 1
                        : 0,
                ]);
            }
        }
        /*
        | REDIRECT
        */
        return redirect()
            ->route(
                'solicitudes.show',
                $oferta->solicitud_id
            )
            ->with(
                'success',
                'Oferta actualizada correctamente'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Oferta $oferta
    ) {
        /*
    |--------------------------------------------------------------------------
    | ELIMINAR DETALLES
    |--------------------------------------------------------------------------
    */
        $oferta->detalles()->delete();

        /*
        | GUARDAR SOLICITUD
        */
        $solicitudId = $oferta->solicitud_id;
        /*
        | ELIMINAR OFERTA
        */
        $oferta->delete();
        /*
        | REDIRECT
        */
        return redirect()
            ->route(
                'solicitudes.show',
                $solicitudId
            )
            ->with(
                'success',
                'Oferta eliminada correctamente'
            );
    }
}
