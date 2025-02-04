<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evento;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http; // Importa la clase Http
use App\Http\Controllers\RedirectResponse;
use Illuminate\Support\Facades\Config; 

class IniSesController extends Controller
{
    /**
     * Display the registration view.
     */

    
    public function create(Request $request)
    { 

        session()->flush();
        session(['autenticado' => false]);   
        $backendApi = config('app.backend_api');

             $response = Http::post($backendApi."/api/Login", [
                'Correo' => $request->email,
                'Contraseña' => $request->password,
            ]);

            $Ruta = json_decode($response->body());
            $datos = $response->json();

            if ($response->successful()) {
                $request->session()->put('autenticado', true);

                session([
                    'user_id' => $datos["empleado"]['id'],
                    'Almacenamiento' => $datos["empleado"]['Almacenamiento'],
                    'user_name' => $datos["empleado"]['Nombres'],
                    'Rol' => $datos["empleado"]['Rol'],
                    'token' => $datos["token"]
                ]);

                $token = Session::get('token');

                if (!$token) {
                    return response()->json(['error' => 'Token no disponible'], 401);
                }
           
                // Realizar la solicitud HTTP con el token en el encabezado
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                ])->get($backendApi."/api/Servicio");

                $Servicios = json_decode($response->body());

                $Hoy = Carbon::now()->startOfDay();

                $HoyFormateado = $Hoy->toDateTimeString();

                if(!empty($Servicios)){

                foreach ($Servicios as $Servicio) {

                    if($Servicio->Fecha != "vacio"){
                    $fechaServicio = Carbon::parse($Servicio->Fecha); // Parsea la fecha almacenada a un objeto Carbon
                
                    if ($fechaServicio->lt($Hoy)) {
        
                        $Servicio->Estatus = "SinPago";
                        
                        $response = Http::withHeaders([
                            'Authorization' => 'Bearer ' . $token,
                        ])->put($backendApi."/api/Servicio/".$Servicio->id, $Servicio); 
        
                    } 
                    }}}

                return redirect("/Inicio");

            } else {
                return redirect("/")->withErrors(['api_error' => 'Error al iniciar sesión. Detalles: ' . $datos['Error']]);
            }
    }

    public function salir()
    {
        session()->flush();
        session(['autenticado' => false]);   

        return redirect()->route('Loguearse');
    }
}

