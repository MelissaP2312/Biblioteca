<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empleado;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterEmpleadoController extends Controller
{
    /**
     * Muestra el formulario de registro para empleados.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('registroempleado'); // Aquí deberías tener una vista para el formulario
    }

    /**
     * Registra un nuevo empleado.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validar los datos
        $request->validate([
            'id_empleado' => 'required|unique:empleados,id_empleado', // Ajusta según tu tabla
            'nombre' => 'required|string|max:255',
            'edad' => 'required|integer|min:18|max:120',
            'genero' => 'required|string',
            'telefono' => 'required|string',
            'email' => 'required|email|unique:empleados,email',
            'password' => 'required|string|confirmed|min:8',
            'puesto' => 'required|string',
            'fecha_ingreso' => 'required|date',
            'departamento' => 'required|string',
        ]);

        // Crear el nuevo empleado
        $empleado = new Empleado([
            'id_empleado' => $request->id_empleado,
            'nombre' => $request->nombre,
            'edad' => $request->edad,
            'genero' => $request->genero,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'puesto' => $request->puesto,
            'fecha_ingreso' => $request->fecha_ingreso,
            'departamento' => $request->departamento,
        ]);

        // Guardar el empleado en la base de datos
        $empleado->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('empleado.register')->with('success', 'Empleado registrado exitosamente');
    }
}
