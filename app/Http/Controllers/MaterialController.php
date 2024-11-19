<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    //
    public function store(Request $request)
{
    // Validar los datos
    $request->validate([
        'tipo' => 'required|string',
        'unidades' => 'required|integer|min:1',
    ]);

    try {
        // Buscar el material por tipo
        $material = Material::where('tipo', $request->tipo)->first();

        if ($material) {
            // Si existe, sumar las unidades
            $material->unidades += $request->unidades;
            $material->save();
        } else {
            // Si no existe, crear un nuevo registro
            Material::create([
                'tipo' => $request->tipo,
                'unidades' => $request->unidades,
            ]);
        }

        return redirect()->back()->with('success', 'Material registrado o actualizado con éxito.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al guardar el material: ' . $e->getMessage());
    }
}


}
