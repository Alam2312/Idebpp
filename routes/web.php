<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\IniSesController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\AlmacenamientoController;
use App\Http\Controllers\BusquedaController;


Route::get('/', function () { return view('index');})->name("Loguearse");
Route::get('/Desloguearse', [IniSesController::class, 'salir'])->name("Desloguearse");
Route::post('/Login', [IniSesController::class, 'create'])->name("login");

Route::get('/errors/noInternet', function () {
    return view('errors.noInternet');
});

Route::middleware(["checkAuth"])->group(function (){

    Route::middleware(["ruta"])->group(function (){
    Route::post('/Buscar', [BusquedaController::class, 'store'])->name("buscar");
    Route::resource('/Clientes', ClienteController::class);
    Route::resource('/Empleados', EmpleadoController::class);
    Route::resource('/Usuario', UsuarioController::class);
    Route::put('/Contraseña/{id}', [UsuarioController::class, "CambiarContraseña"]);
    Route::get('/Inicio', function () { return view('inicio'); });
    Route::get('/NuevoPedido', [ServicioController::class, 'NuevoServicio'])->name("BuscarInactivos");
    Route::resource('/Pedidos/Activos', ServicioController::class);
    Route::get('/Pedidos/Inactivos', [ServicioController::class, 'BuscarInactivos'])->name("BuscarInactivos");
    Route::get('/Pedidos/Rechazados', [ServicioController::class, 'BuscarRechazados'])->name("BuscarRechazados");
    Route::get('/Rehabilitar/{id}', [ServicioController::class, 'Rehabilitar'])->name("Rehabilitar");
    Route::post('/RehabilitarFecha', [ServicioController::class, 'CambiarFecha'])->name("RehabilitarFecha");
    Route::put('/CancelarPago/{id}', [ServicioController::class, 'CancelarPago'])->name("CancelarPago");
    Route::resource('/Imagen', ImagenController::class);
    Route::post('/ModificarImagen',[ImagenController::class, 'ModificarImagen']);
    Route::get('/EliminarImagen/{id}',[ImagenController::class, 'EliminarImagen']);
    Route::post('/Historico',[ImagenController::class, 'Historico']);
    Route::post('/Rechazar',[ImagenController::class, 'Rechazar']);
    Route::post('/Finalizar',[ImagenController::class, 'Finalizar']);
    Route::post('/Validar', [ImagenController::class, 'Validar']);
    Route::get('/Regresar/{id}', [ImagenController::class, 'Regresar']);
    
    Route::get('/Archivos/{id}', [ImagenController::class, "MostrarArchivos"])->name("MostrarArchivos");
    Route::post('/MostrarOPasos', [ImagenController::class, "MostrarOpcionesPasos"])->name("MostrarOpcionesPasos");
    Route::post('/BuscarPaso', [ImagenController::class, "BuscarPaso"])->name("BuscarPaso");
    Route::post('/ModificarFC', [ServicioController::class, "ActualizarDatos"]);
    Route::resource('/Pagos', PagosController::class);
    Route::get('/Saldar/{id}', [ImagenController::class, 'Saldar'])->name("Saldar");
    Route::get('/VotarC/{id}', [ClienteController::class, 'Votar']);
    Route::get('/VotarE/{id}', [EmpleadoController::class, 'Votar']);
    Route::get('/VotarP/{id}', [ServicioController::class, 'Votar']);
    Route::get('/ruta/externa/{path}', function ($path) { $path = base64_decode($path);return response()->file($path);})->name('ver_archivo');
});
    Route::post('/Actualizar', [AlmacenamientoController::class, 'Actualizar'])->name("Actualizar");
    Route::get('/Elegir', [AlmacenamientoController::class, 'Elegir'])->name("Elegir");
    Route::resource('/Almacenamiento', AlmacenamientoController::class);
});

