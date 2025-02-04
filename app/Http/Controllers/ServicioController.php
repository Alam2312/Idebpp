<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Servicio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class ServicioController extends Controller
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

        //dd(!empty($Imagen->Validacion));

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

    public function NuevoServicio(){
        $token = Session::get('token');
        // Verificar si el token existe
        if (!$token) {
            // Manejar el caso donde no hay token disponible en la sesión
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $backendApi = config('app.backend_api');
 
        // Realizar la solicitud HTTP con el token en el encabezado
        $responseC = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Cliente");

        $responseE = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Empleado");
 
        // Decodificar la respuesta JSON
        $Empleados = json_decode($responseE->body());
        $Clientes = json_decode($responseC->body());

        return view("Pedidos/PedidoNuevo", compact('Empleados', 'Clientes'));
    }

    public function BuscarInactivos(){
       $token = Session::get('token');

       if (!$token) {
           return response()->json(['error' => 'Token no disponible'], 401);
       }
       $backendApi = config('app.backend_api');

       $response = Http::withHeaders([
           'Authorization' => 'Bearer ' . $token,
       ])->get($backendApi."/api/Inactivo");

       $Servicios = json_decode($response->body());

        // Paginar los resultados
        $perPage = 10; 
        // Cantidad de elementos por página
        $currentPage = request()->get('page', 1); // Obtener el número de página actual desde la URL
        $offset = ($currentPage - 1) * $perPage;
        $items = array_slice($Servicios, $offset, $perPage);
        $ServiciosPaginados = new LengthAwarePaginator($items, count($Servicios), $perPage, $currentPage);

        return view('Pedidos/PedidosInactivos', compact('ServiciosPaginados'));
    }


    public function BuscarRechazados(){
     $token = Session::get('token');

     if (!$token) {
         // Manejar el caso donde no hay token disponible en la sesión
         return response()->json(['error' => 'Token no disponible'], 401);
     }

     $backendApi = config('app.backend_api');

     $response = Http::withHeaders([
         'Authorization' => 'Bearer ' . $token,
     ])->get($backendApi."/api/Rechazado");

     $Servicios = json_decode($response->body());

     // Paginar los resultados
     $perPage = 10; // Cantidad de elementos por página
     $currentPage = request()->get('page', 1); // Obtener el número de página actual desde la URL
     $offset = ($currentPage - 1) * $perPage;
     $items = array_slice($Servicios, $offset, $perPage);
     $ServiciosPaginados = new LengthAwarePaginator($items, count($Servicios), $perPage, $currentPage);

     return view('Pedidos/PedidosRechazados', compact('ServiciosPaginados'));
  }

  public function index()
  {

      $pasos = [
          0 => '1: Imagen del grupo de WhatsApp',
          1 => '2: Captura al Incluir a los participantes',
          2 => '3: Archivo de RFQ',
          3 => '4: Cotización',
          4 => '5: Captura del envío de la cotización',
          5 => '6: Captura de Aceptación de Cotización',
          6 => '7: Orden de Compra',
          7 => '8: ¿Cuánto pagará el cliente por el servicio?',
          8 => '9: ¿Cómo pagará el cliente?',
          9 => '10: Anticipo',
          10 => '11: Valida el progreso',
          11 => '12: Confirmacion del del envio de la factura por correo',
          12 => '13: Autorización de la factura',
          13 => '14: Reporte del servicio',
          14 => '15: Comprobante de pago final',
          15 => '16: Subir factura',
          16 => '17: Valida el progreso',
          17 => '18: Cerrar el proyecto',
          18 => '19: Respaldar grupo de whatsApp',
          19 => '20: Notificar que la informacion esta respaldada',
      ];
  
      // Obtener el token desde la sesión
      $token = Session::get('token');
  
      if (!$token) {
          // Manejar el caso donde no hay token disponible en la sesión
          return response()->json(['error' => 'Token no disponible'], 401);
      }
  
      $backendApi = config('app.backend_api');
  
      // Realizar la solicitud HTTP con el token en el encabezado
      $response = Http::withHeaders([
          'Authorization' => 'Bearer ' . $token,
      ])->get($backendApi."/api/Servicio");
  
      $Servicios = json_decode($response->body());
  
      // Recorrer los servicios obtenidos
      foreach ($Servicios as $servicio) {
          $nombrePasoEncontrado = '';
      // Variable para almacenar el nombre del paso encontrado
          foreach ($pasos as $numeroPaso => $nombrePaso) {
              // Comparar el número de paso del servicio con el número de paso del array
              if ($servicio->Paso == $numeroPaso) {
                  // Asignar el nombre del paso al servicio y salir del bucle
                  $nombrePasoEncontrado = $nombrePaso;
                  break;
              }}
          $servicio->nombrePaso = $nombrePasoEncontrado;
      }
       $perPage = 10; // Cantidad de elementos por página
       $currentPage = request()->get('page', 1); // Obtener el número de página actual desde la URL
       $offset = ($currentPage - 1) * $perPage;
       $items = array_slice($Servicios, $offset, $perPage);
       $ServiciosPaginados = new LengthAwarePaginator($items, count($Servicios), $perPage, $currentPage);

       return view('Pedidos/PedidosActivos', compact('ServiciosPaginados'));
  }
  

    public function create()
    {
        
    }


    public function store(Request $request)
    {
        
        $request->validate([
            'Proyecto' => 'required|max:255',
            'Servicio' => 'required|max:255',
            'idCliente' => 'required',
        ], [
            'Proyecto.required' => 'El campo Nombre es obligatorio.',
            'Proyecto.max' => 'El campo Nombre no debe exceder los 255 caracteres.',
            'Servicio.required' => 'El campo Correo es obligatorio.',
            'Servicio.max' => 'El campo Correo no debe exceder los 255 caracteres.',
            'idCliente.required' => 'El campo Tipo es obligatorio.'
        ]);

        $token = Session::get('token');

        // Verificar si el token existe
        if (!$token) {
            // Manejar el caso donde no hay token disponible en la sesión
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $data = [
            "Proyecto" =>$request->Proyecto,
            "Servicio" =>$request->Servicio,
            "Costo" =>"0",
            "Fecha" => "vacio",
            "Hora" => "vacio",
            "Estatus" => "Activo",
            "Paso" => "0",
            "Pago" => "vacio",
            "Pagado" => "0",
            "idCliente" => $request->idCliente,
            "idEmpleado" => "1",
          
        ];

        $backendApi = config('app.backend_api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Servicio", $data);

        $Servicios = json_decode($response->body());

        foreach($Servicios as $Ser){
            if($request->Proyecto == $Ser->Proyecto){
                return redirect()->back()->withErrors(['Proyecto' => 'El proyecto ya existe.'])->withInput();
            }
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post($backendApi."/api/Servicio", $data);

        $Servicio = json_decode($response->body());

        return redirect("/Pedidos/Activos/".$Servicio->id);

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


        $Alm = Session::get('Almacenamiento');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Ruta/".$Alm);

        $RutaTabla = json_decode($response->body());

        if(!empty($RutaTabla->Ruta)){
        $Ruta = $RutaTabla->Ruta;
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Servicio/".$id);  
        
        $Servicio = json_decode($response->body());

        if($Servicio->Pago == "Credito"){
           $Saltos = 3;
        }else{
           $Saltos = 2;
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Imagen/".$id);  
        $Imagenes = json_decode($response->body());

        foreach ($Imagenes as $imagen) {
            $imagen->Ruta = $Ruta . $imagen->Ruta;
            //dd($imagen);
        }
        foreach ($Imagenes as $imagen) {
            $imagen->extension = pathinfo($imagen->Ruta, PATHINFO_EXTENSION);
            $imagen->url = route('ver_archivo', ['path' => base64_encode($imagen->Ruta)]);
        }

        $Rol = Session::get('Rol');
        $Servicio->Paso++;
        session(['Paso' => $Servicio->Paso]);
        
        //dd($Servicio);
            return view("Pasos/PedidoPasos", compact('Servicio', 'id', "Imagenes", "Saltos", "Ruta"));
        }

    public function edit($id)
    {
        $token = Session::get('token');
        // Verificar si el token existe
        if (!$token) {
            // Manejar el caso donde no hay token disponible en la sesión
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $idEmpleado = Session::get('user_id');

        $backendApi = config('app.backend_api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Servicio/".$id);  

        $Servicio = json_decode($response->body());

        $data = [
            'idEliminacion' => $id,
            'Tabla' => "Empleado",
            "Confirmacion" => $idEmpleado,
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post($backendApi."/api/Eliminacion",$data);

        $Info = json_decode($response->body());

        //dd($Info);
        
        if(!empty($Info->error)){
        if($Info->error == "Registro no encontrado"){

            //dd("hola");
    
            $response = Http::withHeaders([
                 'Authorization' => 'Bearer ' . $token,
            ])->post($backendApi."/api/Eliminaciones",$data);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post($backendApi."/api/Eliminacion",$data);

            $Info = json_decode($response->body());

            //dd($Eliminacion);
        }}

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Empleado");

        $Empleados = json_decode($response->body());

        //dd($Empleados);

        foreach($Empleados as $Empleado){
            if($Empleado->id === $Info->Confirmacion1){
                $Info->Confirmacion1 = $Empleado->Nombres . " " . $Empleado->Apellidos;
            }

            if($Empleado->id === $Info->Confirmacion2){
                $Info->Confirmacion2 = $Empleado->Nombres . " " . $Empleado->Apellidos;
            }

            if($Empleado->id === $Info->Confirmacion3){
                $Info->Confirmacion3 = $Empleado->Nombres . " " . $Empleado->Apellidos;
            }
        }

        return view("Pedidos/EliminarPedido", compact('Servicio',"Info"));
    }

    public function update(Request $request, $id)
    {
     

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
        // Verificar si el token existe
        if (!$token) {
            // Manejar el caso donde no hay token disponible en la sesión
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $backendApi = config('app.backend_api');
 
        // Realizar la solicitud HTTP con el token en el encabezado
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete($backendApi."/api/Servicio/".$id);  

        return redirect("/Pedidos/Activos");
    }

    public function CancelarPago($id)
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
        ])->put($backendApi."/api/CancelarPago/".$id);  

        return redirect("/Pagos");
    }

    public function CambiarFecha(Request $request){

        $token = Session::get('token');
    
        if (!$token) {
         return response()->json(['error' => 'Token no disponible'], 401);
         }    

         $backendApi = config('app.backend_api');

         $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Servicio/".$request->id);  

        $Servicio = json_decode($response->body());

        $request->Fecha = $request->Fecha;

        return redirect("/Pedidos/Activos/".$request->id);        
    }


    public function Rehabilitar($id){

        $token = Session::get('token');    
        if (!$token) {
         return response()->json(['error' => 'Token no disponible'], 401);
         }    

         $backendApi = config('app.backend_api');
   
         $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Servicio/".$id);  

        $Servicio = json_decode($response->body());

        if($Servicio->Estatus == "SinPago"){

            $Servicio->Estatus= "Activo";

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->put($backendApi."/api/Servicio/".$id, $Servicio); 

            return view("/Pasos/Fecha", compact('id'));
        }

        if($Servicio->Estatus == "Rechazado"){
            $Servicio->Paso = $Servicio->Paso - 3;
        }

        $Servicio->Estatus= "Activo";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put($backendApi."/api/Servicio/".$id, $Servicio); 
     
     return redirect("/Pedidos/Activos/".$id);
    }

    public function ActualizarDatos(Request $request){

        $token = Session::get('token');

        $backendApi = config('app.backend_api');
    
        if (!$token) {
         return response()->json(['error' => 'Token no disponible'], 401);
         }    

         if(!empty($request->Pagado)){
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($backendApi."/api/Servicio/".$request->id);  

            $Servicio = json_decode($response->body());
    
            $Servicio->Pagado = $request->Pagado;
    
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->put($backendApi."/api/Servicio/".$request->id, $Servicio); 
    
            if(!empty($request->I)){
                return $this->BuscarPaso($request);
                }
            return redirect("/Pedidos/Activos/".$request->id);
         }

         $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Servicio/".$request->id);  

        $Servicio = json_decode($response->body());

        $Servicio->Fecha= $request->Fecha;

        $Servicio->Costo= $request->Cantidad;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put($backendApi."/api/Servicio/".$request->id, $Servicio); 

        if(!empty($request->I)){
            return $this->BuscarPaso($request);
            }
     
     return redirect("/Pedidos/Activos/".$request->id);
    }

    public function Votar($id)
    {
        //dd($id);
        $token = Session::get('token');

        $idEmpleado = Session::get('user_id');

        // Verificar si el token existe
        if (!$token) {
            // Manejar el caso donde no hay token disponible en la sesión
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $backendApi = config('app.backend_api');

        $data = [
            'idEliminacion' => $id,
            'Tabla' => "Empleado",
            "Confirmacion" => $idEmpleado,
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post($backendApi."/api/Eliminacion",$data);

        $Eliminacion = json_decode($response->body());

        //dd($Eliminacion);

            if($Eliminacion->Confirmacion1 == $idEmpleado||
            $Eliminacion->Confirmacion2 == $idEmpleado|| 
            $Eliminacion->Confirmacion3 == $idEmpleado){
                return redirect("Pedidos/Activos/".$id."/edit")->with('error', 'No puedes votar dos veces para eliminar');
            }

        //dd($Eliminacion);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put($backendApi."/api/Eliminaciones/".$id,$data);

        //dd($response);
        return redirect("Pedidos/Activos/".$id."/edit");
    }

}
