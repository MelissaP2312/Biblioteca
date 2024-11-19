<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentasLibrosTable extends Migration
{
    public function up()
    {
        Schema::create('renta_libros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('libro_id');
            $table->unsignedBigInteger('usuario_id');
            $table->date('fecha_prestamo');
            $table->date('fecha_devolucion')->nullable();
            $table->integer('cantidad');
            $table->timestamps();
            
            // Relaciones
            $table->foreign('libro_id')->references('id')->on('libros')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rentas_libros');
    }
}