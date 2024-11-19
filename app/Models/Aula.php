<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

     // Desactivar los timestamps si no se necesitan
     public $timestamps = false;

    // Habilitar asignación masiva para estas columnas
    protected $fillable = [
        'nombre_aula',
        'capacidad',
        'ubicacion',
    ];
}
