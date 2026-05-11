<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::orderBy(
            'id',
            'desc'
        )->get();

        return view(
            'proveedores.index',
            compact('proveedores')
        );
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
        //
        $request->validate([
            'nombre' => 'required|max:255',
            'correo' => 'nullable|email|max:255',
            'contacto' => 'nullable|max:255',
            'telefono' => 'nullable|max:50',
            'activo' => 'required|boolean',

        ]);
        Proveedor::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contacto' => $request->contacto,
            'telefono' => $request->telefono,
            'activo' => $request->activo,
        ]);
        return redirect()
            ->route('proveedores.index')
            ->with(
                'success',
                'Proveedor creado correctamente'
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        Proveedor $proveedor
    ) {
        //
        $request->validate([
            'nombre' => 'required|max:255',
            'correo' => 'nullable|email|max:255',
            'contacto' => 'nullable|max:255',
            'telefono' => 'nullable|max:50',
            'activo' => 'required|boolean',
        ]);
        $proveedor->update([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contacto' => $request->contacto,
            'telefono' => $request->telefono,
            'activo' => $request->activo,
        ]);
        return redirect()
            ->route('proveedores.index')
            ->with(
                'success',
                'Proveedor actualizado correctamente'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Proveedor $proveedor
    ) {
        //
        $proveedor->delete();
        return redirect()
            ->route('proveedores.index')
            ->with(
                'success',
                'Proveedor eliminado correctamente'
            );
    }
}
