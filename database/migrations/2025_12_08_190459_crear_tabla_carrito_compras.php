<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Esta tabla podría usarse si asocias el carrito a un usuario registrado
        // o a una sesión temporal (si la sesión guarda el ID del carrito).
        Schema::create('carrito_compras', function (Blueprint $table) {
            $table->id();
            // Si el carrito es para un usuario, descomenta la siguiente línea:
            // $table->foreignId('usuario_id')->nullable()->constrained('users')->onDelete('cascade');
            
            $table->string('identificador_sesion', 255)->nullable()->comment('Usado para carritos de usuarios no autenticados');
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2)->comment('Precio del producto al momento de agregarlo');
            $table->timestamps();

            // Asegura que solo haya un tipo de producto por carrito/sesión
            $table->unique(['identificador_sesion', 'producto_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrito_compras');
    }
};