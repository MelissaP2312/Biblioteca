<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;  // Asegúrate de importar Log

class VerificarAdministrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado y es un administrador
        if (Auth::check() && Auth::user()->rol == 'admin') {
            return $next($request); // Permitir acceso si es admin
        }

        // Registrar el mensaje en los logs si no es administrador
        Log::info('Acceso denegado: El usuario no es administrador.');

        // Redirigir al login si no es administrador
        return redirect()->route('login');
    }
}
