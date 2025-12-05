@extends('layout')
@section('title','Registro Producto')
@section('content')
<h3 class="mt-4 mb-3">Registro Productos</h3>
<form action="{{ url('productos') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="nombre" class="form-control" placeholder="Ingrese nombre" 
                value="{{ old('nombre') }}">
            @error('nombre')
                <div class="error compacto col-lg-5">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="descripcion" class="form-control" placeholder="Ingrese descripción"
                value="{{ old('descripcion') }}">
            @error('descripcion')
                <div class="error compacto col-lg-5">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="precio" class="form-control" placeholder="Ingrese precio"
                value="{{ old('precio') }}">
            @error('Precio')
                <div class="error compacto col-lg-5">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="cantidad" class="form-control" placeholder="Ingrese cantidad"
                value="{{ old('cantidad') }}">
            @error('cantidad')
                <div class="error compacto col-lg-5">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <button class="btn btn-success">Guardar</button>
    <a href="{{ url('productos') }}" class="btn btn-secondary">Cancelar</a>
</form>
@stop 
@section('js')
    <script src="{{ url('js/jquery.validate.min.js') }}"></script>
    <script src="{{ url('js/localization/messages_es.min.js') }}"></script>

    <script>
        $("#form").validate({
            rules: {
                nombre: {
                    required: true,
                    maxlength: 100
                },
                descripcion: {
                    required: true,
                    maxlength: 150
                }
                precio: {
                    required: true,
                    maxlength: 7
                }
                cantidad: {
                    required: true,
                    maxlength: 100
                }
            }
        });
    </script>
@stop