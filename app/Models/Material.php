<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materials';

    // Deshabilitar los timestamps, ya que no los estás usando
    public $timestamps = false;

    // Asegúrate de que los campos sean asignables masivamente
    protected $fillable = [
        'tipo',    // Agregar tipo aquí
        'unidades', // Y unidades
    ];
}
