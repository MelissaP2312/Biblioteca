<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroVistaController extends Controller
{
    // Método para mostrar la vista principal con los libros
    public function index(Request $request)
{
    // Obtener los géneros disponibles para el filtro
    $generos = Libro::select('genero')->distinct()->get();

    // Filtrar los libros por género si se proporciona uno
    $filtroGenero = $request->input('genero');
    $libros = Libro::when($filtroGenero, function ($query, $genero) {
        return $query->where('genero', $genero);
    })->get();

    // Obtener los libros destacados
    $librosDestacados = Libro::with('calificaciones')
        ->get()
        ->sortByDesc(fn($libro) => $libro->promedioRanking())
        ->take(10);

    return view('main', compact('libros', 'librosDestacados', 'generos'));
}




    // Método para obtener la imagen de un libro
    public function getImagen($id)
    {
        $libro = Libro::find($id);

        if ($libro && $libro->imagen) {
            // Detectar el tipo MIME de la imagen
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_buffer($finfo, $libro->imagen);
            finfo_close($finfo);

            return response($libro->imagen)
                ->header('Content-Type', $mimeType);
        } else {
            // Retornar una imagen predeterminada si no hay imagen asociada
            return response()->file(public_path('images/default-book-image.jpg'));
        }
    }

        public function show($id)
    {
        // Busca el libro por ID
        $libro = Libro::find($id);

        // Si no se encuentra el libro, lanza un error 404
        if (!$libro) {
            abort(404, 'Libro no encontrado');
        }

        // Retorna la vista con los datos del libro
        return view('librosShow', compact('libro'));
    }

    public function updateRanking(Request $request, $id)
    {
        // Validar que el ranking sea un número entre 1 y 5
        $request->validate([
            'ranking' => 'required|integer|min:1|max:5',
        ]);

        // Buscar el libro por ID
        $libro = Libro::find($id);

        if (!$libro) {
            return redirect()->back()->with('error', 'Libro no encontrado.');
        }

        // Actualizar el ranking
        $libro->ranking = $request->ranking;
        $libro->save();

        return redirect()->back()->with('success', 'Ranking actualizado correctamente.');
    }

    public function addCalificacion(Request $request, $id)
    {
        $request->validate([
            'puntuacion' => 'required|integer|min:1|max:5',
        ]);

        $libro = Libro::find($id);

        if (!$libro) {
            return redirect()->back()->with('error', 'Libro no encontrado.');
        }

        // Guardar la calificación
        $libro->calificaciones()->create([
            'puntuacion' => $request->puntuacion,
        ]);

        // Calcular el promedio de las calificaciones
        $promedio = $libro->calificaciones()->avg('puntuacion');

        // Actualizar el ranking en la tabla libros
        $libro->ranking = $promedio;
        $libro->save();

        return redirect()->back()->with('success', 'Calificación guardada y ranking actualizado correctamente.');
    }


}
