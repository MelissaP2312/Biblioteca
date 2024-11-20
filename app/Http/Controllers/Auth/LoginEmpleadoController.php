<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Empleado;

class LoginEmpleadoController extends Controller
{
    public function showLoginForm()
    {
        return view('loginempleados'); // Asegúrate de que esta sea la vista correcta.
    }

    public function login(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'id_empleado' => 'required|string',
            'password' => 'required|string',
        ]);

        // Intentar autenticar al empleado
        if (Auth::guard('empleado')->attempt([
            'id_empleado' => $request->id_empleado, 
            'password' => $request->password
        ])) {
            // Autenticación exitosa
            return redirect()->intended('/admin')->with('success', 'Has iniciado sesión correctamente');
        }

        // Si la autenticación falla, redirigir con un mensaje de error
        return redirect()->back()->with('error', 'Las credenciales son incorrectas')->withInput($request->only('id_empleado'));
    }

    public function logout(Request $request)
    {
        Auth::guard('empleado')->logout();
        return redirect('/')->with('success', 'Has cerrado sesión correctamente');
    }
}
