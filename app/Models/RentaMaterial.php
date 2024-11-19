<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentaMaterial extends Model
{

    use HasFactory;

   // Nombre de la tabla
   protected $table = 'rentas_material';

   // Deshabilitar los timestamps si no los estás usando
   public $timestamps = false;

   protected $fillable = [
       'usuario_id', 'nombre_material', 'fecha_prestamo', 'unidades_disponibles'
   ];

   // Relación con el modelo Usuario
   public function usuario()
   {
       return $this->belongsTo(User::class, 'usuario_id');
   }
}
