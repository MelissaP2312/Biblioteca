<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentaLibro extends Model
{
    use HasFactory;

    // Nombre de la tabla correcto
    protected $table = 'rentas_libros';

    // Deshabilitar los timestamps, ya que no los estás usando
    public $timestamps = false;

    protected $fillable = [
        'usuario_id', 'nombre_libro', 'fecha_prestamo', 'unidades_disponibles'
    ];

    // Relación con el modelo Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}