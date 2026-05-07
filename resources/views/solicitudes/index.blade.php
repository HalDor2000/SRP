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

                    @if (session('success'))
                        <script>
                            toastr.success("{{ session('success') }}");
                        </script>
                    @endif

                    @if (session('error'))
                        <script>
                            toastr.error("{{ session('error') }}");
                        </script>
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

                                            <button class="btn btn-sm btn-info btn-wave" data-bs-toggle="modal"
                                                data-bs-target="#modal-edit-{{ $item->id }}">
                                                &nbsp;<i class="ri-edit-line"></i>&nbsp;</button>
                                            &nbsp;
                                            <button class="btn btn-sm btn-danger btn-wave" data-bs-toggle="modal"
                                                data-bs-target="#modal-delete-{{ $item->id }}">
                                                &nbsp;<i class="bi bi-trash-fill"></i>&nbsp;</button>

                                        </td>
                                    </tr>
                                    {{--  @include('catalogo.clase.edit')
                                    @include('catalogo.clase.delete') --}}
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

                    <div class="mb-3">
                        <label class="form-label">
                            Total Estimado
                        </label>

                        <input type="number" step="0.01" name="total_estimado" class="form-control" value="0.00">
                    </div>

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

                        <button type="submit" class="btn btn-primary">

                            Guardar

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
    <!-- End:: row-1 -->
@endsection
