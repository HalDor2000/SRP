@extends ('menu')
@section('content')
    <!-- DataTables CSS -->
    <link href="{{ asset('assets/libs/dataTables/dataTables.bootstrap5.min.css') }}" rel="stylesheet">

    <style>
        .drawer {
            position: fixed;
            top: 0;
            right: -520px;
            width: 500px;
            max-width: 100%;
            height: 100%;
            background: #fff;
            z-index: 1051;
            transition: right .3s ease;
            box-shadow: -2px 0 10px rgba(0, 0, 0, .2);
        }

        .drawer.is-open {
            right: 0;
        }

        .drawer-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .5);
            z-index: 1050;

            opacity: 0;
            visibility: hidden;

            transition: .3s;
        }

        .drawer-overlay.is-open {
            opacity: 1;
            visibility: visible;
        }

        .drawer-content {
            position: relative;
            z-index: 1051;
            height: 100%;
            overflow-y: auto;
            background: #fff;
        }

        .drawer-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            padding: 1rem;

            border-bottom: 1px solid #dee2e6;
        }

        .drawer-body {
            padding: 1rem;
        }

        .drawer-title {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
        }

        .drawer-close {
            border: 0;
            background: transparent;
            font-size: 1.5rem;
            cursor: pointer;
            line-height: 1;
        }

        .drawer-open-body {
            overflow: hidden;
        }
    </style>

    <!-- Start:: row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Listado de Solicitudes OBS
                    </div>
                    <div class="prism-toggle">
                        <button type="button" class="btn btn-primary" onclick="openSolicitudCreateDrawer()">
                            Nuevo
                        </button>


                    </div>
                </div>
                <div class="card-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <div class="table-responsive">
                        <table id="datatable-basic" class="table table-striped text-nowrap w-100">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Codigo OBS</th>
                                    <th>Nombre de Proces</th>
                                    <th>Fecha de inicio de proceso</th>
                                    <th class="text-end">Total Unidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($solicitudes as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->codigo }}</td>
                                        <td>{{ $item->nombre_proceso }}</td>
                                        <td>{{ $item->fecha->format('d/m/Y') }}</td>
                                        <td class="text-end"> ${{ number_format($item->total_estimado, 2) }}</td>
                                        <td>
                                            <!-- Ver / Gestionar -->
                                            <a href="{{ route('solicitudes.show', $item) }}"
                                                class="btn btn-sm btn-primary btn-wave">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <!-- Editar -->
                                            <button type="button" class="btn btn-info btn-sm"
                                                onclick="openSolicitudEditDrawer(
                                                    '{{ $item->id }}',
                                                    '{{ $item->codigo }}',
                                                    '{{ $item->fecha->format('Y-m-d') }}',
                                                    `{{ $item->nombre_proceso }}`
                                                )">
                                                <i class="ri-edit-line"></i>

                                            </button>
                                            <!-- Eliminar -->
                                            <button class="btn btn-sm btn-danger btn-wave" data-bs-toggle="modal"
                                                data-bs-target="#modal-delete-{{ $item->id }}">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @include('solicitudes.delete')
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>


    <!-- Overlay -->
    <div class="drawer-overlay" id="solicitud-create-overlay" data-drawer-close="solicitud-create-drawer">
    </div>

    <!-- Drawer Crear Solicitud -->
    <div id="solicitud-create-drawer" class="drawer" aria-hidden="true">

        <div class="drawer-content">
            <!-- Header -->
            <div class="drawer-header">
                <h5 class="drawer-title">
                    Nueva Solicitud OBS
                </h5>
                <button type="button" class="drawer-close" data-drawer-close="solicitud-create-drawer">
                    &times;
                </button>
            </div>

            <!-- Body -->
            <div class="drawer-body">
                <form action="{{ route('solicitudes.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">
                            Código OBS
                        </label>
                        <input type="text" name="codigo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Fecha
                        </label>
                        <input type="date" name="fecha" class="form-control" required>
                    </div>
                    {{-- <div class="mb-3">
                        <label class="form-label">
                            Total Estimado
                        </label>
                        <input type="number" step="0.01" name="total_estimado" class="form-control" value="0.00">
                    </div> --}}
                    <div class="mb-3">
                        <label class="form-label">
                            Nombre del Proceso
                        </label>
                        <textarea name="nombre_proceso" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-light" data-drawer-close="solicitud-create-drawer">
                            Cancelar
                        </button>
                        <!-- Guardar y volver -->
                        <button type="submit" name="accion" value="guardar" class="btn btn-secondary">
                            Guardar
                        </button>
                        <!-- Guardar y gestionar -->
                        <button type="submit" name="accion" value="continuar" class="btn btn-primary">
                            <i class="bi bi-arrow-right-circle me-1"></i>
                            Guardar y Continuar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Overlay -->
    <div class="drawer-overlay" id="edit-solicitud-overlay" data-drawer-close="edit-solicitud-drawer">
    </div>
    <!-- Drawer -->
    <div id="edit-solicitud-drawer" class="drawer">
        <div class="drawer-content">
            <!-- Header -->
            <div class="drawer-header">
                <h5 class="drawer-title">
                    Editar Solicitud
                </h5>
                <button type="button" class="drawer-close" data-drawer-close="edit-solicitud-drawer">
                    &times;
                </button>
            </div>
            <!-- Body -->
            <div class="drawer-body">
                <form id="edit-solicitud-form" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Código -->
                    <div class="mb-3">
                        <label class="form-label">
                            Código OBS
                        </label>
                        <input type="text" id="edit_codigo" name="codigo" class="form-control" required>
                    </div>
                    <!-- Fecha -->
                    <div class="mb-3">
                        <label class="form-label">
                            Fecha
                        </label>
                        <input type="date" id="edit_fecha" name="fecha" class="form-control" required>
                    </div>
                    <!-- Nombre -->
                    <div class="mb-3">
                        <label class="form-label">
                            Nombre del Proceso
                        </label>
                        <textarea id="edit_nombre_proceso" name="nombre_proceso" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-light" data-drawer-close="edit-solicitud-drawer">
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

    <script src="{{ asset('assets/libs/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dataTables/dataTables.bootstrap5.min.js') }}"></script>

    <!-- Activar DataTable -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            expandMenuAndHighlightOption('moduloMenu', 'solicitudOption');

            $('#datatable-basic').DataTable({
                language: {
                    processing: "Procesando...",
                    search: "Buscar:",
                    lengthMenu: "Mostrar _MENU_ registros",
                    info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                    infoFiltered: "(filtrado de un total de _MAX_ registros)",
                    infoPostFix: "",
                    loadingRecords: "Cargando...",
                    zeroRecords: "No se encontraron resultados",
                    emptyTable: "Ningún dato disponible en esta tabla",
                    paginate: {
                        first: "<<",
                        previous: "<",
                        next: ">",
                        last: ">>"
                    },
                    aria: {
                        sortAscending: ": Activar para ordenar la columna de manera ascendente",
                        sortDescending: ": Activar para ordenar la columna de manera descendente"
                    },
                    buttons: {
                        copy: 'Copiar',
                        colvis: 'Visibilidad',
                        print: 'Imprimir',
                        excel: 'Exportar Excel',
                        pdf: 'Exportar PDF'
                    }
                }
            });


        });
    </script>
    <script>
        (function(w) {
            'use strict';
            var DRAWER_ID = 'solicitud-create-drawer';
            var OVERLAY_ID = 'solicitud-create-overlay';
            function el() {
                return document.getElementById(DRAWER_ID);
            }
            function overlay() {
                return document.getElementById(OVERLAY_ID);
            }
            function open() {
                var node = el();
                var ov = overlay();
                if (!node) return;
                node.classList.add('is-open');
                if (ov) {
                    ov.classList.add('is-open');
                }
                node.setAttribute('aria-hidden', 'false');
                document.body.classList.add('drawer-open-body');
            }

            function close() {
                var node = el();
                var ov = overlay();
                if (!node) return;
                node.classList.remove('is-open');
                if (ov) {
                    ov.classList.remove('is-open');
                }
                node.setAttribute('aria-hidden', 'true');
                document.body.classList.remove('drawer-open-body');
            }

            document.addEventListener('click', function(e) {
                var t = e.target.closest(
                    '[data-drawer-close="' + DRAWER_ID + '"]'
                );
                if (t) {
                    e.preventDefault();
                    close();
                }
            });

            w.openSolicitudCreateDrawer = open;
            w.closeSolicitudCreateDrawer = close;

        })(window);
    </script>
    <script>
        function openSolicitudEditDrawer(
            id,
            codigo,
            fecha,
            nombre
        ) {
            /*
            |--------------------------------------------------------------------------
            | ACTION FORM
            |--------------------------------------------------------------------------
            */
            document.getElementById(
                'edit-solicitud-form'
            ).action = '/solicitudes/' + id;
            /*
            |--------------------------------------------------------------------------
            | SET VALUES
            |--------------------------------------------------------------------------
            */
            document.getElementById(
                'edit_codigo'
            ).value = codigo;
            document.getElementById(
                'edit_fecha'
            ).value = fecha;
            document.getElementById(
                'edit_nombre_proceso'
            ).value = nombre;
            /*
            |--------------------------------------------------------------------------
            | OPEN DRAWER
            |--------------------------------------------------------------------------
            */
            document.getElementById(
                'edit-solicitud-drawer'
            ).classList.add('is-open');
            document.getElementById(
                'edit-solicitud-overlay'
            ).classList.add('is-open');

            document.body.classList.add(
                'drawer-open-body'
            );
        }
        /*
        |--------------------------------------------------------------------------
        | CLOSE DRAWER
        |--------------------------------------------------------------------------
        */
        function closeSolicitudEditDrawer() {
            document.getElementById(
                'edit-solicitud-drawer'
            ).classList.remove('is-open');
            document.getElementById(
                'edit-solicitud-overlay'
            ).classList.remove('is-open');
            document.body.classList.remove(
                'drawer-open-body'
            );
        }
        /*
        |--------------------------------------------------------------------------
        | EVENTS
        |--------------------------------------------------------------------------
        */
        document.addEventListener('click', function(e) {
            var t = e.target.closest(
                '[data-drawer-close="edit-solicitud-drawer"]'
            );
            if (t) {
                e.preventDefault();
                closeSolicitudEditDrawer();
            }
        });
    </script>
    
    <!-- End:: row-1 -->
@endsection
