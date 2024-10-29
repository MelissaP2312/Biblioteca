<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentaLibro extends Model
{
    protected $table = 'Rentas_Libros';
    protected $fillable = ['persona', 'no_membresia', 'id_libro', 'fecha_salida', 'fecha_regreso'];

    // Relación con Membresia
    public function membresia()
    {
        return $this->belongsTo(Membresia::class, 'no_membresia');
    }

    // Relación con Libros
    public function libro()
    {
        return $this->belongsTo(Libro::class, 'id_libro');
    }
}
