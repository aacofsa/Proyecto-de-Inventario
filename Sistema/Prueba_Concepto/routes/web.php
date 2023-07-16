<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\BodegaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\RegistroProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CompraventaController;
use App\Http\Controllers\ProductoBodegaController;
use App\Http\Controllers\AccesoBodegaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('empleado', EmpleadoController::class)->middleware('auth');

Route::resource('bodega', BodegaController::class)->middleware('auth');

Route::resource('producto', ProductoController::class)->middleware('auth');

// rutas vistas de empresa
Route::get('empresa', [EmpresaController::class, 'vista_index'])->middleware('auth');;
Route::get('empresa/crear', [EmpresaController::class, 'vista_crear'])->middleware('auth');;
Route::get('empresa/{id}/modificar', [EmpresaController::class, 'vista_editar'])->middleware('auth');;
Route::get('empresa/{id}/ver', [EmpresaController::class, 'vista_ver'])->middleware('auth');;
Route::get('empresa/{id}/metricas', [EmpresaController::class, 'metricas'])->middleware('auth');;
// rutas interaccion bdd
Route::post('empresa', [EmpresaController::class, 'guardar'])->middleware('auth');;
Route::patch('empresa/{id}', [EmpresaController::class, 'actualizar'])->middleware('auth');;

Route::resource('registro_producto', RegistroProductoController::class)->middleware('auth');
Route::resource('compraventa', CompraventaController::class)->middleware('auth');

Route::get('{id}/compraventa_detalle', [CompraventaController::class, 'compraventa_detalle']);
Route::get('{id}/obtenerLotesRP', [CompraventaController::class, 'obtenerLotesRP']);
Route::get('{id}/obtenerProductos/{ids}', [CompraventaController::class, 'obtenerProductos']);

Route::get('{id}/bodega_detalle', [BodegaController::class, 'bodega_detalle']);
Route::get('{id}/obtenercomuna', [BodegaController::class, 'obtenercomuna']);
Route::get('{id}/obtenerempresa', [BodegaController::class, 'obtenerempresa']);

Route::resource('lote', LoteController::class)->middleware('auth');

Route::resource('producto', ProductoController::class)->middleware('auth');

Route::resource('categoria', CategoriaController::class)->middleware('auth');
Route::resource('usuario', UsuarioController::class)->middleware('auth');
Route::resource('producto_bodega', ProductoBodegaController::class)->middleware('auth');
Route::get('pb/{id}', [ProductoBodegaController::class, 'seleccionar'])->middleware('auth');

Auth::routes();

Route::get('/home', function () {
    return view('home');
});


Route::resource('acceso_bodega', AccesoBodegaController::class);
