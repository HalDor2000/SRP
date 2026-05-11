@extends('menu')

@section('content')
    <div class="row">

        <div class="col-xl-12">

            <div class="card custom-card">

                <!-- =====================================
                        | HEADER
                        ====================================== -->

                <div
                    class="card-header
                d-flex
                justify-content-between
                align-items-center">

                    <div>

                        <h5 class="mb-0">

                            Razonabilidad

                        </h5>

                        <small class="text-muted">

                            Resultado final del proceso

                        </small>

                    </div>

                    <a href="{{ route('evaluaciones.show', $solicitud) }}" class="btn btn-outline-secondary btn-sm">

                        <i class="bi bi-arrow-left me-1"></i>

                        Regresar

                    </a>

                </div>

                <!-- =====================================
                        | BODY
                        ====================================== -->

                <div class="card-body">

                    @php

                        $razonabilidad = $solicitud->razonabilidad;

                    @endphp

                    <!-- =====================================
                            | FORM
                            ====================================== -->

                    <form action="{{ route('razonabilidades.store', $solicitud) }}" method="POST">

                        @csrf

                        <!-- =====================================
                                | TABLA
                                ====================================== -->

                        <div class="table-responsive">

                            <table
                                class="table
                            table-bordered
                            table-striped
                            align-middle">

                                <thead class="table-light">

                                    <tr>

                                        <th width="5%">
                                            #
                                        </th>

                                        <th width="35%">
                                            Descripción
                                        </th>

                                        <th width="25%">
                                            Proveedor Recomendado
                                        </th>

                                        <th width="15%" class="text-end">

                                            Precio

                                        </th>

                                        <th width="20%">
                                            Observación
                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach ($solicitud->items as $item)
                                        @php

                                            /*
                                        |--------------------------------------------------------------------------
                                        | MEJOR PRECIO
                                        |--------------------------------------------------------------------------
                                        */

                                            $mejorDetalle = null;

                                            $mejorPrecio = null;

                                            foreach ($solicitud->ofertas as $oferta) {
                                                $detalle = $oferta->detalles
                                                    ->where('solicitud_item_id', $item->id)
                                                    ->first();

                                                if ($detalle && !$detalle->no_oferto) {
                                                    if (
                                                        is_null($mejorPrecio) ||
                                                        $detalle->precio_unitario < $mejorPrecio
                                                    ) {
                                                        $mejorPrecio = $detalle->precio_unitario;

                                                        $mejorDetalle = $detalle;
                                                    }
                                                }
                                            }

                                            /*
                                        |--------------------------------------------------------------------------
                                        | PROVEEDOR SELECCIONADO
                                        |--------------------------------------------------------------------------
                                        */

                                            $proveedorSeleccionado = optional(optional($mejorDetalle)->oferta)
                                                ->proveedor_id;

                                            /*
                                        |--------------------------------------------------------------------------
                                        | PROVEEDORES ÚNICOS
                                        |--------------------------------------------------------------------------
                                        */

                                            $proveedores = $solicitud->ofertas->pluck('proveedor')->unique('id');

                                        @endphp

                                        <tr>

                                            <!-- ITEM -->
                                            <td>

                                                {{ $item->item }}

                                                <input type="hidden"
                                                    name="detalles[{{ $item->id }}][solicitud_item_id]"
                                                    value="{{ $item->id }}">

                                            </td>

                                            <!-- DESCRIPCIÓN -->
                                            <td>

                                                {{ $item->descripcion }}

                                            </td>

                                            <!-- PROVEEDOR -->
                                            <td>

                                                <select name="detalles[{{ $item->id }}][proveedor_id]"
                                                    class="form-select" required>

                                                    <option value="">
                                                        Seleccione
                                                    </option>

                                                    @foreach ($proveedores as $proveedor)
                                                        <option value="{{ $proveedor->id }}"
                                                            {{ $proveedorSeleccionado == $proveedor->id ? 'selected' : '' }}>

                                                            {{ $proveedor->nombre }}

                                                        </option>
                                                    @endforeach

                                                </select>

                                            </td>

                                            <!-- PRECIO -->
                                            <td>

                                                <input type="number" step="0.01" class="form-control text-end"
                                                    name="detalles[{{ $item->id }}][precio_recomendado]"
                                                    value="{{ $mejorPrecio ? number_format($mejorPrecio, 2, '.', '') : '0.00' }}"
                                                    readonly required>

                                            </td>

                                            <!-- OBSERVACIÓN -->
                                            <td>

                                                <textarea name="detalles[{{ $item->id }}][observacion]" rows="2" class="form-control"></textarea>

                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                        <!-- =====================================
                                | OBSERVACIONES GENERALES
                                ====================================== -->

                        <div class="mb-4 mt-4">

                            <label class="form-label fw-bold">

                                Observaciones Generales

                            </label>

                            <textarea name="observaciones" rows="4" class="form-control"></textarea>

                        </div>

                        <!-- =====================================
                                | CONCLUSIÓN FINAL
                                ====================================== -->

                        <div class="mb-4">

                            <label class="form-label fw-bold">

                                Conclusión Final

                            </label>

                            <textarea name="conclusion" rows="5" class="form-control"></textarea>

                        </div>

                        <!-- =====================================
                                | BOTONES
                                ====================================== -->

                        <div class="d-flex
                        justify-content-end
                        gap-2">

                            @if ($solicitud->razonabilidad)
                                <a href="{{ route('razonabilidades.pdf', $solicitud->razonabilidad) }}" target="_blank"
                                    class="btn btn-danger">

                                    <i class="bi bi-file-earmark-pdf"></i>

                                    PDF

                                </a>
                            @endif

                            <a href="{{ route('razonabilidades.word', $solicitud->razonabilidad) }}"
                                class="btn btn-primary" target="_blank">
                                <i class="bi bi-file-earmark-word"></i>
                                Word
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-1"></i>
                                Guardar Razonabilidad
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
@endsection
