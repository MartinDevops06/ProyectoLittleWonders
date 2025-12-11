<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->string('nombre', 150);
            $table->string('descripcion', 500);
            $table->decimal('precio', 10, 2);
            $table->text('foto');
            $table->string('classification', 50);
            $table->json('gallery_images')->nullable();
            $table->string('brand', 50)->nullable();
            $table->timestamps();

            $table->index('category_id', 'fk_product_category1_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};