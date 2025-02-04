<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Cliente;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;


class ClienteController extends Controller

{
    public function index()
    {
        $token = Session::get('token');

        if (!$token) {
            // Manejar el caso donde no hay token disponible en la sesión
            return response()->json(['error' => 'Token no disponible'], 401);
        }
        $backendApi = config('app.backend_api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Cliente");

        // Verificar el estado de la respuesta
        if ($response->failed()) {
            return response()->json(['error' => 'Error al obtener datos del servidor'], $response->status());
        }
        // Decodificar la respuesta JSON
        $clientes = $response->json();

        // Paginar los resultados
        $perPage = 10; // Cantidad de elementos por página
        $currentPage = request()->get('page', 1); // Obtener el número de página actual desde la URL
        $offset = ($currentPage - 1) * $perPage;
        $items = array_slice($clientes, $offset, $perPage);
        $clientesPaginados = new LengthAwarePaginator($items, count($clientes), $perPage, $currentPage);

        return view('Clientes.Clientes', compact('clientesPaginados'));
    }



    public function create()
    {
        return view('Clientes/NuevoCliente');
    }


    public function store(Request $request)
    {
        $token = Session::get('token');

        if (!$token) {
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $request->validate([
            'Nombre' => 'required|max:255',
            'Correo' => 'required|email|max:255',
            'Tipo' => 'required|max:255',
            'Telefono' => 'required|numeric|digits:10',
        ], [
            'Nombre.required' => 'El campo Nombre es obligatorio.',
            'Nombre.max' => 'El campo Nombre no debe exceder los 255 caracteres.',
            'Correo.required' => 'El campo Correo es obligatorio.',
            'Correo.email' => 'Debe ingresar un correo electrónico válido.',
            'Correo.max' => 'El campo Correo no debe exceder los 255 caracteres.',
            'Tipo.required' => 'El campo Tipo es obligatorio.',
            'Tipo.max' => 'El campo Tipo no debe exceder los 255 caracteres.',
            'Telefono.required' => 'El campo Teléfono es obligatorio.',
            'Telefono.numeric' => 'El campo Teléfono es incorrecto',
            'Telefono.digits' => 'El campo Teléfono es demasiado corto',

        ]);

        //dd($request);

        // Datos que se enviarán en la solicitud POST
        $data = [
            'Nombre' => $request->Nombre,
            'Correo' => $request->Correo,
            'Tipo' => $request->Tipo,
            'Telefono' => $request->Telefono,
       
        ];

        $backendApi = config('app.backend_api');

        // Realizar la solicitud HTTP POST con el token en el encabezado
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post($backendApi."/api/Cliente", $data);

        //dd($response);

        return redirect("/Clientes");
    }


    public function show($id)
    {
        $token = Session::get('token');

        $idEmpleado = Session::get('user_id');

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
    
        $data = [
            'idEliminacion' => $id,
            'Tabla' => "Cliente",
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

        return view("Clientes/EliminarCliente", compact('Cliente', "Info"));
    }


    public function edit($id)
    {
         // Obtener el token desde la sesión
         $token = Session::get('token');

         // Verificar si el token existe
         if (!$token) {
             // Manejar el caso donde no hay token disponible en la sesión
             return response()->json(['error' => 'Token no disponible'], 401);
         }
 
         $backendApi = config('app.backend_api');

         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $token,
         ])->get($backendApi."/api/Cliente/" . $id);
 
         // Decodificar la respuesta JSON
         $Cliente = json_decode($response->body());
 
         //dd($Cliente);

         return view('Clientes/EditarCliente', ['Cliente' => $Cliente]);
 
    }


    public function update(Request $request, $id)
    {
        // Obtener el token desde la sesión
        $token = Session::get('token');

        // Verificar si el token existe
        if (!$token) {
            // Manejar el caso donde no hay token disponible en la sesión
            return response()->json(['error' => 'Token no disponible'], 401);
        }


        $request->validate([
            'Nombre' => 'required|max:255',
            'Correo' => 'required|email|max:255',
            'Tipo' => 'required|max:255',
            'Telefono' => 'required|numeric|digits:10',
        ], [
            'Nombre.required' => 'El campo Nombre es obligatorio.',
            'Nombre.max' => 'El campo Nombre no debe exceder los 255 caracteres.',
            'Correo.required' => 'El campo Correo es obligatorio.',
            'Correo.email' => 'Debe ingresar un correo electrónico válido.',
            'Correo.max' => 'El campo Correo no debe exceder los 255 caracteres.',
            'Tipo.required' => 'El campo Tipo es obligatorio.',
            'Tipo.max' => 'El campo Tipo no debe exceder los 255 caracteres.',
            'Telefono.required' => 'El campo Teléfono es obligatorio.',
            'Telefono.numeric' => 'El campo Teléfono es incorrecto',
            'Telefono.digits' => 'El campo Teléfono es demasiado corto',

        ]);
        //dd($request);

        // Datos que se enviarán en la solicitud POST
        $data = [
            'Nombre' => $request->Nombre,
            'Correo' => $request->Correo,
            'Tipo' => $request->Tipo,
            'Telefono' => $request->Telefono,
        ];

        $backendApi = config('app.backend_api');

        // Realizar la solicitud HTTP POST con el token en el encabezado
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put($backendApi."/api/Cliente/". $id, $data);

        //dd($response);

        return redirect("Clientes");
    }

    public function destroy($id)
    {
        $token = Session::get('token');

        // Verificar si el token existe
        if (!$token) {
            // Manejar el caso donde no hay token disponible en la sesión
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $backendApi = config('app.backend_api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete($backendApi."/api/Cliente/". $id);

        return redirect()->route('Clientes.index');
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
            'Tabla' => "Cliente",
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
                return redirect("Clientes/".$id)->with('error', 'No puedes votar dos veces para eliminar');
            }

        //dd($Eliminacion);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put($backendApi."/api/Eliminaciones/".$id,$data);

        //dd($response);

        return redirect('Clientes/'.$id);
    }

    
}
