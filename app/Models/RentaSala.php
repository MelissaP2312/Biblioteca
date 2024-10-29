<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentaSala extends Model
{
    protected $table = 'Rentas_Salas';
    protected $fillable = ['persona', 'no_membresia', 'id_sala', 'fecha_reserva', 'hora_inicio', 'hora_fin'];

    // Relación con Membresia
    public function membresia()
    {
        return $this->belongsTo(Membresia::class, 'no_membresia');
    }

    // Relación con Aulas (o Salas)
    public function sala()
    {
        return $this->belongsTo(Aula::class, 'id_sala');
    }
}
