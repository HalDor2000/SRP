<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $solicitudes = Solicitud::latest()->get();

        return view('solicitudes.index', compact('solicitudes'));
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
    { {
            $solicitud = Solicitud::create([
                'codigo' => $request->codigo,
                'nombre_proceso' => $request->nombre_proceso,
                'fecha' => $request->fecha,
                'total_estimado' => 0,
            ]);
            if ($request->accion === 'continuar') {
                return redirect()
                    ->route(
                        'solicitudes.show',
                        $solicitud
                    )
                    ->with(
                        'success',
                        'Solicitud creada correctamente'
                    );
            }
            return redirect()
                ->route('solicitudes.index')
                ->with(
                    'success',
                    'Solicitud creada correctamente'
                );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Solicitud $solicitud)
    {
        /*
        | CARGAR RELACIONES
        */
        $solicitud->load('items');
        /*
        | VIEW
        */
        return view(
            'solicitudes.show',
            compact('solicitud')
        );
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
        Solicitud $solicitud
    ) {
        $solicitud->update([
            'codigo' => $request->codigo,
            'fecha' => $request->fecha,
            'nombre_proceso' =>
            $request->nombre_proceso,
        ]);
        return back()->with(
            'success',
            'Solicitud actualizada correctamente'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solicitud $solicitud)
    {
        //
        $solicitud->delete();

        return redirect()
            ->route('solicitudes.index')
            ->with('success', 'Solicitud eliminada correctamente');
    }
}
