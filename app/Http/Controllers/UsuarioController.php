<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    // Muestra la lista de usuarios
    public function index()
    {
        $usuarios = User::all();  // Trae todos los usuarios
        return view('ListaUsuarios', compact('usuarios'));
    }

    // Muestra el formulario para crear un nuevo usuario
    public function create()
    {
        return view('usuarios.create');
    }

    // Almacena un nuevo usuario en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Crear el nuevo usuario
        $usuario = new User();
        $usuario->name = $validated['name'];
        $usuario->email = $validated['email'];
        $usuario->password = bcrypt($validated['password']);
        $usuario->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    // Muestra el formulario para editar un usuario existente
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Actualiza un usuario existente en la base de datos
    public function update(Request $request, $id)
    {
        // Validación de los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8|confirmed', // El campo de password es opcional
        ]);

        // Buscar y actualizar el usuario
        $usuario = User::findOrFail($id);
        $usuario->name = $validated['name'];
        $usuario->email = $validated['email'];
        if ($request->filled('password')) {
            $usuario->password = bcrypt($validated['password']);
        }
        $usuario->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Elimina un usuario de la base de datos
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}