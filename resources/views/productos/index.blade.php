@extends('layout')
@sectiom('title','Producto')
@section('content')
<h3 class="mt-4">Listado de productos</h3>
<div class="text-end">
    <a href="{{ url('productos/create') }}" class="btn btn-primary">Nuevo</a>
</div>
@if(session('type'))
    <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
        <strong>Noticia:</strong>{{ session('message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif 
<table class="table">
    <thead>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Precio</th>
        <th>Cantidad</th>
    </thead>
    <tbody>
         @foreach($datos as $producto)
            <tr>
                <td>
                    {{ $producto->nombre }}
                </td>
                <td>
                    {{ $producto->descripcion }}
                </td>
                <td>
                    {{ $producto->precio }}
                </td>
                <td>
                    {{ $producto->cantidad }}
                </td>
                <td>
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn info">
                        Editar
                    </a>
                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button class="btn btn-danger" onlcliks="return confirm('Quiere eliminar el producto')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop()