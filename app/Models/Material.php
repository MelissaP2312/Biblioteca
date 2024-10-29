<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'Material';
    protected $fillable = ['nombre', 'tipo', 'unidades'];

    // Relación con Rentas_Material
    public function rentas()
    {
        return $this->hasMany(RentaMaterial::class, 'id_material');
    }
}
