<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\RentaAula;
use Illuminate\Http\Request;
use App\Models\User;

class RentaAulaController extends Controller
{
    public function create()
    {
        $aulas = Aula::all(); 
        $usuarios = User::all(); // Asumiendo que tienes un modelo User
        return view('RentasAulas', compact('aulas', 'usuarios'));
    }

    // Guardar una nueva renta
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre_aula' => 'required|exists:aulas,nombre_aula',
            'usuario_id' => 'required|exists:users,id',
            'fecha_prestamo' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
        ]);

        // Validar que el horario no esté ocupado
        $existeTraslape = RentaAula::where('nombre_aula', $request->nombre_aula)
        ->where('fecha_prestamo', $request->fecha_prestamo)
        ->where(function ($query) use ($request) {
            $query->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fin])
                ->orWhereBetween('hora_fin', [$request->hora_inicio, $request->hora_fin]);
        })
        ->exists();

        if ($existeTraslape) {
            return redirect()->route('rentas_aulas.create')->with('error', 'El aula ya está ocupada en ese horario.');
        }

        // Buscar el aula por su nombre
        $aula = Aula::where('nombre_aula', $request->nombre_aula)->first();

        // Crear un nuevo registro en la base de datos para la renta
        RentaAula::create([
            'usuario_id' => $request->usuario_id,
            'nombre_aula' => $aula->nombre_aula,
            'fecha_prestamo' => $request->fecha_prestamo,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
        ]);

        // Cambiar la disponibilidad del aula a 0 (no disponible)
        $aula->disponible = 0;
        $aula->save();

        return redirect()->route('rentas_aulas.create')->with('success', 'Renta registrada con éxito.');
    }

    public function verificarDisponibilidad(Request $request)
    {
        $nombreAula = $request->nombre_aula;
        $fecha = $request->fecha_prestamo;
        $horaInicio = $request->hora_inicio;
        $horaFin = $request->hora_fin;

        $ocupado = RentaAula::where('nombre_aula', $nombreAula)
            ->where('fecha_prestamo', $fecha)
            ->where(function ($query) use ($horaInicio, $horaFin) {
                $query->whereBetween('hora_inicio', [$horaInicio, $horaFin])
                    ->orWhereBetween('hora_fin', [$horaInicio, $horaFin])
                    ->orWhere(function ($q) use ($horaInicio, $horaFin) {
                        $q->where('hora_inicio', '<=', $horaInicio)
                            ->where('hora_fin', '>=', $horaFin);
                    });
            })
            ->exists();

    }


}
