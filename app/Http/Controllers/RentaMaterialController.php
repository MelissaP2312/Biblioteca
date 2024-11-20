<?php

namespace App\Http\Controllers;

use App\Models\RentaMaterial;
use App\Models\Material;
use App\Models\User;
use Illuminate\Http\Request;

class RentaMaterialController extends Controller
{
    // Mostrar el formulario de renta de materiales
    public function create()
    {
        // Obtener todos los materiales y usuarios
        $materiales = Material::all(); // Asegúrate de que exista el modelo Material
        $usuarios = User::all(); // Obtener todos los usuarios
        return view('RentasMateriales', compact('materiales', 'usuarios'));
    }

    // Guardar una nueva renta de material
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

    // Listar todas las rentas de materiales
    public function index()
    {
        // Obtener todas las rentas de materiales
        $rentas = RentaMaterial::all();
        return view('rentasMaterial', compact('rentas'));
    }

    // Mostrar el formulario para devolver materiales
    public function createDevolucion()
{
    // Obtener todas las rentas activas que no han sido devueltas
    $rentas = RentaMaterial::whereNull('fecha_devolucion')->get(); // Filtra las rentas que no tienen fecha de devolución

    return view('devolucionMaterial', compact('rentas')); // Pasar la variable $rentas a la vista
}


    // Procesar la devolución de un material
    public function storeDevolucion(Request $request)
    {
        // Validar la devolución
        $request->validate([
            'renta_id' => 'required|exists:rentas_material,id', // Verificar que la renta existe
            'fecha_devolucion' => 'required|date', // Validar que la fecha de devolución sea una fecha válida
        ]);

        // Obtener la renta seleccionada
        $renta = RentaMaterial::find($request->renta_id);

        // Marcar la renta como devuelta
        $renta->fecha_devolucion = $request->fecha_devolucion;
        $renta->save();

        // Recuperar las unidades devueltas en el material
        $material = Material::where('tipo', $renta->nombre_material)->first();
        $material->unidades += $renta->unidades_disponibles;
        $material->save();

        return redirect()->route('rentas_materiales.devolucion.create')->with('success', 'Devolución registrada con éxito.');
    }

    // Listar todas las devoluciones de materiales
    public function indexDevoluciones()
    {
        // Obtener todas las rentas que tienen fecha de devolución
        $devoluciones = RentaMaterial::whereNotNull('fecha_devolucion')->get();
        return view('listaDevolucionesMaterial', compact('devoluciones')); // Enviar las devoluciones a la vista
    }
}
