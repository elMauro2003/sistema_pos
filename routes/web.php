<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\PresentacioneController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedoreController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('template');
});

Route::view('/panel', 'panel.index')->name('panel');

Route::resources([
    'categorias' => CategoriaController::class,
    'presentaciones' => PresentacioneController::class,
    'marcas' => MarcaController::class,
    'productos' => ProductoController::class,
    'clientes' => ClienteController::class,
    'proveedores' => ProveedoreController::class,
    'compras' => CompraController::class,
    'ventas' => VentaController::class
]);

Route::get('/login', function(){
    return view('auth.login');
});

Route::get('/500', function(){
    return view('pages.500');
});

Route::get('/404', function(){
    return view('pages.404');
});

Route::get('/401', function(){
    return view('pages.404');
});

// vista para probar cosas
Route::view('/prueba', 'prueba')->name('prueba');