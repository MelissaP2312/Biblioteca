<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth; // Asegúrate de incluir esto

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validación de entrada
        $request->validate([
            'correo' => 'required|email',
            'contraseña' => 'required|string',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt(['correo' => $request->correo, 'contraseña' => $request->contraseña])) {
            // Autenticación exitosa, redirigir a la página de inicio
            return redirect()->intended('/foros'); // Redirige a la página deseada
        } else {
            // Autenticación fallida
            return back()->withErrors(['correo' => 'Correo o contraseña incorrectos.']);
        }
    }

    public function logout()
    {
        Auth::logout(); // Cerrar sesión
        return redirect('/login'); // Redirigir a la página de inicio de sesión
    }
}

