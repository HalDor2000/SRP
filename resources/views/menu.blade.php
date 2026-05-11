<!DOCTYPE html>
<html lang="es" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="dark" data-toggled="close">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SRPr</title>
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="html, html and css templates, html css and javascript, html css, html javascript, html css bootstrap, admin, bootstrap admin template, bootstrap 5 admin template, dashboard template bootstrap, admin panel template, dashboard panel, bootstrap admin, dashboard, template admin, html admin template">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/brand-logos/favicon.ico') }}" type="image/x-icon">

    <!-- Choices JS -->
    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- Main Theme Js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Style Css -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">

    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

    <!-- Node Waves Css -->
    <link href="{{ asset('assets/libs/node-waves/waves.min.css') }}" rel="stylesheet">

    <!-- Simplebar Css -->
    <link href="{{ asset('assets/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}">

    <!-- Choices Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}">

    <!-- FlatPickr CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">

    <!-- Auto Complete CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/@tarekraafat/autocomplete.js/css/autoComplete.css') }}">

    <!-- Toastr CSS -->
    <link href="{{ asset('assets/libs/toast/toastr.min.css') }}" rel="stylesheet">

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

    <!-- Toastr JS -->
    <script src="{{ asset('assets/libs/toast/toastr.min.js') }}"></script>




    <style>
        /* Para mostrar el submenú expandido */
        .has-sub.is-expanded .slide-menu {
            display: block;
        }

        /* Para resaltar la opción activa */
        .side-menu__item.active {
            background-color: #f0f0f0;
            /* Cambia este color según tu diseño */
            font-weight: bold;
        }


        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            /* Ajustado a un tamaño más pequeño */
            height: 20px;
            /* Ajustado a un tamaño más pequeño */
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            /* Ajustado para ser proporcional al nuevo tamaño */
            width: 16px;
            /* Ajustado para ser proporcional al nuevo tamaño */
            left: 2px;
            /* Ajustado para posicionar correctamente el círculo */
            bottom: 2px;
            /* Ajustado para posicionar correctamente el círculo */
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #0056B3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #0056B3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(20px);
            /* Ajustado al nuevo ancho del switch */
            -ms-transform: translateX(20px);
            /* Ajustado al nuevo ancho del switch */
            transform: translateX(20px);
            /* Ajustado al nuevo ancho del switch */
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 20px;
            /* Proporcional al nuevo tamaño */
        }

        .slider.round:before {
            border-radius: 50%;
        }


        .card-header {
            border-bottom: 1px solid #f1f1f1 !important;
        }
    </style>



</head>

<body>



    <!-- Loader -->
    <div id="loader">
        <img src="{{ asset('assets/images/media/loader.svg') }}" alt="">
    </div>
    <!-- Loader -->

    <div class="page">
        <!-- app-header -->
        <header class="app-header sticky" id="header">

            <!-- Start::main-header-container -->
            <div class="main-header-container container-fluid">

                <!-- Start::header-content-left -->
                <div class="header-content-left">

                    <!-- Start::header-element -->
                    <div class="header-element">

                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element mx-lg-0 mx-2">
                        <a aria-label="Hide Sidebar"
                            class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                            data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                    </div>
                    <!-- End::header-element -->



                </div>
                <!-- End::header-content-left -->

                <!-- Start::header-content-right -->
                <ul class="header-content-right">

                    <!-- Start::header-element -->
                    <li class="header-element d-md-none d-block">
                        <a href="javascript:void(0);" class="header-link" data-bs-toggle="modal"
                            data-bs-target="#header-responsive-search">
                            <!-- Start::header-link-icon -->
                            <i class="bi bi-search header-link-icon"></i>
                            <!-- End::header-link-icon -->
                        </a>
                    </li>
                    <!-- End::header-element -->




                    <!-- Start::header-element -->
                    <li class="header-element dropdown">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{ asset('assets/images/perfil.png') }}" alt="img"
                                        class="avatar avatar-sm">
                                </div>
                                <div class="ms-2">
                                    <p class="mb-0  fw-bold">{{ Auth::user()->name ?? '' }}</p>
                                    <p class="mb-0  small">{{ Auth::user()->username ?? '' }}</p>
                                </div>
                            </div>
                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                            aria-labelledby="mainHeaderProfile">
                            {{-- <li>
                                <div class="dropdown-item text-center border-bottom">
                                    <span>
                                        Mr.Henry
                                    </span>
                                    <span class="d-block fs-12 text-muted">UI/UX Designer</span>
                                </div>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center" href="profile.html"><i
                                        class="fe fe-user p-1 rounded-circle bg-primary-transparent me-2 fs-16"></i>Profile</a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center" href="mail.html"><i
                                        class="fe fe-mail p-1 rounded-circle bg-primary-transparent me-2 fs-16"></i>Mail
                                    Inbox</a></li>
                            <li><a class="dropdown-item d-flex align-items-center" href="file-manager.html"><i
                                        class="fe fe-database p-1 rounded-circle bg-primary-transparent klist me-2 fs-16"></i>File
                                    Manger<span class="badge bg-primary1 text-fixed-white ms-auto fs-9">2</span></a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center" href="mail-settings.html"><i
                                        class="fe fe-settings p-1 rounded-circle bg-primary-transparent ings me-2 fs-16"></i>Settings</a>
                            </li>
                            <li class="border-top bg-light"><a class="dropdown-item d-flex align-items-center"
                                    href="chat.html"><i
                                        class="fe fe-help-circle p-1 rounded-circle bg-primary-transparent set me-2 fs-16"></i>Help</a>
                            </li> --}}
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"
                                    data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                    <i
                                        class="fe fe-key p-1 rounded-circle bg-primary-transparent ut me-2 fs-16"></i>Cambiar
                                    contraseña
                                </a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i
                                        class="fe fe-lock p-1 rounded-circle bg-primary-transparent ut me-2 fs-16"></i>Cerrar
                                    sesión</a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                    <!-- End::header-element -->



                </ul>
                <!-- End::header-content-right -->

            </div>
            <!-- End::main-header-container -->

        </header>
        <!-- /app-header -->
        <!-- Start::app-sidebar -->
        <aside class="app-sidebar sticky" id="sidebar">

            <!-- Start::main-sidebar-header -->
            <div class="main-sidebar-header">

            </div>
            <!-- End::main-sidebar-header -->

            <!-- Start::main-sidebar -->
            <div class="main-sidebar" id="sidebar-scroll">

                <!-- Start::nav -->
                <nav class="main-menu-container nav nav-pills flex-column sub-open">
                    <div class="slide-left" id="slide-left">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                        </svg>
                    </div>
                    <ul class="main-menu">


                        <!-- Start::slide -->
                        <li class="slide has-sub" id="seguridadMenu">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                                <span class="side-menu__label">Seguridad</span>
                                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0)">Seguridad</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ url('seguridad/user') }}" id="usuarioOption"
                                        class="side-menu__item">Usuarios</a>


                                    <a href="{{ url('seguridad/role') }}" id="roleOption"
                                        class="side-menu__item">Roles</a>

                                    <a href="{{ url('seguridad/permission') }}" id="permisoOption"
                                        class="side-menu__item">Permisos</a>

                                    <a href="{{ url('seguridad/permission_type') }}" id="permissionTypeOption"
                                        class="side-menu__item">Tipos de permiso</a>

                                </li>

                            </ul>
                        </li>
                        <!-- End::slide -->





                        <!-- Start::slide -->
                        <li class="slide has-sub" id="moduloMenu">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                                </svg>
                                <span class="side-menu__label">Modulos</span>
                                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1 pages-ul">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0)">Pages</a>
                                </li>

                                <li class="slide">
                                    <a href="{{ route('solicitudes.index') }}" id="solicitudOption"
                                        class="side-menu__item">
                                        
                                            Solicitudes
                                        
                                    </a>
                                    <a href="{{ route('proveedores.index') }}" id="proveedorOption"
                                        class="side-menu__item">
                                        
                                            Proveedores
                                        
                                    </a>
                                    <a href="#" id="ofertaOption" class="side-menu__item">Ofertas</a>
                                    <a href="#" id="evaluacionOption" class="side-menu__item">Evaluaciones</a>
                                    <a href="#" id="reporteOption" class="side-menu__item">Reportes</a>

                                </li>

                            </ul>
                        </li>
                        <!-- End::slide -->


                        {{-- <!-- Start::slide -->
                        <li class="slide has-sub" id="activosMenu">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                                </svg>
                                <span class="side-menu__label">Activos</span>
                                <i class="ri-arrow-down-s-line side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0)">Forms</a>
                                </li>


                                <li class="slide">
                                    <a href="{{ url('equipo') }}" id="equipoOption"
                                        class="side-menu__item">Equipo</a>
                                </li>

                                <li class="slide">
                                    <a href="{{ url('vehiculo') }}" id="vehiculoOption"
                                        class="side-menu__item">Vehículo</a>
                                </li>

                                <li class="slide">
                                    <a href="{{ route('reportes.inventario_equipo') }}"
                                        id="reporteInventarioEquipoActivosOption" class="side-menu__item">Reporte
                                        inventario equipo</a>
                                </li>

                            </ul>
                        </li>
                        <!-- End::slide -->



                        @can('menu ventas')
                            <!-- Start::slide -->
                            <li class="slide has-sub" id="ventasMenu">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                                    </svg>
                                    <span class="side-menu__label">Ventas</span>
                                    <i class="ri-arrow-down-s-line side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    @can('read clientes')
                                        <li class="slide">
                                            <a href="{{ url('cliente') }}" id="clienteOption"
                                                class="side-menu__item">Clientes</a>
                                        </li>
                                    @endcan

                                    @can('reporte estados pagos')
                                        <li class="slide">
                                            <a href="{{ url('reportes/estado_pago') }}" id="estadoPagoOption"
                                                class="side-menu__item">Estados pagos</a>
                                        </li>
                                    @endcan

                                </ul>
                            </li>
                            <!-- End::slide -->
                        @endcan


                        @can('menu reportes')
                            <!-- Start::slide -->
                            <li class="slide has-sub" id="reportesMenu">
                                <a href="javascript:void(0);" class="side-menu__item">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 side-menu__icon"
                                        width="16" height="16" fill="currentColor" class="bi bi-clipboard-data"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0z" />
                                        <path
                                            d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                                        <path
                                            d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                                    </svg>


                                    <span class="side-menu__label">Reportes</span>
                                    <i class="ri-arrow-down-s-line side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child1">
                                    @can('reportes generales')
                                        <li class="slide">
                                            <a href="{{ url('reportes/generales') }}" id="reporteGeneralOption"
                                                class="side-menu__item">Reportes generales</a>
                                        </li>
                                    @endcan

                                    @can('reporte pagos mensuales')
                                        <li class="slide">
                                            <a href="{{ url('reportes/pagos_mensuales') }}" id="reportePagosOption"
                                                class="side-menu__item">Pagos mensuales</a>
                                        </li>
                                    @endcan

                                    @can('reporte estados ventas')
                                        <li class="slide">
                                            <a href="{{ url('reportes/ventas') }}" id="reporteVentasOption"
                                                class="side-menu__item">Reporte de ventas</a>
                                        </li>
                                    @endcan

                                    <li class="slide">
                                        <a href="{{ route('reportes.inventario_equipo') }}"
                                            id="reporteInventarioEquipoOption" class="side-menu__item">Inventario
                                            mobiliario y equipo</a>
                                    </li>

                                </ul>
                            </li>
                            <!-- End::slide -->
                        @endcan --}}


                    </ul>
                    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                        </svg></div>
                </nav>
                <!-- End::nav -->

            </div>
            <!-- End::main-sidebar -->

        </aside>
        <!-- End::app-sidebar -->

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">
                <div class="page-header-breadcrumb flex-wrap gap-2">
                </div>

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

                @yield('content')

            </div>
        </div>
        <!-- End::app-content -->


        <!-- Footer Start -->
        <footer class="footer mt-auto py-3 bg-white text-center">
            <div class="container">
                {{-- <span class="text-muted"> Copyright © <span id="year"></span> <a href="javascript:void(0);"
                        class="text-dark fw-medium">Xintra</a>.
                    Designed with <span class="bi bi-heart-fill text-danger"></span> by <a href="javascript:void(0);">
                        <span class="fw-medium text-primary">Spruko</span>
                    </a> All
                    rights
                    reserved
                </span> --}}
            </div>
        </footer>
        <!-- Footer End -->
        <!-- Modal Cambiar Contraseña -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Cambiar contraseña</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('password.change') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="password" class="form-label">Nueva contraseña</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmar nueva
                                    contraseña</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="header-responsive-search" tabindex="-1"
            aria-labelledby="header-responsive-search" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="input-group">
                            <input type="text" class="form-control border-end-0" placeholder="Search Anything ..."
                                aria-label="Search Anything ..." aria-describedby="button-addon2">
                            <button class="btn btn-primary" type="button" id="button-addon2"><i
                                    class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <ul class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none"></ul>


    <!-- Scroll To Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="ti ti-arrow-narrow-up fs-20"></i></span>
    </div>
    <div id="responsive-overlay"></div>
    <!-- Scroll To Top -->

    <!-- Popper JS -->
    <script src="{{ asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Defaultmenu JS -->
    <script src="{{ asset('assets/js/defaultmenu.min.js') }}"></script>

    <!-- Node Waves JS-->
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- Sticky JS -->
    <script src="{{ asset('assets/js/sticky.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.js') }}"></script>

    <!-- Auto Complete JS -->
    <script src="{{ asset('assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js') }}"></script>

    <!-- Color Picker JS -->
    <script src="{{ asset('assets/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>

    <!-- Date & Time Picker JS -->
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>



    <script>
        function expandMenuAndHighlightOption(menuId, optionId) {
            // Obtener el elemento del menú por su ID
            const menuElement = document.getElementById(menuId);
            // Obtener el elemento de la opción por su ID
            const optionElement = document.getElementById(optionId);

            // Desplegar el submenú
            if (menuElement) {
                menuElement.classList.add('is-expanded');
            }

            // Resaltar la opción seleccionada
            if (optionElement) {
                optionElement.classList.add('active');
            }
        }
    </script>


</body>

</html>
