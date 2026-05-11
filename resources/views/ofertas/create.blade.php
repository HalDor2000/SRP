@extends('menu')

@section('content')
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
                            Nueva Oferta
                        </h5>
                        <small class="text-muted">
                            Registro de oferta económica
                        </small>
                    </div>
                    <a href="{{ route('solicitudes.show', $solicitud) }}"
                        class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i>
                        Regresar
                    </a>
                </div>

                <!-- Body -->
                <div class="card-body">
                    <form
                        action="{{ route('ofertas.store', $solicitud) }}"
                        method="POST">
                        @csrf
                        <!-- =====================================
                        | ENCABEZADO
                        ====================================== -->
                        <div class="row mb-4">
                            <!-- Proveedor -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    Proveedor
                                </label>
                                <select name="proveedor_id" class="form-select" required>
                                    <option value="">
                                        Seleccione
                                    </option>
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}">
                                            {{ $proveedor->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Fecha -->
                            <div class="col-md-3">
                                <label class="form-label">
                                    Fecha Oferta
                                </label>
                                <input type="date" name="fecha_oferta" class="form-control" value="{{ date('Y-m-d') }}"
                                    required>
                            </div>
                        </div>

                        <!-- =====================================
                        | ITEMS
                        ====================================== -->

                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Descripción</th>
                                        <th class="text-center">
                                            Cantidad
                                        </th>
                                        <th class="text-end">
                                            Precio Unitario
                                        </th>
                                        <th class="text-center">
                                            No Ofertó
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($solicitud->items as $item)
                                        <tr>
                                            <!-- Item -->
                                            <td>
                                                {{ $item->item }}
                                            </td>
                                            <!-- Descripción -->
                                            <td>
                                                {{ $item->descripcion }}
                                            </td>
                                            <!-- Cantidad -->
                                            <td class="text-center">
                                                {{ number_format($item->cantidad) }}
                                            </td>
                                            <!-- Hidden -->
                                            <input type="hidden" name="items[{{ $item->id }}][solicitud_item_id]"
                                                value="{{ $item->id }}">
                                            <!-- Precio -->
                                            <td>
                                                <input type="number" step="0.01" min="0"
                                                    class="form-control text-end"
                                                    name="items[{{ $item->id }}][precio_unitario]" value="0.00">
                                            </td>

                                            <!-- No ofertó -->
                                            <td class="text-center">
                                                <input type="checkbox" class="form-check-input"
                                                    name="items[{{ $item->id }}][no_oferto]" value="1">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Footer -->
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-1"></i>
                                Guardar Oferta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
