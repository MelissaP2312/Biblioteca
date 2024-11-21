<?php

namespace App\Http\Controllers;

use App\Models\RentaLibro;
use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\User;

class RentasPrincipalController extends Controller
{
    // Mostrar formulario para registrar una nueva renta
    public function create()
    {
        $libros = Libro::all();  // Obtener todos los libros
        $usuarios = User::all(); // Obtener todos los usuarios
        return view('rentaPrincipal', compact('libros', 'usuarios'));
    }

    // Guardar una nueva renta
    public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'nombre_libro' => 'required|exists:libros,nombre', // Validar que el libro exista
        'usuario_id' => 'required|exists:users,id', // Validar que el usuario exista
        'fecha_prestamo' => 'required|date',
        'unidades_disponibles' => 'required|integer|min:1',
    ]);

    // Buscar el libro por su nombre
    $libro = Libro::where('nombre', $request->nombre_libro)->first();

    // Verificar si hay suficientes unidades disponibles
    if ($libro->unidades < $request->unidades_disponibles) {
        return redirect()->route('rentas.create')->with('error', 'No hay suficientes unidades disponibles para este libro.');
    }

    // Crear un nuevo registro en la base de datos para la renta
    RentaLibro::create([
        'usuario_id' => $request->usuario_id,
        'nombre_libro' => $libro->nombre,
        'fecha_prestamo' => $request->fecha_prestamo,
        'unidades_disponibles' => $request->unidades_disponibles,
    ]);

    // Disminuir la cantidad de unidades disponibles en el libro
    $libro->unidades -= $request->unidades_disponibles;
    $libro->save();

    return redirect()->route('rentas.create')->with('success', 'Renta registrada con éxito.');
}


}
