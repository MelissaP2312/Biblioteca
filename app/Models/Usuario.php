<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $fillable = ['nombre', 'genero', 'edad', 'telefono', 'correo', 'contraseña'];

    // Relación con Membresías
    public function membresias()
    {
        return $this->hasMany(Membresia::class, 'id_persona');
    }

    // Para autenticar usando el campo 'correo' en lugar de 'email'
    public function getAuthIdentifierName()
    {
        return 'correo'; // Este es el campo que se utilizará para la autenticación
    }
    
    // Para evitar que el campo 'contraseña' se muestre
    protected $hidden = ['contraseña']; // Esto oculta la contraseña al serializar
}
