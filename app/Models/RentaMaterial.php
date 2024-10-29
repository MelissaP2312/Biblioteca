<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentaMaterial extends Model
{
    protected $table = 'Rentas_Material';
    protected $fillable = ['persona', 'no_membresia', 'id_material', 'fecha_salida', 'fecha_regreso'];

    // Relación con Membresia
    public function membresia()
    {
        return $this->belongsTo(Membresia::class, 'no_membresia');
    }

    // Relación con Material
    public function material()
    {
        return $this->belongsTo(Material::class, 'id_material');
    }
}
