<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\PendienteController;
use App\Http\Controllers\UserController;



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

Route::get('/', [App\Http\Controllers\index::class, 'index'])->name('index');//vista index principal

Route::middleware(['auth:sanctum','verified'])->get('/dash', function(){
    return view('dash.index');
})->name('dash');
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//rutas del carro de compras
Route::post('/agregar/{idProducto}', [CarroController::class, 'store'])->name('agregar');
Route::post('/aumento/{idCarro}', [CarroController::class, 'aumento'])->name('aumento');
Route::post('/disminucion/{idCarro}', [CarroController::class, 'disminucion'])->name('disminucion');
Route::post('/destroy/{idCarro}', [CarroController::class, 'destroy'])->name('destroy');

//rutas del administrador
Route::group(['middleware' => ['auth']], function(){
    Route::resource('roles', RolController::class);//ruta de gestion de roles
    Route::resource('usuarios', UsuarioController::class);//ruta de usuarios de administrador
    Route::resource('producto', ProductoController::class)->middleware('can:adm-productos');//ruta de los productos de administrador
    Route::resource('carro', CarroController::class);//ruta del carro de compras
    Route::resource('pendientes', PendienteController::class);//ruta de pedidos pendientes
    Route::GET('/historial', [PendienteController::class, 'indexHistorial'])->middleware('can:adm-pedidos')->name('historial');//ruta de historial de pedidos despachados
    Route::POST('/pendientesDetalle/{idPedido}', [PendienteController::class, 'mostrarDetalle'])->middleware('can:adm-pedidos')->name('pendientesDetalle');//ruta de pedidos pendientes
    Route::resource('users', UserController::class)->middleware('can:adm-gestionSupervisorCuenta')->names('admin.users');
});
