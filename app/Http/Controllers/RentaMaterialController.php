<?php

namespace App\Http\Controllers;

use App\Models\RentaMaterial;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\User;

class RentaMaterialController extends Controller
{
    // Mostrar el formulario de renta
    public function create()
    {
        // Obtener todos los materiales y usuarios
        $materiales = Material::all(); // Asegúrate de que exista el modelo Material
        $usuarios = User::all(); // Obtener todos los usuarios
        return view('RentasMateriales', compact('materiales', 'usuarios'));
    }

    // Guardar una nueva renta
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre_material' => 'required|exists:materials,tipo', // Validar que el material exista en la columna tipo
            'usuario_id' => 'required|exists:users,id', // Validar que el usuario exista
            'fecha_prestamo' => 'required|date',
            'unidades_disponibles' => 'required|integer|min:1',
        ]);

        // Buscar el material por su tipo
        $material = Material::where('tipo', $request->nombre_material)->first();

        // Verificar si hay suficientes unidades disponibles
        if ($material->unidades < $request->unidades_disponibles) {
            return redirect()->route('rentas_materiales.create')->with('error', 'No hay suficientes unidades disponibles para este material.');
        }

        // Crear un nuevo registro en la base de datos para la renta
        RentaMaterial::create([
            'usuario_id' => $request->usuario_id,
            'nombre_material' => $material->tipo, // Guardar el tipo del material
            'fecha_prestamo' => $request->fecha_prestamo,
            'unidades_disponibles' => $request->unidades_disponibles,
        ]);

        // Disminuir la cantidad de unidades disponibles en el material
        $material->unidades -= $request->unidades_disponibles;
        $material->save();

        return redirect()->route('rentas_materiales.create')->with('success', 'Renta registrada con éxito.');
    }
}
