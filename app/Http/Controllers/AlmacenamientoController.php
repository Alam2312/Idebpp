<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Cliente;
use App\models\Empleado;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config; 

class AlmacenamientoController extends Controller

{
    public function index()
    {
        // Obtener el token desde la sesión
        $token = Session::get('token');

        if (!$token) {
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $idUsuario = Session::get('user_id');
        $alm = Session::get('Almacenamiento');
        
        $backendApi = config('app.backend_api');

        // Realizar la solicitud HTTP con el token en el encabezado
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Almacenamiento/".$idUsuario);

        // Decodificar la respuesta JSON
        $rutas= json_decode($response->body());

        return view('Almacenamiento/Almacenamiento', ['Rutas' => $rutas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Almacenamiento/NuevaRuta');
    }

    public function Elegir()
    {
         // Obtener el token desde la sesión
         $token = Session::get('token');

         // Verificar si el token existe
         if (!$token) {
             // Manejar el caso donde no hay token disponible en la sesión
             return response()->json(['error' => 'Token no disponible'], 401);
         }
 
         //dd(Session::get('user_id'));
 
         $idUsuario = Session::get('user_id');
         $alm = Session::get('Almacenamiento');
 
         // dd($alm);

        $backendApi = config('app.backend_api');
 
         // Realizar la solicitud HTTP con el token en el encabezado
         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $token,
         ])->get($backendApi."/api/Almacenamiento/".$idUsuario);
 
         // Decodificar la respuesta JSON
         $rutas= json_decode($response->body());
 
         //dd($rutas);
        //  return view('Almacenamiento/Almacenamiento', ['Rutas' => $rutas]);
        return view('Almacenamiento/CambiarRuta', ['Rutas' => $rutas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = Session::get('token');
        if (!$token) {
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $idUsuario = Session::get('user_id');
        $Raiz = "C:/";

        if (strpos($request->Ruta, ":\\") === false) {
            return redirect('/Almacenamiento/create')->with('mensaje', 'Ruta inválida: La ruta debe contener la raiz');
        }

        //  dd($Raiz);

        $data = [
            'Ruta' => $request->Ruta,
            'idEmpleado' => $idUsuario,
        ];
        $backendApi = config('app.backend_api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post($backendApi."/api/Almacenamiento", $data);

        $Almacenamiento = json_decode($response->body());

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get( $backendApi."/api/Empleado/".$idUsuario );

        $Empleado= json_decode($response->body());

        $Empleado->Almacenamiento = $Almacenamiento->id;

        session(['Almacenamiento' => $Almacenamiento->id]);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put( $backendApi."/api/Empleado/" . $idUsuario, $Empleado);


         //guardar la ruta en el disk
         $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Ruta/".$Almacenamiento->id);

        $Ruta = json_decode($response->body());

        Config::set('filesystems.disks.documents.root',$Ruta->Ruta);

        return redirect("/Almacenamiento");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $token = Session::get('token');

        // Verificar si el token existe
        if (!$token) {
            // Manejar el caso donde no hay token disponible en la sesión
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $backendApi = config('app.backend_api');
    
        // Realizar la solicitud HTTP con el token en el encabezado
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Cliente/". $id);
    
        $Cliente = json_decode($response->body());
    
        //dd($Cliente);
    
        return view('Clientes/EliminarCliente', ['Cliente' => $Cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }


    public function Actualizar(Request $request)
    {

    $token = Session::get('token');
   
    if (!$token) {
     return response()->json(['error' => 'Token no disponible'], 401);
    }

    $idUsuario = Session::get('user_id');
    $backendApi = config('app.backend_api');

     $response = Http::withHeaders([
     'Authorization' => 'Bearer ' . $token,
     ])->get($backendApi."/api/Empleado/".$idUsuario );

     $Empleado= json_decode($response->body());

     $Empleado->Almacenamiento = $request->Ruta;

     session(['Almacenamiento' => $request->Ruta]);

     $response = Http::withHeaders([
     'Authorization' => 'Bearer ' . $token,
     ])->put($backendApi."/api/Empleado/" . $idUsuario, $Empleado);

    return redirect("/Almacenamiento");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $token = Session::get('token');
        $idUsuario = Session::get('user_id');

        // Verificar si el token existe
        if (!$token) {
            // Manejar el caso donde no hay token disponible en la sesión
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $backendApi = config('app.backend_api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete($backendApi."/api/Almacenamiento/".$id);

        session(["Almacenamiento" => "0"]);

        return redirect("/Elegir");
    }

    
}
