<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Empleado extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The name of the table associated with the model.
     *
     * @var string
     */
    protected $table = 'empleados'; // Si tu tabla se llama 'empleados'

    /**
     * La clave primaria no será un autoincremento
     *
     * @var string
     */
    protected $primaryKey = 'id_empleado';

    /**
     * Indicar que la clave primaria no es autoincrementable
     *
     * @var bool
     */
    public $incrementing = false; // Desactivar el autoincremento

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_empleado', // Ahora 'id_empleado' está incluido en el fillable
        'nombre',
        'genero',
        'edad',
        'telefono',
        'email',
        'password',
    ];

    /**
     * Los atributos que deben ser ocultos para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deberían ser convertidos a tipos nativos.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Personalizar el atributo de la contraseña para que se encripte automáticamente.
     */
    public function setContraseñaAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
