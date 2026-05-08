<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\SolicitudItem;
use Illuminate\Http\Request;

class SolicitudItemController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ultimoItem = SolicitudItem::where(
            'solicitud_id',
            $request->solicitud_id
        )->max('item');
        $nuevoItem = $ultimoItem
            ? $ultimoItem + 1
            : 1;
        $total = (
            $request->cantidad *
            $request->costo_estimado_unitario
        );
        SolicitudItem::create([
            'solicitud_id' => $request->solicitud_id,
            'item' => $nuevoItem,
            'descripcion' => $request->descripcion,
            'cantidad' => $request->cantidad,
            'unidad_medida' => $request->unidad_medida,
            'costo_estimado_unitario' =>
            $request->costo_estimado_unitario,
            'costo_total' => $total,
            'codigo_especifico' =>
            $request->codigo_especifico,
        ]);
        $solicitud = Solicitud::findOrFail(
            $request->solicitud_id
        );
        $solicitud->recalcularTotal();
        return back()->with(
            'success',
            'Item agregado correctamente'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(SolicitudItem $solicitudItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SolicitudItem $solicitudItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        SolicitudItem $solicitud_item
    ) {
        $total = (
            $request->cantidad *
            $request->costo_estimado_unitario
        );
        $solicitud_item->update([
            'descripcion' => $request->descripcion,
            'cantidad' => $request->cantidad,
            'unidad_medida' =>
            $request->unidad_medida,
            'costo_estimado_unitario' =>
            $request->costo_estimado_unitario,
            'costo_total' => $total,
            'codigo_especifico' =>
            $request->codigo_especifico,
        ]);
        $solicitud_item
            ->solicitud
            ->recalcularTotal();
        return back()->with(
            'success',
            'Item actualizado correctamente'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        SolicitudItem $solicitud_item
    ) {
        /*OBTENER SOLICITUD RELACIONADA*/
        $solicitud = $solicitud_item->solicitud;
        /*ELIMINAR ITEM    */
        $solicitud_item->delete();
        /*RECALCULAR TOTAL*/
        $solicitud->recalcularTotal();
        /*REDIRECT*/
        return back()->with(
            'success',
            'Item eliminado correctamente'
        );
    }
}
