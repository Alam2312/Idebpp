<?php

namespace App\Http\Controllers;

use App\models\Imagene;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class DocumentoController extends Controller
{
    public function index()
    {

    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        $token = Session::get('token');
        // Verificar si el token existe
        if (!$token) {
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $backendApi = config('app.backend_api');

        dd($request);

        $response = Http::attach(
            'Imagen',file_get_contents($request->file('Imagen')),$request->file('Imagen')->getClientOriginalName())->
            withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post($backendApi."/api/Documento",[

                "idCliente" =>$request->Nombres,
                "Lugar" =>$request->Apellidos,
                "Ruta" => $request->Puesto,
         ]);

    
        return redirect("Documento".$request->id);
        
    }
    


    public function show($id)
    {
        $token = Session::get('token');
        // Verificar si el token existe
        if (!$token) {
            // Manejar el caso donde no hay token disponible en la sesión
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $backendApi = config('app.backend_api');

        //dd($id);
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Documento/".$id);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Cliente/".$id);
    
        $Documentos = json_decode($response->body());

        $Cliente = json_decode($response->body());

        //dd($Cliente);

        return view('Clientes/DocumentosCliente', compact('Documentos', 'Cliente'));
    }

  
    public function update(Request $request, $id)
    {

    }
   
    public function destroy($id)
    {
        $token = Session::get('token');
        // Verificar si el token existe
        if (!$token) {
            return response()->json(['error' => 'Token no disponible'], 401);
        }
    
        $backendApi = config('app.backend_api');

        // Petición para traer datos del servicio
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Servicio/".$request->id);
    
        $Servicio = json_decode($response->body());

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put($backendApi."/api/Servicio/".$id, $Servicio);

        $Servicio->Pago= "Rechazado";
    
    }
}
