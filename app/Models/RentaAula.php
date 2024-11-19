<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentaAula extends Model
{
    use HasFactory;

    // Nombre de la tabla correcto
    protected $table = 'renta_aulas';

    // Deshabilitar los timestamps, ya que no los estás usando
    public $timestamps = false;

    protected $fillable = [
        'usuario_id', 'nombre_aula', 'fecha_prestamo', 'unidades_disponibles', 'hora_inicio', 'hora_fin',
    ];

    // Relación con el modelo Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}