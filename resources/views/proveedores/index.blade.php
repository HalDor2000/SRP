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
                        Listado de Proveedores
                    </div>
                    <div class="prism-toggle">
                        <button type="button" class="btn btn-primary" onclick="openProveedorCreateDrawer()">
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
                                    <th>Nombre</th>
                                    <th>Contacto</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Activo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($proveedores as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nombre }}</td>
                                        <td>{{ $item->contacto }}</td>
                                        <td>{{ $item->correo }}</td>
                                        <td class="text-nowrap">
                                            {{ $item->telefono }}
                                        </td>
                                        <td class="text-center">
                                            @if ($item->activo)
                                                <span class="badge bg-success">
                                                    Activo
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    Inactivo
                                                </span>
                                            @endif
                                        </td>
                                        <td>

                                            <!-- Editar -->
                                            <button type="button" class="btn btn-info btn-sm"
                                                onclick="openProveedorEditDrawer(
                                                    '{{ $item->id }}',
                                                    `{{ $item->nombre }}`,
                                                    `{{ $item->contacto }}`,
                                                    '{{ $item->correo }}',
                                                    '{{ $item->telefono }}',
                                                    '{{ $item->activo }}'
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
                                    @include('proveedores.delete')
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>


    <!-- Overlay -->
    <div class="drawer-overlay" id="proveedor-create-overlay" data-drawer-close="proveedor-create-drawer">
    </div>

    <!-- Drawer Crear Proveedor -->
    <div id="proveedor-create-drawer" class="drawer" aria-hidden="true">

        <div class="drawer-content">
            <!-- Header -->
            <div class="drawer-header">
                <h5 class="drawer-title">
                    Nuevo Proveedor
                </h5>
                <button type="button" class="drawer-close" data-drawer-close="proveedor-create-drawer">
                    &times;
                </button>
            </div>

            <!-- Body -->
            <div class="drawer-body">
                <form action="{{ route('proveedores.store') }}" method="POST">
                    @csrf
                    <!-- Nombre -->
                    <div class="mb-3">
                        <label class="form-label">
                            Nombre
                        </label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <!-- Contacto -->
                    <div class="mb-3">
                        <label class="form-label">
                            Contacto
                        </label>
                        <input type="text" name="contacto" class="form-control">
                    </div>
                    <!-- Correo -->
                    <div class="mb-3">
                        <label class="form-label">
                            Correo
                        </label>
                        <input type="email" name="correo" class="form-control">
                    </div>
                    <!-- Teléfono -->
                    <div class="mb-3">
                        <label class="form-label">
                            Teléfono
                        </label>
                        <input type="text" name="telefono" class="form-control">
                    </div>
                    <!-- Estado -->
                    <div class="mb-3">
                        <label class="form-label">
                            Estado
                        </label>
                        <select name="activo" class="form-select">
                            <option value="1">
                                Activo
                            </option>
                            <option value="0">
                                Inactivo
                            </option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-light" data-drawer-close="proveedor-create-drawer">
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

    <!-- Overlay -->
    <div class="drawer-overlay" id="edit-proveedor-overlay" data-drawer-close="edit-proveedor-drawer">
    </div>
    <!-- Drawer -->
    <div id="edit-proveedor-drawer" class="drawer">
        <div class="drawer-content">
            <!-- Header -->
            <div class="drawer-header">
                <h5 class="drawer-title">
                    Editar Proveedor
                </h5>
                <button type="button" class="drawer-close" data-drawer-close="edit-proveedor-drawer">
                    &times;
                </button>
            </div>
            <!-- Body -->
            <div class="drawer-body">
                <form id="edit-proveedor-form" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Nombre -->
                    <div class="mb-3">
                        <label class="form-label">
                            Nombre
                        </label>
                        <input type="text" id="edit_nombre" name="nombre" class="form-control" required>
                    </div>

                    <!-- Contacto -->
                    <div class="mb-3">
                        <label class="form-label">
                            Contacto
                        </label>
                        <input type="text" id="edit_contacto" name="contacto" class="form-control">

                    </div>

                    <!-- Correo -->
                    <div class="mb-3">
                        <label class="form-label">
                            Correo
                        </label>
                        <input type="email" id="edit_correo" name="correo" class="form-control">

                    </div>

                    <!-- Teléfono -->
                    <div class="mb-3">
                        <label class="form-label">
                            Teléfono
                        </label>
                        <input type="text" id="edit_telefono" name="telefono" class="form-control">

                    </div>

                    <!-- Estado -->
                    <div class="mb-3">
                        <label class="form-label">
                            Estado
                        </label>
                        <select id="edit_activo" name="activo" class="form-select">
                            <option value="1">
                                Activo
                            </option>
                            <option value="0">
                                Inactivo
                            </option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-light" data-drawer-close="edit-proveedor-drawer">
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
            expandMenuAndHighlightOption('moduloMenu', 'proveedorOption');

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
            var DRAWER_ID = 'proveedor-create-drawer';
            var OVERLAY_ID = 'proveedor-create-overlay';

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

            w.openProveedorCreateDrawer = open;
            w.closeProveedorCreateDrawer = close;

        })(window);
    </script>
    <script>
        function openProveedorEditDrawer(
            id,
            nombre,
            contacto,
            correo,
            telefono,
            activo
        ) {
            /*
            |--------------------------------------------------------------------------
            | ACTION
            |--------------------------------------------------------------------------
            */

            document.getElementById(
                'edit-proveedor-form'
            ).action = '/proveedores/' + id;

            /*
            |--------------------------------------------------------------------------
            | VALUES
            |--------------------------------------------------------------------------
            */

            document.getElementById(
                'edit_nombre'
            ).value = nombre;

            document.getElementById(
                'edit_contacto'
            ).value = contacto;

            document.getElementById(
                'edit_correo'
            ).value = correo;

            document.getElementById(
                'edit_telefono'
            ).value = telefono;

            document.getElementById(
                'edit_activo'
            ).value = activo;

            /*
            |--------------------------------------------------------------------------
            | OPEN
            |--------------------------------------------------------------------------
            */

            document.getElementById(
                'edit-proveedor-drawer'
            ).classList.add('is-open');

            document.getElementById(
                'edit-proveedor-overlay'
            ).classList.add('is-open');

            document.body.classList.add(
                'drawer-open-body'
            );
        }

        function closeProveedorEditDrawer() {
            document.getElementById(
                'edit-proveedor-drawer'
            ).classList.remove('is-open');

            document.getElementById(
                'edit-proveedor-overlay'
            ).classList.remove('is-open');

            document.body.classList.remove(
                'drawer-open-body'
            );
        }

        document.addEventListener('click', function(e) {

            var t = e.target.closest(
                '[data-drawer-close="edit-proveedor-drawer"]'
            );

            if (t) {

                e.preventDefault();

                closeProveedorEditDrawer();
            }
        });
    </script>

    <!-- End:: row-1 -->
@endsection
