<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    // Mostrar el formulario de creación
    public function create()
    {
        return view('RegistroAulas'); // Asegúrate de que esta vista exista en 'resources/views'
    }

    // Guardar una nueva aula
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre_aula' => 'required|string|max:100',
            'capacidad' => 'required|integer|min:1',
            'ubicacion' => 'required|string|max:255',
        ]);
    
        // Crear un nuevo registro en la base de datos (sin necesidad de enviar 'disponible' ya que es predeterminado)
        Aula::create([
            'nombre_aula' => $request->nombre_aula,
            'capacidad' => $request->capacidad,
            'ubicacion' => $request->ubicacion,
            // 'disponible' no se necesita incluir aquí ya que tiene un valor predeterminado de 1
        ]);
    
        return redirect()->route('aula.create')->with('success', 'Aula registrada con éxito.');
    }
    
    
}
