<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tema;


class TemaController extends Controller
{
    /**
     * Mostrar el formulario para crear un nuevo tema.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('tema'); // La vista 'tema.blade.php' está en resources/views
    }

    /**
     * Almacenar un nuevo tema en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        // Crear el nuevo tema
        Tema::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('temas.create')->with('success', '¡Tema creado con éxito!');
    }

    /**
     * Mostrar los temas existentes.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $temas = Tema::all(); // Obtén todos los temas desde la base de datos
        return view('tema.index', compact('temas')); // La vista 'tema.index' debe existir en resources/views
    }

    /**
     * Mostrar el formulario para editar un tema existente.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $tema = Tema::findOrFail($id);
        return view('tema.edit', compact('tema'));
    }

    /**
     * Actualizar un tema existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        // Encontrar el tema por ID y actualizar
        $tema = Tema::findOrFail($id);
        $tema->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('temas.index')->with('success', '¡Tema actualizado con éxito!');
    }

    /**
     * Eliminar un tema de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $tema = Tema::findOrFail($id);
        $tema->delete();

        return redirect()->route('temas.index')->with('success', '¡Tema eliminado con éxito!');
    }
}
