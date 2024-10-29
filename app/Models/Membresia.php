<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{
    protected $table = 'Membresias';
    protected $fillable = ['id_persona', 'nivel_membresia', 'penalizaciones', 'telefono'];

    // Relación con Rentas de Materiales
    public function rentasMaterial()
    {
        return $this->hasMany(RentaMaterial::class, 'no_membresia');
    }

    // Relación con Rentas de Salas
    public function rentasSala()
    {
        return $this->hasMany(RentaSala::class, 'no_membresia');
    }

    // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_persona');
    }
}
