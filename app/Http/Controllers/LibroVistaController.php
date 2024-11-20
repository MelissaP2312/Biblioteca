<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroVistaController extends Controller
{
    // Método para mostrar la vista principal con los libros
    public function index()
    {
        // Obtener todos los libros de la base de datos
        $libros = Libro::all();

        // Retornar la vista principal con los libros
        return view('main', compact('libros'));
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


}
