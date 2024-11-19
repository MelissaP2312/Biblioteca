<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\RentaAula;
use Illuminate\Http\Request;
use App\Models\User;

class RentaAulaController extends Controller
{
    public function create()
    {
        $aulas = Aula::all();  // Asumiendo que tienes un modelo Libro
        $usuarios = User::all(); // Asumiendo que tienes un modelo User
        return view('RentasAulas', compact('aulas', 'usuarios'));
    }

    // Guardar una nueva renta
    public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'nombre_aula' => 'required|exists:aulas,nombre', // Validar que el libro exista
        'usuario_id' => 'required|exists:users,id', // Validar que el usuario exista
        'fecha_prestamo' => 'required|date',
    ]);

    // Buscar el libro por su nombre
    $aula = Aula::where('nombre', $request->nombre_aula)->first();

    // Verificar si hay suficientes unidades disponibles
    if ($aula->unidades < $request->unidades_disponibles) {
        return redirect()->route('rentas_aulas.create')->with('error', 'No hay suficientes unidades disponibles para este libro.');
    }

    // Crear un nuevo registro en la base de datos para la renta
    RentaAula::create([
        'usuario_id' => $request->usuario_id,
        'nombre_aula' => $aula->nombre,
        'fecha_prestamo' => $request->fecha_prestamo,
        'unidades_disponibles' => $request->unidades_disponibles,
    ]);

    // Disminuir la cantidad de unidades disponibles en el libro
    $aula->unidades -= $request->unidades_disponibles;
    $aula->save();

    return redirect()->route('rentas_libros.create')->with('success', 'Renta registrada con éxito.');
}

}
