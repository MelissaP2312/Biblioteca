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
    Schema::create('aulas', function (Blueprint $table) {
        $table->id();                         // id INT AUTO_INCREMENT PRIMARY KEY
        $table->string('nombre_aula');        // nombre_aula VARCHAR(100) NOT NULL
        $table->integer('capacidad');         // capacidad INT NOT NULL
        $table->string('ubicacion');          // ubicacion VARCHAR(255) NOT NULL
        $table->timestamps();                 // created_at y updated_at
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aulas');
    }
};
