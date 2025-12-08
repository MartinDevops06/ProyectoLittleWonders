<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tu Carrito de Compras | Little Wonders</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        /* Paleta suave para maternidad */
        .bg-brand { background-color: #fce7f3; } /* Rosa suave */
        .text-brand { color: #db2777; }
        .btn-primary { background-color: #db2777; color: white; }
        .btn-primary:hover { background-color: #be185d; }
        .btn-secondary { background-color: #fce7f3; color: #db2777; }
        .btn-secondary:hover { background-color: #fbcfe8; }

        /* Estilo para simular la tabla de la imagen */
        .tabla-carrito th { background-color: #fce7f3; color: #db2777; padding-top: 1rem; padding-bottom: 1rem; }
    </style>
</head>
<body class="bg-gray-50 font-sans">

    {{-- HEADER (Reutiliza la estructura del index para consistencia) --}}
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-brand flex items-center gap-2">
                <i class="fa-solid fa-baby-carriage"></i> Little Wonders
            </a>
            <div class="flex items-center gap-4">
                {{-- Ícono del carrito (Puedes omitirlo aquí, ya estás en la página del carrito) --}}
            </div>
        </div>
        <div class="bg-white border-t">
            <div class="container mx-auto px-4 py-3">
                <a href="{{ route('home') }}" class="inline-block text-gray-600 hover:text-brand text-sm font-medium">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Seguir Comprando
                </a>
            </div>
        </div>
    </nav>

    {{-- CONTENIDO PRINCIPAL DEL CARRITO --}}
    <main class="container mx-auto px-4 py-10">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-xl p-6 md:p-10">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8 uppercase tracking-wider">
                TU CARRITO DE COMPRAS
            </h1>

            @if(session('mensaje'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('mensaje') }}</span>
                </div>
            @endif

            @if(empty($articulos))
                <div class="text-center py-10">
                    <i class="fa-solid fa-box-open text-6xl text-gray-300"></i>
                    <p class="text-xl text-gray-600 mt-4">Tu carrito está vacío. ¡Es hora de llenarlo de maravillas!</p>
                    <a href="{{ route('home') }}" class="mt-6 inline-block btn-primary px-6 py-3 rounded-full font-semibold">
                        Ir a Comprar
                    </a>
                </div>
            @else
                {{-- TABLA DE PRODUCTOS --}}
                <table class="w-full text-left tabla-carrito">
                    <thead>
                        <tr class="border-b border-pink-200">
                            <th class="w-10"></th>
                            <th class="w-1/2">PRODUCTO</th>
                            <th class="w-1/6">PRECIO</th>
                            <th class="w-1/6 text-center">CANTIDAD</th>
                            <th class="w-1/6 text-right">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articulos as $id => $articulo)
                        <tr class="border-b border-gray-100">
                            <td class="py-4 align-top">
                                {{-- Formulario para ELIMINAR --}}
                                <form action="{{ route('carrito.eliminar', $articulo['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition" title="Eliminar">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="py-4">
                                <div class="flex items-start gap-4">
                                    {{-- Muestra la imagen (ajusta la ruta según tu configuración) --}}
                                    <img src="{{ asset('storage/FotoProductos/' . $articulo['foto']) }}" 
                                        alt="{{ $articulo['nombre'] }}" 
                                        class="w-16 h-16 object-cover rounded-md border border-gray-100">
                                    <div class="flex flex-col">
                                        <span class="font-medium text-gray-800">{{ $articulo['nombre'] }}</span>
                                        <span class="text-sm text-gray-500">ID: {{ $articulo['id'] }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 text-gray-700 font-medium">
                                ${{ number_format($articulo['precio'], 0, ',', '.') }}
                            </td>
                            <td class="py-4 text-center">
                                <div class="flex items-center justify-center">
                                    
                                    {{-- FORMULARIO 1: Botón de Disminución (-) --}}
                                    <form action="{{ route('carrito.actualizar', $articulo['id']) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="cantidad" value="{{ $articulo['cantidad'] - 1 }}" 
                                            class="bg-gray-100 text-gray-600 w-8 h-8 rounded-l hover:bg-gray-200 transition disabled:opacity-50"
                                            @if($articulo['cantidad'] <= 1) disabled @endif> 
                                            - 
                                        </button>
                                    </form>
                                    
                                    {{-- CAMPO DE CANTIDAD (Solo muestra el valor, no es submit) --}}
                                    <input type="number" value="{{ $articulo['cantidad'] }}" min="1" 
                                        class="w-10 h-8 text-center border border-gray-300 focus:outline-none text-gray-800"
                                        readonly> {{-- Poner 'readonly' para evitar edición si no lo quieres enviar por separado --}}
                                    
                                    {{-- FORMULARIO 2: Botón de Incremento (+) --}}
                                    <form action="{{ route('carrito.actualizar', $articulo['id']) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="cantidad" value="{{ $articulo['cantidad'] + 1 }}" 
                                            class="bg-gray-100 text-gray-600 w-8 h-8 rounded-r hover:bg-gray-200 transition"> 
                                            + 
                                        </button>
                                    </form>

                                </div>
                            </td>
                            <td class="py-4 text-right font-bold text-pink-600">
                                ${{ number_format($articulo['precio'] * $articulo['cantidad'], 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                {{-- RESUMEN Y ACCIONES --}}
                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
                    <div class="w-full md:w-2/5">
                        <div class="flex justify-between items-center text-xl font-bold mb-6">
                            <span>SUBTOTAL:</span>
                            <span class="text-brand">${{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="flex flex-col gap-3">
                            <button class="btn-primary w-full py-3 rounded-full font-semibold uppercase tracking-wider shadow-lg shadow-pink-200">
                                IR A PAGAR
                            </button>
                            <a href="{{ route('home') }}" class="text-center">
                                <button class="btn-secondary w-full py-3 rounded-full font-semibold uppercase tracking-wider hover:shadow">
                                    SEGUIR COMPRANDO
                                </button>
                            </a>
                        </div>
                    </div>
                </div>

            @endif
        </div>
    </main>
    
    <footer class="bg-white border-t mt-12 py-8 text-center text-gray-500 text-sm">
        <p>&copy; {{ date('Y') }} Little Wonders. Hecho con amor.</p>
    </footer>

</body>
</html>