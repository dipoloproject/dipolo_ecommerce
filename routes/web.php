<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\MediaFilesController;
use App\Http\Controllers\MarcasController;

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

    Route::get('/admin', [ProductsController::class, 'index'])->name('administracion.index');

    // CATEGORIAS
        Route::get('/admin/categorias/ver_todos', [CategoriesController::class, 'ver_todos'])->name('administracion.categorias.ver_todos');
            Route::post('/ajaxpro', [CategoriesController::class, 'ajaxpro']);
        Route::get('/admin/categorias/crear', [CategoriesController::class, 'crear'])->name('administracion.categorias.agregar');
            Route::post('/subir_categoria', [CategoriesController::class, 'subir_categoria']);
        Route::post('/eliminar_categoria', [CategoriesController::class, 'eliminar_categoria']);
        Route::get('/admin/categorias/editar/{id}', [CategoriesController::class, 'editar'])->name('administracion.categorias.editar');
            Route::post('/ajax_fetch_rubro_xid', [CategoriesController::class, 'ajax_fetch_rubro_xid']);
            Route::post('/actualizar_categorias', [CategoriesController::class, 'actualizar_categorias']);
    // PRODUCTOS
        Route::get('/admin/productos/ver_todos', [ProductsController::class, 'ver_todos'])->name('administracion.productos.ver_todos');
        Route::get('/admin/productos/crear', [ProductsController::class, 'crear'])->name('administracion.productos.agregar');
        Route::get('/admin/productos/editar/{id}', [ProductsController::class, 'editar'])->name('administracion.productos.editar');

        Route::get('/admin/archivos_multimedia/{id}', [MediaFilesController::class, 'ver_orden'])->name('administracion.archivos_multimedia.ver_orden');
        Route::post('/ajax_fetch_order_media_files', [MediaFilesController::class, 'ajax_fetch_order_media_files']);
        
            Route::post('/ajax_fetch_productos', [ProductsController::class, 'ajax_fetch_productos']);
            Route::post('/ajax_fetch_producto_xid', [ProductsController::class, 'ajax_fetch_producto_xid']);
    
            Route::post('/ajax_fetch_modelos', [ProductsController::class, 'buscar_xmarca']);
        
        Route::post('/subir_archivos_productos', [ProductsController::class, 'subir_archivos_productos']);
        Route::post('/actualizar_archivos_y_productos', [ProductsController::class, 'actualizar_archivos_y_productos']);
        Route::post('/eliminar_producto', [ProductsController::class, 'eliminar_producto']);
        Route::post('/admin/productos/formulario', [ProductsController::class, 'formulario'])->name('administracion.productos.formulario');

    // MARCAS
        Route::get('/admin/marcas/crear', [MarcasController::class, 'crear'])->name('administracion.marcas.agregar');
        Route::post('/admin/marcas/guardar', [MarcasController::class, 'guardar'])->name('administracion.marcas.guardar');


//  ECOMMERCE

    Route::get('/', [ProductsController::class, 'home']);
    Route::get('/producto/{id}', [ProductsController::class, 'producto'])->name('producto_singular');

    
