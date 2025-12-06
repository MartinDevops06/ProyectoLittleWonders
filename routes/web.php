<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');


// Agrupamos las rutas del front office
Route::controller(ProductoController::class)->group(function () {
    Route::get('producto/', 'index')->name('productos.index');
    Route::get('/producto/{id}', 'show')->name('productos.show');
});