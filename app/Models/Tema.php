<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;

    // Si los nombres de tus columnas no siguen la convención de Laravel (por ejemplo, 'created_at', 'updated_at'),
    // puedes deshabilitar la marca de tiempo automática.
    public $timestamps = true;  // Esto es opcional si usas timestamps

    // Define los campos que son asignables masivamente.
    protected $fillable = ['titulo', 'descripcion'];
}
