<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $table = 'Aulas'; // O 'Salas' si prefieres
    protected $fillable = ['nombre_aula', 'capacidad', 'ubicacion'];

    // Relación con Rentas_Salas
    public function rentas()
    {
        return $this->hasMany(RentaSala::class, 'id_sala');
    }
}
