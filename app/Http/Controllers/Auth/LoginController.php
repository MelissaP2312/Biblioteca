<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Asegúrate de que esta sea la vista correcta.
    }

    public function login(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Autenticación exitosa
            return redirect()->intended('/')->with('success', 'Has iniciado sesión correctamente');
        }

        // Si la autenticación falla, redirigir de nuevo con un mensaje de error
        return redirect()->back()->with('error', 'Las credenciales son incorrectas')->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Has cerrado sesión correctamente');
    }
}
