<?php

namespace App\Http\Controllers;

use App\Models\Comentario; // Asumimos que tienes un modelo de Comentario
use App\Models\Foro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    // Crear un comentario en un foro
    public function store(Request $request, $foroId)
    {
        $user = Auth::user();

        $request->validate([
            'contenido' => 'required|string',
        ]);

        // Crear un nuevo comentario
        Comentario::create([
            'contenido' => $request->contenido,
            'foro_id' => $foroId,
            'usuario_id' => $user->id,
        ]);

        return redirect()->route('admin.foros.show', $foroId)->with('success', 'Comentario agregado correctamente');
    }
}
