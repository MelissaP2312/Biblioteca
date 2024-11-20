<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    // Desactivar los timestamps si no se necesitan
    public $timestamps = false;

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'nombre',
        'autor',
        'genero',
        'descripcion',
        'isbn',
        'unidades',
        'ranking',
        'imagen',
    ];

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }

    public function promedioRanking()
    {
        return $this->calificaciones()->avg('puntuacion');
    }

}
