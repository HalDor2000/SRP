<?php

use App\Http\Controllers\activo\EquipoController;
use App\Http\Controllers\activo\VehiculoController;
use App\Http\Controllers\catalogo\AmbienteController;
use App\Http\Controllers\catalogo\ClaseController;
use App\Http\Controllers\catalogo\ColorController;
use App\Http\Controllers\catalogo\CuentaContableController;
use App\Http\Controllers\catalogo\DepartamentoController;
use App\Http\Controllers\catalogo\EstadoFisicoController;
use App\Http\Controllers\catalogo\FuenteController;
use App\Http\Controllers\catalogo\GerenciaController;
use App\Http\Controllers\catalogo\GrupoController;
use App\Http\Controllers\catalogo\MarcaController;
use App\Http\Controllers\catalogo\MaterialController;
use App\Http\Controllers\catalogo\ProcedenciaController;
use App\Http\Controllers\catalogo\SubClaseController;
use App\Http\Controllers\catalogo\TraccionController;
use App\Http\Controllers\catalogo\UnidadController;
use App\Http\Controllers\MigracionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\seguridad\PermissionController;
use App\Http\Controllers\seguridad\PermissionTypeController;
use App\Http\Controllers\seguridad\RoleController;
use App\Http\Controllers\seguridad\UserController;
use App\Http\Controllers\SolicitudController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('password.change');

    //seguridad
    Route::resource('seguridad/permission_type', PermissionTypeController::class);
    Route::resource('seguridad/permission', PermissionController::class);
    Route::post('seguridad/role/update_permission', [RoleController::class, 'updatePermission']);
    Route::resource('seguridad/role', RoleController::class);
    Route::post('seguridad/user/update_password/{id}', [UserController::class, 'updatePassword']);
    Route::put('seguridad/user/sync_rol/{user_id}/{rol_id}', [UserController::class, 'sync_rol']);
    Route::resource('seguridad/user', UserController::class);

    Route::resource('solicitudes', SolicitudController::class);
});
