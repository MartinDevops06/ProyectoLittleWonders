<?php

namespace App\Http\Controllers;

use App\Models\Producto;

class HomeController extends Controller
{
    public function index()
    {
        // Traer 3 productos destacados para mostrar en el home
        $productos = Producto::take(3)->get();

        return view('index', compact('productos'));
    }
}