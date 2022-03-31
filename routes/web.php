<?php

use App\Http\Controllers\FacturaController;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

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

Route::get('/', [ProductoController::class, "index"])->name("producto.index");
Route::get('/home', [ProductoController::class, "index"])->name("home");

// productos
Route::resource('producto', ProductoController::class)->names("producto");
Route::post('/producto/compra/{producto}', [ProductoController::class, "compra"])->name("producto.compra");

// facturas
Route::resource('factura', FacturaController::class)->names("factura");
Route::get('/facturar/todo', [FacturaController::class, "facturar"])->name("factura.facturar");


Auth::routes();
