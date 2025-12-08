<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarritoController; // Asegúrate de que esta importación esté

    /*
    |--------------------------------------------------------------------------
    | RUTAS DEL FRONT OFFICE (PRODUCTOS)
    |--------------------------------------------------------------------------
    */

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::controller(ProductoController::class)->group(function () {
        Route::get('producto/', 'index')->name('productos.index');
        Route::get('/producto/{id}', 'show')->name('productos.show');
    });


    /*
    |--------------------------------------------------------------------------
    | RUTAS DEL CARRITO DE COMPRAS
    |--------------------------------------------------------------------------
    */

    // Muestra la página principal del carrito
    Route::get('carrito', [CarritoController::class, 'mostrarCarrito'])->name('carrito.mostrar');

        // Agrega un producto al carrito
        Route::post('carrito/agregar/{idProducto}', [CarritoController::class, 'agregar'])->name('carrito.agregar');

        // Actualiza la cantidad (usando PUT o PATCH)
        Route::patch('carrito/actualizar/{idProducto}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');

        // Elimina un producto
        Route::delete('carrito/eliminar/{idProducto}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');