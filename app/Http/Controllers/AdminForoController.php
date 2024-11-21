<?php

namespace App\Http\Controllers;

use App\Models\Foro;
use Illuminate\Http\Request;

class AdminForoController extends Controller
{
    // Mostrar la lista de foros
    public function index()
    {
        // Usar paginación en lugar de all()
        $foros = Foro::paginate(10); // Obtener los foros paginados, 10 por página

        // Pasar los foros paginados a la vista
        return view('foroShow', compact('foros')); 
    }

    // Mostrar el formulario para crear un nuevo foro
    public function create()
    {
        return view('create');
    }

    // Guardar el nuevo foro
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
        ]);

        // Crear el foro
        Foro::create($validated);

        // Redirigir al índice de foros con un mensaje de éxito
        return redirect()->route('foroShow')->with('success', 'Foro creado exitosamente');
    }

    // Mostrar los detalles de un foro específico
    public function show($id)
    {
        $foro = Foro::findOrFail($id); // Buscar el foro por su ID
        return view('show', compact('foro')); // Pasar los detalles a la vista
    }

    // Mostrar el formulario para editar un foro específico
    public function edit($id)
    {
        $foro = Foro::findOrFail($id); // Buscar el foro por su ID
        return view('edit', compact('foro')); // Pasar los detalles a la vista de edición
    }

    // Actualizar un foro específico
    public function update(Request $request, $id)
    {
        $foro = Foro::findOrFail($id); // Buscar el foro por su ID

        // Validar los datos del formulario
        $validated = $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
        ]);

        // Actualizar los datos del foro
        $foro->update($validated);

        // Redirigir al índice de foros con un mensaje de éxito
        return redirect()->route('foroShow')->with('success', 'Foro actualizado exitosamente');
    }

    // Eliminar un foro específico
    public function destroy($id)
    {
        $foro = Foro::findOrFail($id); // Buscar el foro por su ID
        $foro->delete(); // Eliminar el foro

        // Redirigir al índice de foros con un mensaje de éxito
        return redirect()->route('foroShow')->with('success', 'Foro eliminado exitosamente');
    }
}
