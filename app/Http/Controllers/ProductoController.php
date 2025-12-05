<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Producto::query();

        // Lógica de Búsqueda
        if ($request->filled('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%')
                  ->orWhere('descripcion', 'like', '%' . $request->search . '%');
        }

        // Lógica simulada de categorías (Filtrado simple por nombre para el ejemplo)
        if ($request->filled('category')) {
            $query->where('nombre', 'like', '%' . $request->category . '%');
        }

        $productos = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('index', ['productos' => $productos]);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('productos.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:100',
            'descripcion' => 'required|max:150',
            'precio'=>'max:7',
            'cantidad' => 'max:100'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                         ->withInput();
        }
        else {
            Producto::create($request->all());
            
            return redirect('productos')->with('type','success')
                                         ->with('message','Producto agregado correctamente');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        
        // Productos relacionados (simulados: toma 4 aleatorios)
        $relacionados = Producto::where('id', '!=', $id)->inRandomOrder()->take(4)->get();

        return view('productos.show', compact('producto', 'relacionados'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $datos = Producto::find($id);
        return view('productos.edit', compact('datos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:100',
            'descripcion' => 'required|max:150',
            'precio' => 'max:7',
            'cantidad' => 'max:100'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                         ->withInput();
        }
        else{
            $producto->update($request->all());
            //Producto::create($request->all());

            return redirect('productos')->with('type', 'warning')
                                         ->with('message','Producto actualizado correctamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Producto::destroy($id);
        return redirect('productos')->with('type', 'danger')
                                    ->with('message', 'El producto se eilimino');
    }
}
