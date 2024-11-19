<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRentasLibrosTable extends Migration
{
    public function up()
    {
        Schema::table('rentas_libros', function (Blueprint $table) {
            // Renombrar la columna 'libro_id' a 'nombre_libro'
            $table->renameColumn('libro_id', 'nombre_libro');
            
            // Cambiar la relación para que 'nombre_libro' haga referencia al campo 'nombre' en lugar de 'id'
            // Si 'nombre' en la tabla 'libros' no es único, tendrías que considerar cambiar esto
            $table->dropForeign(['nombre_libro']);
            $table->foreign('nombre_libro')->references('nombre')->on('libros')->onDelete('cascade');
            
            // Cambiar el campo 'cantidad' por 'unidades_disponibles'
            $table->renameColumn('cantidad', 'unidades_disponibles');
        });
    }

    public function down()
    {
        Schema::table('rentas_libros', function (Blueprint $table) {
            // Revertir los cambios si la migración se revierte
            $table->renameColumn('nombre_libro', 'libro_id');
            $table->dropForeign(['nombre_libro']);
            $table->foreign('libro_id')->references('id')->on('libros')->onDelete('cascade');
            $table->renameColumn('unidades_disponibles', 'cantidad');
        });
    }
}
