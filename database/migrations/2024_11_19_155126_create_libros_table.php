<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('nombre', 255); // Nombre del libro
            $table->string('autor', 255); // Autor del libro
            $table->string('genero', 100); // Género del libro
            $table->text('descripcion')->nullable(); // Descripción opcional
            $table->string('isbn', 20)->unique(); // ISBN único
            $table->integer('unidades')->default(0); // Unidades disponibles
            $table->decimal('ranking', 2, 1)->nullable(); // Ranking con 1 decimal
            $table->string('imagen')->nullable(); // Ruta de la imagen del libro
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libros');
    }
}

