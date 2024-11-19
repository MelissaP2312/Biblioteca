<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentasAulasTable extends Migration
{
    public function up()
    {
        Schema::create('renta_aulas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users'); // Relación con el usuario
            $table->string('nombre_aula');
            $table->date('fecha_prestamo');
            $table->integer('unidades_disponibles');
            $table->timestamps();
        });
    }

}