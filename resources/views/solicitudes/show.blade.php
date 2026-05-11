@extends ('menu')
@section('content')
    <style>
        .drawer {
            position: fixed;
            top: 0;
            right: -650px;
            width: 650px;
            max-width: 100%;
            height: 100vh;
            background: #fff;
            z-index: 1050;
            transition: right .3s ease;
            box-shadow: -2px 0 10px rgba(0, 0, 0, .1);
        }

        .drawer.is-open {
            right: 0;
        }

        .drawer-content {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .drawer-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
        }

        .drawer-title {
            margin: 0;
            font-weight: 600;
        }

        .drawer-close {
            border: none;
            background: transparent;
            font-size: 1.5rem;
        }

        .drawer-body {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
        }

        .drawer-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .4);
            z-index: 1040;
            opacity: 0;
            visibility: hidden;
            transition: .3s;
        }

        .drawer-overlay.is-open {
            opacity: 1;
            visibility: visible;
        }

        .drawer-open-body {
            overflow: hidden;
        }
    </style>
    <!-- DataTables CSS -->
    <link href="{{ asset('assets/libs/dataTables/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Detalle de Solicitud OBS</h5>
                        <small class="text-muted">Gestión de items de la solicitud</small>
                    </div>
                    <a href="{{ route('solicitudes.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Regresar
                    </a>
                </div>
                <div class="card-body">
                    <div class="section-box">
                        <div class="section-title mb-3 fw-bold text-primary">
                            <i class="bi bi-clipboard-check me-2"></i>
                            Solicitud OBS
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label>Codigo OBS</label>

                                <input class="form-control bg-light" value="{{ $solicitud->codigo }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label>Nombre del Proceso</label>

                                <input class="form-control bg-light" value="{{ $solicitud->nombre_proceso }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label>Fecha de inicio de proceso</label>

                                <input class="form-control bg-light" value="{{ $solicitud->fecha->format('d/m/Y') }}"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="section-box mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="section-title fw-bold text-primary">
                <i class="bi bi-list-check me-2"></i>
                Items de la Solicitud
            </div>
            <button type="button" class="btn btn-primary btn-sm" onclick="openItemDrawer()">
                <i class="bi bi-plus-circle me-1"></i>
                Agregar Item
            </button>
        </div>

        <div class="table-responsive">
            <table id="tabla-items" class="table table-striped align-middle w-100">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">#</th>
                        <th>Cod. Específico</th>
                        <th>Descripción</th>
                        <th class="text-center">
                            Unidad de Medida
                        </th>
                        <th class="text-center">
                            Cantidad
                        </th>
                        <th class="text-end">
                            Precio Unitario
                        </th>
                        <th class="text-end">
                            Total Estimado
                        </th>
                        <th class="text-center">
                            Acciones
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($solicitud->items as $item)
                        <tr>
                            <td class="text-center">
                                {{ $item->item }}
                            </td>
                            <td>
                                {{ $item->codigo_especifico }}
                            </td>
                            <td>
                                {{ $item->descripcion }}
                            </td>
                            <td class="text-center">
                                {{ $item->unidad_medida }}
                            </td>
                            <td class="text-center">
                                {{ number_format($item->cantidad) }}
                            </td>
                            <td class="text-end">
                                ${{ number_format($item->costo_estimado_unitario, 2) }}
                            </td>
                            <td class="text-end fw-bold">
                                ${{ number_format($item->costo_total, 2) }}
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-info"
                                    onclick="openEditDrawer(
                                        '{{ $item->id }}',
                                        '{{ $item->descripcion }}',
                                        '{{ $item->cantidad }}',
                                        '{{ $item->unidad_medida }}',
                                        '{{ $item->costo_estimado_unitario }}',
                                        '{{ $item->codigo_especifico }}'
                                    )">
                                    <i class="ri-edit-line"></i>
                                </button>
                                <form action="{{ route('solicitud-items.destroy', $item) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Eliminar este item?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                                <a href="{{ route('evaluaciones.show', $solicitud) }}"
                                    class="btn btn-success btn-sm">
                                    <i class="bx bx-spreadsheet me-1"></i>
                                    Evaluar Ofertas
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                No hay items registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- TOTAL GENERAL -->
        <div class="text-end mt-3">
            <h6 class="fw-bold text-primary">
                Total Estimado Solicitud:
                ${{ number_format($solicitud->total_estimado, 2) }}
            </h6>
        </div>
    </div>

    <!-- =========================================
                | OFERTAS
                ========================================= -->

    <div class="section-box mt-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="section-title fw-bold text-primary">
                <i class="bx bx-money me-2"></i>
                Ofertas
            </div>
            <!-- Botón -->
            <a href="{{ route('ofertas.create', $solicitud) }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle me-1"></i>
                Agregar Oferta
            </a>
        </div>

        <!-- Tabla -->
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Proveedor</th>
                        <th>Fecha Oferta</th>
                        <th class="text-center">
                            Oferta total
                        </th>
                        <th class="text-center">
                            Acciones
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($solicitud->ofertas as $oferta)
                        <tr>
                            <td>
                                {{ $oferta->id }}
                            </td>
                            <td>
                                {{ $oferta->proveedor->nombre }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($oferta->fecha_oferta)->format('d/m/Y') }}
                            </td>
                            <td class="text-center">
                                @php
                                    $totalOferta = 0;
                                    foreach ($oferta->detalles as $detalle) {
                                        if (!$detalle->no_oferto) {
                                            $totalOferta +=
                                                $detalle->precio_unitario * $detalle->solicitudItem->cantidad;
                                        }
                                    }
                                @endphp
                                ${{ number_format($totalOferta, 2) }}
                            </td>

                            <td class="text-center">
                                <!-- Editar -->
                                <a href="{{ route('ofertas.edit', $oferta) }}" class="btn btn-sm btn-info">
                                    <i class="ri-edit-line"></i>
                                </a>
                                <!-- Eliminar -->
                                <form action="{{ route('ofertas.destroy', $oferta) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm(
                                            '¿Eliminar esta oferta?'
                                        )">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                No hay ofertas registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <!-- Overlay -->
    <div class="drawer-overlay" id="item-drawer-overlay" data-drawer-close="item-drawer">
    </div>

    <!-- Drawer -->
    <div id="item-drawer" class="drawer" aria-hidden="true">
        <div class="drawer-content">
            <!-- Header -->
            <div class="drawer-header">
                <h5 class="drawer-title">
                    Agregar Item
                </h5>
                <button type="button" class="drawer-close" data-drawer-close="item-drawer">
                    &times;
                </button>
            </div>
            <!-- Body -->
            <div class="drawer-body">
                <form action="{{ route('solicitud-items.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="solicitud_id" value="{{ $solicitud->id }}">
                    <!-- Descripción -->
                    <div class="mb-3">
                        <label class="form-label">
                            Descripción
                        </label>
                        <textarea name="descripcion" class="form-control" rows="2" required></textarea>
                    </div>
                    <div class="row">

                        <!-- Unidad -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Unidad de Medida
                            </label>
                            <input type="text" name="unidad_medida" class="form-control" placeholder="Unidad"
                                required>
                        </div>
                        <!-- Código -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Código Específico
                            </label>
                            <input type="text" name="codigo_especifico" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <!-- Cantidad -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                Cantidad
                            </label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control" min="1"
                                value="1" required>
                        </div>
                        <!-- Costo -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Costo Estimado Unitario
                            </label>
                            <input type="number" step="0.01" min="0" name="costo_estimado_unitario"
                                id="costo_estimado_unitario" class="form-control" value="0.00" required>
                        </div>

                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-light" data-drawer-close="item-drawer">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Guardar Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Overlay -->
    <div class="drawer-overlay" id="edit-item-drawer-overlay" data-drawer-close="edit-item-drawer">
    </div>
    <!-- Drawer -->
    <div id="edit-item-drawer" class="drawer">
        <div class="drawer-content">
            <!-- Header -->
            <div class="drawer-header">
                <h5 class="drawer-title">
                    Editar Item
                </h5>
                <button type="button" class="drawer-close" data-drawer-close="edit-item-drawer">
                    &times;
                </button>
            </div>
            <!-- Body -->
            <div class="drawer-body">
                <form id="edit-item-form" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Descripción -->
                    <div class="mb-3">
                        <label class="form-label">
                            Descripción
                        </label>
                        <textarea name="descripcion" id="edit_descripcion" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <!-- Cantidad -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                Cantidad
                            </label>
                            <input type="number" name="cantidad" id="edit_cantidad" class="form-control"
                                min="1" required>
                        </div>
                        <!-- Unidad -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                Unidad
                            </label>
                            <input type="text" name="unidad_medida" id="edit_unidad_medida" class="form-control"
                                required>
                        </div>
                        <!-- Código -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                Código Específico
                            </label>
                            <input type="text" name="codigo_especifico" id="edit_codigo_especifico"
                                class="form-control">
                        </div>
                    </div>
                    <!-- Precio -->
                    <div class="mb-3">
                        <label class="form-label">
                            Costo Estimado Unitario
                        </label>
                        <input type="number" step="0.01" min="0" name="costo_estimado_unitario"
                            id="edit_costo_estimado_unitario" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-light" data-drawer-close="edit-item-drawer">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <link href="{{ asset('assets/libs/dataTables/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/libs/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dataTables/dataTables.bootstrap5.min.js') }}"></script>

    <script>
        function openItemDrawer() {
            document.getElementById('item-drawer')
                .classList.add('is-open');

            document.getElementById('item-drawer-overlay')
                .classList.add('is-open');

            document.body.classList.add('drawer-open-body');
        }

        function closeItemDrawer() {
            document.getElementById('item-drawer')
                .classList.remove('is-open');

            document.getElementById('item-drawer-overlay')
                .classList.remove('is-open');

            document.body.classList.remove('drawer-open-body');
        }

        document.addEventListener('click', function(e) {

            var t = e.target.closest(
                '[data-drawer-close="item-drawer"]'
            );

            if (t) {

                e.preventDefault();

                closeItemDrawer();
            }
        });
    </script>

    <script>
        function openEditDrawer(
            id,
            descripcion,
            cantidad,
            unidad,
            costo,
            codigo
        ) {
            /*
            |--------------------------------------------------------------------------
            | SET ACTION
            |--------------------------------------------------------------------------
            */
            document.getElementById('edit-item-form')
                .action = '/solicitud-items/' + id;
            /*
            |--------------------------------------------------------------------------
            | SET VALUES
            |--------------------------------------------------------------------------
            */
            document.getElementById(
                'edit_descripcion'
            ).value = descripcion;

            document.getElementById(
                'edit_cantidad'
            ).value = cantidad;

            document.getElementById(
                'edit_unidad_medida'
            ).value = unidad;

            document.getElementById(
                'edit_costo_estimado_unitario'
            ).value = costo;

            document.getElementById(
                'edit_codigo_especifico'
            ).value = codigo;
            /*
            |--------------------------------------------------------------------------
            | OPEN DRAWER
            |--------------------------------------------------------------------------
            */
            document.getElementById(
                'edit-item-drawer'
            ).classList.add('is-open');

            document.getElementById(
                'edit-item-drawer-overlay'
            ).classList.add('is-open');

            document.body.classList.add(
                'drawer-open-body'
            );
        }
    </script>
    <script>
        function closeEditDrawer() {
            document.getElementById(
                'edit-item-drawer'
            ).classList.remove('is-open');

            document.getElementById(
                'edit-item-drawer-overlay'
            ).classList.remove('is-open');

            document.body.classList.remove(
                'drawer-open-body'
            );
        }

        document.addEventListener('click', function(e) {

            var t = e.target.closest(
                '[data-drawer-close="edit-item-drawer"]'
            );

            if (t) {

                e.preventDefault();

                closeEditDrawer();
            }
        });
    </script>
@endsection
