<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado según la respuesta de la API
        $autentificacion = session()->get('autenticado');

        if ($autentificacion == true) {
            return $next($request); // Permitir el acceso a la ruta o acción del controlador
        } else {
            session(['urlAnterior' => $request->path()]);
            return redirect('/'); // Redirigir al usuario al inicio de sesión si no está autenticado
        }
    }
}