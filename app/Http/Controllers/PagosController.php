<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class PagosController extends Controller

{

    public function  BuscarPaso(Request $request)
    {
        $data = [
            'id' => $request->id,
            "Paso" => $request->Paso
            ];

        $backendApi = config('app.backend_api');
        $token = Session::get('token');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post($backendApi."/api/BuscarI", $data);

        $Imagen = json_decode($response->body());

        if(!empty($Imagen->id)){
        $Imagen->extension = pathinfo($Imagen->Ruta, PATHINFO_EXTENSION);
        $Imagen->url = route('ver_archivo', ['path' => base64_encode($Imagen->Ruta)]);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Empleado");

        $Empleados = json_decode($response->body());

        $Imagen->Paso = $request->Paso;

        $Imagen->idServicio = $request->id;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Servicio/".$Imagen->idServicio);

        $Servicio = json_decode($response->body());

        return view('Pasos/VerPaso', compact('Imagen', "Empleados","Servicio"));
    }

    public function index()
    {
    $token = Session::get('token');
    if (!$token) {
       // Manejar el caso donde no hay token disponible en la sesión
       return response()->json(['error' => 'Token no disponible'], 401);
    }

   $backendApi = config('app.backend_api');

   // Realizar la solicitud HTTP con el token en el encabezado
   $response = Http::withHeaders([
       'Authorization' => 'Bearer ' . $token,
   ])->get($backendApi."/api/Pago");

   // Decodificar la respuesta JSON
   $Pagos = json_decode($response->body());

   $perPage = 10; // Cantidad de elementos por página
   $currentPage = request()->get('page', 1); // Obtener el número de página actual desde la URL
   $offset = ($currentPage - 1) * $perPage;
   $items = array_slice($Pagos, $offset, $perPage);
   $ServiciosPaginados = new LengthAwarePaginator($items, count($Pagos), $perPage, $currentPage);

   return view('Pedidos/PagosPendientes', compact('ServiciosPaginados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
    //dd($id);
    }

    public function update(Request $request, $id)
    {
        $token = Session::get('token');
        if (!$token) {
            return response()->json(['error' => 'Token no disponible'], 401);
        }

              $data = [
                'Pago' => $request->Pago,
                "Pagado" => "0"
            ];
    
            $backendApi = config('app.backend_api');

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->put($backendApi."/api/Pago/".$id, $data);

            if(!empty($request->I)){
                return $this->BuscarPaso($request);
                }
    
            return redirect("/Pedidos/Activos/".$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //dd($id);
    }

    
}
