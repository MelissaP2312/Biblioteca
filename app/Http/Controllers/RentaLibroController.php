<?php

namespace App\Http\Controllers;

use App\Models\RentaLibro;
use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\User;

class RentaLibroController extends Controller
{
    // Mostrar formulario para registrar una nueva renta
    public function create()
    {
        $libros = Libro::all();  // Obtener todos los libros
        $usuarios = User::all(); // Obtener todos los usuarios
        return view('RentaLibro', compact('libros', 'usuarios'));
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
            return redirect()->route('rentas_libros.create')->with('error', 'No hay suficientes unidades disponibles para este libro.');
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

        return redirect()->route('rentas_libros.create')->with('success', 'Renta registrada con éxito.');
    }

    // Mostrar listado de todas las rentas
    public function index()
    {
        $rentas = RentaLibro::all();
        return view('rentasLibros', compact('rentas'));
    }

    // Mostrar formulario para registrar una devolución
    public function createDevolucion()
    {
        $rentas = RentaLibro::whereNull('fecha_devolucion')->get(); // Solo rentas no devueltas
        return view('devoluciones', compact('rentas'));
    }

    // Registrar una devolución
    public function storeDevolucion(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'renta_id' => 'required|exists:rentas_libros,id',
            'fecha_devolucion' => 'required|date',
        ]);

        // Buscar la renta
        $renta = RentaLibro::findOrFail($request->renta_id);

        // Actualizar la fecha de devolución
        $renta->fecha_devolucion = $request->fecha_devolucion;
        $renta->save();

        // Restaurar las unidades disponibles del libro
        $libro = Libro::where('nombre', $renta->nombre_libro)->first();
        $libro->unidades += $renta->unidades_disponibles;
        $libro->save();

        return redirect()->route('rentas_libros.devolucion.create')->with('success', 'Devolución registrada con éxito.');
    }

    // Mostrar listado de rentas devueltas
    public function indexDevoluciones()
    {
        $devoluciones = RentaLibro::whereNotNull('fecha_devolucion')->get(); // Rentas devueltas
        return view('listaDevoluciones', compact('devoluciones'));
    }
}
