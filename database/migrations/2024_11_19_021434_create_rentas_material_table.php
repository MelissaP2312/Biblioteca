<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentasMaterialTable extends Migration
{
    public function up()
    {
        Schema::create('rentas_material', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users'); // Relación con el usuario
            $table->string('nombre_material');
            $table->date('fecha_prestamo');
            $table->integer('unidades_disponibles');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rentas_material');
    }
}