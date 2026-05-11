@extends('menu')

@section('content')
    <style>
        /*
                                    |--------------------------------------------------------------------------
                                    | TABLA COMPARATIVA
                                    |--------------------------------------------------------------------------
                                    */
        .comparativo-table {
            min-width: 1400px;
        }
        /*
                                    |--------------------------------------------------------------------------
                                    | COLUMNAS FIJAS
                                    |--------------------------------------------------------------------------
                                    */
        .sticky-col {
            position: sticky;
            background: #fff;
            z-index: 2;
        }
        /*
                                    |--------------------------------------------------------------------------
                                    | ITEM
                                    |--------------------------------------------------------------------------
                                    */
        .sticky-item {
            left: 0;
            min-width: 70px;
            max-width: 70px;
        }
        /*
                                    |--------------------------------------------------------------------------
                                    | DESCRIPCIÓN
                                    |--------------------------------------------------------------------------
                                    */
        .sticky-desc {
            left: 70px;
            min-width: 300px;
            max-width: 300px;
        }
        /*
                                    |--------------------------------------------------------------------------
                                    | CANTIDAD
                                    |--------------------------------------------------------------------------
                                    */
        .sticky-cant {
            left: 370px;
            min-width: 120px;
            max-width: 120px;
        }
        /*
                                    |--------------------------------------------------------------------------
                                    | HEADER
                                    |--------------------------------------------------------------------------
                                    */
        thead .sticky-col {
            z-index: 5;
            background: #f8f9fa;
        }
        /*
                                    |--------------------------------------------------------------------------
                                    | CELDAS PROVEEDORES
                                    |--------------------------------------------------------------------------
                                    */
        .provider-col {
            min-width: 170px;
            white-space: nowrap;
        }
    </style>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <!-- Header -->
                <div
                    class="card-header
                d-flex
                justify-content-between
                align-items-center">
                    <div>
                        <h5 class="mb-0">
                            Cuadro Comparativo
                        </h5>
                        <small class="text-muted">
                            Evaluación automática de ofertas
                        </small>
                    </div>
                    <div class="d-flex gap-2">
                        <!-- Razonabilidad -->
                        <a href="{{ route('razonabilidades.show', $solicitud) }}"
                            class="btn btn-primary btn-sm">
                            <i class="bx bx-file me-1"></i>
                            Generar Razonabilidad
                        </a>

                        <!-- Regresar -->
                        <a href="{{ route('solicitudes.show', $solicitud) }}"
                            class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i>
                            Regresar
                        </a>
                    </div>
                </div>

                <!-- Body -->
                <div class="card-body">

                    <!-- INFO SOLICITUD -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label class="fw-bold">
                                Código OBS
                            </label>
                            <div>
                                {{ $solicitud->codigo }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="fw-bold">
                                Proceso
                            </label>
                            <div>
                                {{ $solicitud->nombre_proceso }}
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle comparativo-table">
                            <thead class="table-light">
                                <tr>
                                    <th class="sticky-col sticky-item text-center">
                                        #
                                    </th>
                                    <th class="sticky-col sticky-desc">
                                        Descripción
                                    </th>
                                    <th class="sticky-col sticky-cant text-center">
                                        Cantidad
                                    </th>

                                    <!-- Proveedores -->
                                    @foreach ($solicitud->ofertas as $oferta)
                                        <th class="text-center provider-col">
                                            {{ Str::limit($oferta->proveedor->nombre, 15) }}
                                        </th>
                                    @endforeach

                                    <th class="text-center">
                                        Mejor Oferta
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($solicitud->items as $item)
                                    @php
                                        $mejorPrecio = null;
                                        $mejorProveedor = null;
                                    @endphp
                                    <tr>

                                        <!-- Item -->
                                        <td class="sticky-col sticky-item text-center">
                                            {{ $item->item }}
                                        </td>

                                        <!-- Descripción -->
                                        <td class="sticky-col sticky-desc">
                                            {{ $item->descripcion }}
                                        </td>

                                        <!-- Cantidad -->
                                        <td class="sticky-col sticky-cant text-center">
                                            {{ number_format($item->cantidad) }}
                                        </td>

                                        <!-- Ofertas -->
                                        @foreach ($solicitud->ofertas as $oferta)
                                            @php
                                                $detalle = $oferta->detalles
                                                    ->where('solicitud_item_id', $item->id)
                                                    ->first();
                                            @endphp

                                            <td class="text-end">
                                                @if ($detalle && !$detalle->no_oferto)
                                                    @php
                                                        $precioTotal = $detalle->precio_unitario * $item->cantidad;
                                                        /*
                                                    |--------------------------------------------------------------------------
                                                    | MEJOR PRECIO
                                                    |--------------------------------------------------------------------------
                                                    */
                                                        if (is_null($mejorPrecio) || $precioTotal < $mejorPrecio) {
                                                            $mejorPrecio = $precioTotal;

                                                            $mejorProveedor = $oferta->proveedor->nombre;
                                                        }
                                                    @endphp
                                                    ${{ number_format($precioTotal, 2) }}
                                                @else
                                                    <span class="text-muted">
                                                        No ofertó
                                                    </span>
                                                @endif
                                            </td>
                                        @endforeach

                                        <!-- Mejor -->
                                        <td class="text-center">
                                            @if ($mejorProveedor)
                                                <span class="badge bg-success">
                                                    {{ $mejorProveedor }}
                                                </span>
                                                <div class="fw-bold mt-1">
                                                    ${{ number_format($mejorPrecio, 2) }}
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
