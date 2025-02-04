<?php

namespace App\Http\Controllers;

use App\models\Imagene;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class ImagenController extends Controller
{

    public function Saldar($id)
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
        ])->get($backendApi."/api/Servicio/".$id);
    
        $Servicio = json_decode($response->body());
    
        $Servicio->Paso++;

        $Servicio->Pagado = ($Servicio->Costo - $Servicio->Pagado) + $Servicio->Pagado;

        $Servicio->Pago = "Pagado";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put($backendApi."/api/Servicio/".$id, $Servicio);

        $Responson = json_decode($response->body());

        //dd($Responson);

        return redirect("/Pedidos/Activos/".$id);
    }

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

        $Alm = Session::get('Almacenamiento');

        $idEmpleado = Session::get('user_id');

        $backendApi = config('app.backend_api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Ruta/".$Alm);

        $Ruta = json_decode($response->body());

        Config::set('filesystems.disks.documents.root',$Ruta->Ruta);

        $archivo = $request->file('Imagen');

        $extension=$archivo ->extension();

        if (!file_exists($Ruta->Ruta."\\". $request->Proyecto."\\".$request->Tipo."\\". $request->Nombre.".".$extension)) {
            $rutaArchivo = $archivo->storeAs($request->Proyecto."\\".$request->Tipo, $request->Nombre.".".$extension, 'documents');
            }

        //dd($Ruta->Ruta."\\". $request->Proyecto."\\".$request->Tipo."\\". $request->Nombre.".".$extension);

        //dd($request);
        $data = [
            "Paso" => $request->Paso,
            "Ruta" => "\\". $request->Proyecto."\\".$request->Tipo."\\".$request->Nombre.".".$extension,
            "idServicio" => $request->id,
        ];
    
        // Realizar la solicitud HTTP POST con el token en el encabezado
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post($backendApi."/api/Imagen", $data);

        //dd($response);

        if(!empty($request->I)){
            if($request->I == 1){

                $data = [
                    'id' => $request->id,
                    "Paso" => $request->Paso
                    ];
        
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                ])->post($backendApi."/api/BuscarI", $data);

                $Imagen = json_decode($response->body());

                $Imagen->Validacion = $idEmpleado;

                if(!empty($Imagen->id)){
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                ])->put($backendApi."/api/Imagen/".$Imagen->id, $Imagen);
                }
    
                return $this->BuscarPaso($request);
    
                return redirect()->back();
        }}

        Session::put(['Paso' => $request->Paso]);

        // Enviar un mensaje flash
        session()->flash('success', 'Imagen agregada correctamente.');
    
        return redirect("/Pedidos/Activos/".$request->id);
    }

    public function Finalizar(Request $request)
    {
        //dd($request);
        $token = Session::get('token');
        // Verificar si el token existe
        if (!$token) {
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $backendApi = config('app.backend_api');

        $Alm = Session::get('Almacenamiento');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Ruta/".$Alm);

        $Ruta = json_decode($response->body());

        Config::set('filesystems.disks.documents.root',$Ruta->Ruta);

        $archivo = $request->file('Imagen');

        $extension=$archivo ->extension();
    
        // Guardar el archivo en el disco configurado
        $rutaArchivo = $archivo->storeAs($request->Proyecto."\\".$request->Tipo, $request->Paso.".".$extension, 'documents');

        //dd($request);

        // Petición para traer datos del servicio
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Servicio/".$request->id);
    
        $Servicio = json_decode($response->body());
    
        $Servicio->Paso++;

        $Servicio->Estatus = "Finalizado";
    
        // Realizar la solicitud HTTP PUT con el token en el encabezado
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put($backendApi."/api/Servicio/".$request->id, $Servicio);
    
        $data = [
            "Paso" => $Servicio->Paso,
            "Ruta" => $Ruta->Ruta. "\\". $request->Proyecto."\\".$request->Tipo."\\".$request->Paso.".".$extension,
            "idServicio" => $request->id,
        ];
    
        // Realizar la solicitud HTTP POST con el token en el encabezado
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post($backendApi."/api/Imagen", $data);
    
        // Enviar un mensaje flash
        session()->flash('success', 'Imagen agregada correctamente.');
    
        // Redirigir al usuario
        return redirect("/Pedidos/Inactivos");
    }


    public function Historico(Request $request)
    {
        //dd($request);
        $token = Session::get('token');
        // Verificar si el token existe
        if (!$token) {
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $Alm = Session::get('Almacenamiento');

        $backendApi = config('app.backend_api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Ruta/".$Alm);

        $Ruta = json_decode($response->body());

        Config::set('filesystems.disks.documents.root',$Ruta->Ruta);

        $archivo = $request->file('Imagen');

        $extension=$archivo ->extension();

        $NombreImagen = $NombreImagen = uniqid();
    
        // Guardar el archivo en el disco configurado
        $rutaArchivo = $archivo->storeAs($request->Proyecto."/".$request->Tipo, $request->Paso."_".$NombreImagen.".".$extension, 'documents');

        //dd($request->Proyecto."/".$request->Tipo, $request->Paso."_".$NombreImagen.".".$extension);
    
        $data = [
            "Paso" => $request->Paso,
            "Ruta" =>   "\\". $request->Proyecto."\\".$request->Tipo."\\". $request->Paso."_".$NombreImagen.".".$extension,
            "idServicio" => $request->id,
        ];
    
        // Realizar la solicitud HTTP POST con el token en el encabezado
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post($backendApi."/api/Imagen", $data);
    
        // Enviar un mensaje flash
        session()->flash('success', 'Imagen agregada correctamente.');
    
        // Redirigir al usuario
        return redirect("/Pedidos/Activos/".$request->id);
    }
    


    public function Rechazar(Request $request)
    {
        //dd($request);
        $token = Session::get('token');
        $Alm = Session::get('Almacenamiento');
        $idEmpleado = Session::get('user_id');

        $backendApi = config('app.backend_api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Servicio/". $request["id"]);
    
        $Servicio = json_decode($response->body());

        $Servicio->Estatus= "Rechazado";
    
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put($backendApi."/api/Servicio/".$request["id"], $Servicio);

        return redirect("/Pedidos/Rechazados");
    }

  
    public function update(Request $request, $id)
    {

        $token = Session::get('token');
        if (!$token) {
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $Alm = Session::get('Almacenamiento');
        $backendApi = config('app.backend_api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Ruta/".$Alm);

        $Ruta = json_decode($response->body());

        Config::set('filesystems.disks.documents.root',$Ruta->Ruta);

        $archivo = $request->file('Imagen');

        $extension=$archivo ->extension();
    
        $rutaArchivo = $archivo->storeAs($request->Proyecto."/".$request->Tipo, $request->Paso.".".$extension, 'documents');
    
        $data = [
            "Paso" => $request->Paso,
            "Ruta" =>   "\\". $request->Proyecto."\\".$request->Tipo."\\". $request->Paso.".".$extension,
            "idServicio" => $request->id,
        ];
    
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post($backendApi."/api/Imagen", $data);

        $data = [
        'Pago' => "Anticipo",
        "Pagado" => "$request->Pagado"
        ];
            
        $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
        ])->put($backendApi."/api/Pago/".$id, $data);
    
        // Enviar un mensaje flash
        session()->flash('success', 'Imagen agregada correctamente.');
    
        // Redirigir al usuario
        return redirect("/Pedidos/Activos/".$request->id);

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

   

    public function  MostrarOpcionesPasos(Request $request)
    {
        $token = Session::get('token');
        // Verificar si el token existe
        if (!$token) {
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $backendApi = config('app.backend_api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Servicio/".$request->id);

        $Servicio = json_decode($response->body());

        return view('Pasos/BuscarPaso', compact('request', "Servicio"));
    }

    public function  BuscarPaso(Request $request)
    {
        $data = [
            'id' => $request->id,
            "Paso" => $request->Paso
            ];

        $backendApi = config('app.backend_api');
        $token = Session::get('token');

        $Alm = Session::get('Almacenamiento');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Ruta/".$Alm);

        $RutaTabla = json_decode($response->body());

        $RutaC = $RutaTabla->Ruta;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post($backendApi."/api/BuscarI", $data);

        $Imagen = json_decode($response->body());


        if(!empty($Imagen->id)){
        $Imagen->Ruta = $RutaC . $Imagen->Ruta;
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

    public function MostrarArchivos($id)
    {

        //dd($id);
        $token = Session::get('token');
        // Verificar si el token existe
        if (!$token) {
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

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Imagen/".$id);

        $Imagenes = json_decode($response->body());

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Empleado");

        $Empleados = json_decode($response->body());

        foreach ($Imagenes as $imagen) {
            $imagen->Ruta = $Ruta . $imagen->Ruta;
        }


        foreach ($Imagenes as $imagen) {
            $imagen->extension = pathinfo($imagen->Ruta, PATHINFO_EXTENSION);
            $imagen->url = route('ver_archivo', ['path' => base64_encode($imagen->Ruta)]);
        }

        return view('Pasos/Archivos', compact('Imagenes', "Empleados", "id", "Servicio"));
    }

    public function Validar(Request $request)
    {

        $token = Session::get('token');

        $idEmpleado = Session::get('user_id');
        // Verificar si el token existe
        if (!$token) {
            // Manejar el caso donde no hay token disponible en la sesión
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $backendApi = config('app.backend_api');

        //dd($request);

        if($request->Paso == 9){


            if($request->Pago == "Credito"){
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                ])->get($backendApi."/api/Servicio/".$request->id);
            
                $Servicio = json_decode($response->body());
                $Servicio->Paso++;
                $Servicio->Paso++;
            
                // Realizar la solicitud HTTP PUT con el token en el encabezado
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                ])->put($backendApi."/api/Servicio/".$request->id, $Servicio);
                
                }else{
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token,
                    ])->get($backendApi."/api/Servicio/".$request->id);
                
                    $Servicio = json_decode($response->body());
                    $Servicio->Paso++;
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token,
                    ])->put($backendApi."/api/Servicio/".$request->id, $Servicio);
                }
                return redirect("/Pedidos/Activos/".$request->id);
        }

        //dd($request);

        $Buscar = [
            'Paso' => $request->input('Paso'),
            'id' => $request->input('id')
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post($backendApi."/api/BuscarI", $Buscar);
        //dd($response);
        $Imagen = json_decode($response->body());

        //dd($Imagen);

        $Imagen->Validacion = $idEmpleado;

 
        if(!empty($Imagen->id)){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put($backendApi."/api/Imagen/".$Imagen->id, $Imagen);
        }
        //dd($response);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Servicio/".$request->id);
    
        $Servicio = json_decode($response->body());

        //$Paso = $Servicio->Paso
    
        $Servicio->Paso++;

        $Servicio->Estatus= "Activo";
    
        // Realizar la solicitud HTTP PUT con el token en el encabezado
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->put($backendApi."/api/Servicio/".$request->id, $Servicio);

        return redirect("/Pedidos/Activos/".$request->id);
    }

    public function Regresar($id)
    {
        $token = Session::get('token');
        $idEmpleado = Session::get('user_id');
        if (!$token) {
            return response()->json(['error' => 'Token no disponible'], 401);
        }
        $backendApi = config('app.backend_api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Servicio/".$id);
    
        $Servicio = json_decode($response->body());

        if($Servicio->Paso == 10 && $Servicio->Pago == "Credito"){
            $Servicio->Paso--;
        }
    
        $Servicio->Paso--;
        $Servicio->Estatus= "Activo";
    
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->put($backendApi."/api/Servicio/".$id, $Servicio);

        return redirect("/Pedidos/Activos/".$id);
    }


    public function ModificarImagen(Request $request)
    {
        $token = Session::get('token');

        $Alm = Session::get('Almacenamiento');

        $idEmpleado = Session::get('user_id');
        // Verificar si el token existe
        if (!$token) {
            // Manejar el caso donde no hay token disponible en la sesión
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $backendApi = config('app.backend_api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Ruta/".$Alm);

        $RutaTabla = json_decode($response->body());

        $RutaC = $RutaTabla->Ruta;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Ruta/".$Alm);

        $Ruta = json_decode($response->body());

        Config::set('filesystems.disks.documents.root',$Ruta->Ruta);

        //dd(Config::get('filesystems.disks.documents.root'));

        $Buscar = [
            'Paso' => $request->input('Paso'),
            'id' => $request->input('id')
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post($backendApi."/api/BuscarI", $Buscar);

        $Imagen = json_decode($response->body());

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Servicio/".$Imagen->idServicio);

        $Proyecto = json_decode($response->body());

        $Imagen->Validacion = $idEmpleado;

        $Imagen->Ruta = $RutaC . $Imagen->Ruta;

        if ($Imagen->Ruta) {
            $RutaNueva = str_replace("C:", "", $Imagen->Ruta); 
            $rutaAntigua = str_replace("/", "\\", $RutaNueva); // Asegurarse de usar barras invertidas para Windows
            if (Storage::disk('sinraiz')->exists($rutaAntigua)) {
                Storage::disk('sinraiz')->delete($rutaAntigua);
            }
        }

        $archivo = $request->file('Imagen');

        $extension=$archivo ->extension();
    
        if($request->Paso == 3 || $request->Paso == 4 || $request->Paso == 7 || $request->Paso == 10
        ||$request->Paso == 15 || $request->Paso == 16){

            $rutaArchivo = $archivo->storeAs($Proyecto->Proyecto."\\".$request->Tipo, $request->Tipo.".".$extension, 'documents');

            $Imagen->Ruta = "\\". $Proyecto->Proyecto."\\".$request->Tipo."\\".$request->Tipo.".".$extension;

            if($request->Paso == 10){
                $rutaArchivo = $archivo->storeAs($Proyecto->Proyecto."/".$request->Tipo, "Anticipo".".".$extension, 'documents');
             
                $Imagen->Ruta =  "\\". $Proyecto->Proyecto."\\".$request->Tipo."\\"."Anticipo".".".$extension;
            }

        }else{
            
        $rutaArchivo = $archivo->storeAs($Proyecto->Proyecto."\\".$request->Tipo, $request->Paso.".".$extension, 'documents');

        $Imagen->Ruta = "\\". $Proyecto->Proyecto."\\".$request->Tipo."\\".$request->Paso.".".$extension;
    }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put($backendApi."/api/Imagen/".$Imagen->id, $Imagen);

        //dd($response);

        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('cache:clear');

        if(!empty($request->I)){
        if($request->I == 1){

            return $this->BuscarPaso($request);

            return redirect()->back()->with('success', 'Datos actualizados correctamente');
        }}

        return redirect()->back()->with('success', 'Datos actualizados correctamente');
    }

    public function EliminarImagen($id)
    {

        //dd($id);

        $token = Session::get('token');
        // Verificar si el token existe
        if (!$token) {
            // Manejar el caso donde no hay token disponible en la sesión
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $backendApi = config('app.backend_api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/BuscarNormal/".$id);

        $Imagen = json_decode($response->body());

        if ($Imagen->Ruta) {
            $RutaNueva = str_replace("C:", "", $Imagen->Ruta); 
            $rutaAntigua = str_replace("/", "\\", $RutaNueva); // Asegurarse de usar barras invertidas para Windows
            if (Storage::disk('sinraiz')->exists($rutaAntigua)) {
                Storage::disk('sinraiz')->delete($rutaAntigua);
            }
        }
        
        //dd($Imagen);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete($backendApi."/api/Imagen/".$id);

        //return redirect("/Pedidos/Activos/".$id);
        return redirect()->back();
    }



}
