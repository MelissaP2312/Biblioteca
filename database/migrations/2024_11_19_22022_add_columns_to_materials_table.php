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
        Schema::table('materials', function (Blueprint $table) {
            // Agregar las columnas 'tipo' y 'unidades'
            $table->string('tipo')->nullable()->after('id');
            $table->integer('unidades')->default(0)->after('tipo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            // Eliminar las columnas 'tipo' y 'unidades'
            $table->dropColumn(['tipo', 'unidades']);
        });
    }
};
