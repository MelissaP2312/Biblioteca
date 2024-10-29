<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('registro'); // Asegúrate de que esta sea la vista correcta.
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'edad' => 'required|integer|min:1|max:120',
            'genero' => 'required|string',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        try{
        // Crear el usuario
        User::create([
            'nombre' => $request->nombre,
            'edad' => $request->edad,
            'genero' => $request->genero,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirigir a una página de éxito o al login
        return redirect()->route('login')->with('success', 'Registro exitoso');
    }catch (\Exception $e) {
        // Redirigir de nuevo al registro con un mensaje de error
        return redirect()->route('register')->with('error', 'Error al registrar el usuario: ' . $e->getMessage());
    }
}
}