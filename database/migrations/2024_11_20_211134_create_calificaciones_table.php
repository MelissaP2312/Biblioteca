<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('calificaciones', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('libro_id'); // Relación con la tabla de libros
        $table->unsignedInteger('puntuacion'); // Valor de 1 a 5
        $table->timestamps();

        // Llave foránea
        $table->foreign('libro_id')->references('id')->on('libros')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('calificaciones');
}

};
