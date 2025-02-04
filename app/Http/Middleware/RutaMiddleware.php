<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config; 
use Illuminate\Support\Facades\Session;

class RutaMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado según la respuesta de la API
        $Almacenamiento = session()->get('Almacenamiento');
        $idUsuario = Session::get('user_id');

        // Obtener el token desde la sesión
        $token = Session::get('token');

        $backendApi = config('app.backend_api');

         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $token,
         ])->get($backendApi."/api/Almacenamiento/".$idUsuario);

         $Rutas = json_decode($response->body());

         //dd(empty($Rutas));

         if($Almacenamiento == 0 && !empty($Rutas)){
            return redirect('/Elegir');
         }

          if(empty($Rutas)){

              $response = Http::withHeaders([
                  'Authorization' => 'Bearer ' . $token,
              ])->get($backendApi."/api/Empleado/".$idUsuario);

              $Empleado = json_decode($response->body());

              $Empleado->Almacenamiento = 0;

              $response = Http::withHeaders([
                  'Authorization' => 'Bearer ' . $token,
              ])->put($backendApi."/api/Empleado/".$idUsuario,  $Empleado);

              return redirect('/Almacenamiento/create');
         }      

         $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Ruta/".$Almacenamiento);

        $Ruta = json_decode($response->body());

    if(!empty($Ruta->Ruta) || !$Ruta === NULL){

    if (!file_exists($Ruta->Ruta)) {
        return redirect('/Almacenamiento')->with('error', 'Ruta no existe');
    }

    if (!is_writable($Ruta->Ruta)) {
        return redirect('/Almacenamiento')->with('error', 'No tienes permisos para usar esta carpeta');
    }}

    try {
    $testFile = $Ruta->Ruta . '\\test.txt';
    }catch (\Exception $e) {
        return redirect('/Almacenamiento')->with('error', 'Elige o');
    }

    
    try {
        // Intenta escribir en el archivo
        if (file_put_contents($testFile, 'Prueba de escritura') === false) {
            // Si falla al escribir, lanzamos una excepción
            throw new \Exception('No se puede escribir en la ruta: ' . $Ruta);
        } else {
            // Archivo creado con éxito
            unlink($testFile); // Elimina el archivo de prueba
        }
    } catch (\Exception $e) {
        // Captura la excepción y redirige con un mensaje de error
        return redirect('/Almacenamiento')->with('error', 'Verifica los permisos de tus carpetas o');
    }

        if ($Almacenamiento != 0) {
            //dd($Almacenamiento);
            return $next($request); // Permitir el acceso a la ruta o acción del controlador
         } else {
            return redirect('/Elegir'); // Redirigir al usuario al inicio de sesión si no está autenticado
         }
    }
}