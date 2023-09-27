<?php
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;


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

/*Route::get('/', function () {
    return view('home');
});*/

//  ADMINISTRATION

    Route::get('/admin', [ProductsController::class, 'index'])->name('administracion.index');;
    Route::get('/admin/productos/ver_todos', [ProductsController::class, 'ver_todos'])->name('administracion.productos.ver_todos');
    Route::get('/admin/productos/crear', [ProductsController::class, 'crear'])->name('administracion.productos.agregar');
    
    Route::post('/ajax_fetch_modelos', [ProductsController::class, 'buscar_xmarca']);

//  ECOMMERCE

    Route::get('/', [ProductsController::class, 'home']);

