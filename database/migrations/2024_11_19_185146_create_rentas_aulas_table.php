<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAulasTable extends Migration
{
    public function up()
    {
        Schema::create('aulas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_aula');
            $table->integer('capacidad');
            $table->string('ubicacion');
            $table->boolean('disponible')->default(true); // Establecer predeterminado como 'true' (1)
            $table->timestamps(); // Si deseas tener marcas de tiempo
        });
    }

}