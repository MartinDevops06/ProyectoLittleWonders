<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('index');
});

// Agrupamos las rutas del front office
Route::controller(ProductoController::class)->group(function () {
    Route::get('/', 'index')->name('productos.index');
    Route::get('/producto/{id}', 'show')->name('productos.show');
});