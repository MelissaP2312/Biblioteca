<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RentaLibro;
use App\Models\RentaMaterial;
use App\Models\RentaAula;

class MembresiaController extends Controller{
    public function index()
    {
        $user = Auth::user(); // Obtener el usuario autenticado

        // Obtener las rentas asociadas al usuario
        $rentasLibros = RentaLibro::where('usuario_id', $user->id)->with('libro')->get();
        $rentasMateriales = RentaMaterial::where('usuario_id', $user->id)->get();
        $rentasAulas = RentaAula::where('usuario_id', $user->id)->get();

        return view('membresia', compact('user', 'rentasLibros', 'rentasMateriales', 'rentasAulas'));
    }
}