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
        Schema::create('rentas_libros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nombre_libro');
            $table->unsignedBigInteger('usuario_id');
            $table->date('fecha_prestamo');
            $table->date('fecha_devolucion')->nullable();
            $table->integer('unidades_disponibles');
            $table->timestamps();
            
            // Relaciones
            $table->foreign('nombre_libro')->references('nombre')->on('libros')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentas_libros');
    }
};