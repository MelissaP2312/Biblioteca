<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LibroController extends Controller
{
    // Método para mostrar el formulario de creación de libros (vista de registro)
    public function create()
    {
        return view('RegistroLibros'); // Vista con el formulario
    }

    // Método para almacenar un libro en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos recibidos desde el formulario
        $request->validate([
            'nombre' => 'required|string|min:2|max:225',
            'autor' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validación de imagen
            'genero' => 'required|string|max:255',
            'descripcion' => 'nullable|string|min:50|max:500',
            'isbn' => [
                'required',
                'string',
                'min:13', // Validación de longitud mínima
                Rule::unique('libros')->where(function ($query) {
                    return $query->where('isbn', request('isbn'));
                }),
            ],
            'unidades' => 'required|integer|min:1|max:100',
        ]);

        // Subir la imagen si se proporcionó
        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageBinary = file_get_contents($image); // Convertir la imagen a binario
        } else {
            $imageBinary = null; // Si no hay imagen, no almacenamos nada en la columna 'imagen'
        }

        // Crear el libro
        $libro = Libro::create([
            'nombre' => $request->input('nombre'),
            'autor' => $request->input('autor'),
            'genero' => $request->input('genero'),
            'descripcion' => $request->input('descripcion'),  // Guardar la descripción
            'isbn' => $request->input('isbn'),
            'unidades' => $request->input('unidades'),
            'imagen' => $imageBinary, // Guardar la imagen en formato binario
        ]);

        // Redirigir al formulario de registro de libros con un mensaje de éxito
        return redirect()->route('libros.registro')->with('success', 'Libro registrado con ¡ÉXITO!');
    }

    public function checkIsbn(Request $request)
    {
        $isbn = $request->input('isbn');
        $exists = Libro::where('isbn', $isbn)->exists();  
        // Verifica si el ISBN ya existe
    
        return response()->json(['exists' => $exists]);
    }

    // Método para mostrar la lista de libros (vista index)
    public function index(Request $request)
    {
     // Crear la consulta base
     $query = Libro::query();

     // Filtrar por título (uso de LIKE para coincidencias parciales)
     if ($request->has('search') && $request->search != '') {
         $searchTerm = $request->search;
         $query->where('nombre', 'like', '%' . $searchTerm . '%');
     }
 
     // Filtrar por género (si hay filtro de género)
     if ($request->has('genero') && $request->genero != '') {
         $query->where('genero', $request->genero);
     }
 
     // Filtrar por autor (si hay filtro de autor)
     if ($request->has('autor') && $request->autor != '') {
         $query->where('autor', $request->autor);
     }
 
     // Obtener los libros filtrados
     $libros = $query->get();
 
     // Obtener todos los géneros y autores disponibles para los filtros
     $generos = Libro::select('genero')->distinct()->get();
     $autores = Libro::select('autor')->distinct()->get();
 
     // Pasar los datos a la vista
     return view('index', compact('libros', 'generos', 'autores'));
    }
}
