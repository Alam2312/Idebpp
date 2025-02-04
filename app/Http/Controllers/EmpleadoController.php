<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Empleado;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class EmpleadoController extends Controller
{
    public function index()
    {
        $token = Session::get('token');

        $backendApi = config('app.backend_api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Empleado");

        if ($response->failed()) {
            return response()->json(['error' => 'Error al obtener datos del servidor'], $response->status());
        }

        $Empleados = json_decode($response->body());

        // Paginar los resultados
        $perPage = 10; // Cantidad de elementos por página
        $currentPage = request()->get('page', 1); // Obtener el número de página actual desde la URL
        $offset = ($currentPage - 1) * $perPage;
        $items = array_slice($Empleados, $offset, $perPage);
        $EmpleadosPaginados = new LengthAwarePaginator($items, count($Empleados), $perPage, $currentPage);

        return view('Empleados/Empleados', compact('EmpleadosPaginados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Empleados/NuevoEmpleado');
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
            // Manejar el caso donde no hay token disponible en la sesión
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $request->validate([
            'Telefono' => 'required|digits:10',
            "Nombres" => "required|max:50",
            "Apellidos" =>"required|max:50",
            "Puesto" => "required|max:30",
            "Direccion" => "required|max:255",
            "Correo" => 'required|email|max:255',
            'RFC' => 'required|string|size:13',
            'CURP' => 'required|string|size:18',
            "Contraseña" => 'required|string|min:5|max:60',
        ],  [
            'Correo.required' => 'El correo es obligatorio.',
            'Correo.email' => 'El correo debe ser una dirección de correo válida.',
            'Correo.max' => 'El correo no puede tener más de 255 caracteres.',
            'Telefono.required' => 'El teléfono es obligatorio.',
            'Telefono.digits' => 'El teléfono debe tener exactamente 10 dígitos.',
            'Nombres.required' => 'Los nombres son obligatorios.',
            'Nombres.max' => 'Los nombres no pueden tener más de 50 caracteres.',
            'Apellidos.required' => 'Los apellidos son obligatorios.',
            'Apellidos.max' => 'Los apellidos no pueden tener más de 50 caracteres.',
            'Puesto.required' => 'El puesto es obligatorio.',
            'Puesto.max' => 'El puesto no puede tener más de 30 caracteres.',
            'Direccion.required' => 'La dirección es obligatoria.',
            'Direccion.max' => 'La dirección no puede tener más de 255 caracteres.',
            'RFC.required' => 'El RFC es obligatorio.',
            'RFC.string' => 'El RFC debe ser una cadena de texto.',
            'RFC.size' => 'El RFC debe tener exactamente 13 caracteres.',
            'CURP.required' => 'El CURP es obligatorio.',
            'CURP.string' => 'El CURP debe ser una cadena de texto.',
            'CURP.size' => 'El CURP debe tener exactamente 18 caracteres.',
            'Contraseña.required' => 'La contraseña es obligatoria.',
            'Contraseña.string' => 'La contraseña debe ser una cadena de texto.',
            'Contraseña.min' => 'La contraseña debe tener al menos 5 caracteres.',
            'Contraseña.max' => 'La contraseña no puede tener más de 60 caracteres.',
        ]);

        //dd($request);

        $backendApi = config('app.backend_api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post($backendApi."/api/Empleado",[

                "Nombres" =>$request->Nombres,
                "Apellidos" =>$request->Apellidos,
                "Puesto" => $request->Puesto,
                "Direccion" => $request->Direccion,
                "Telefono" => $request->Telefono,
                "Correo" => $request->Correo,
                "Estatus" => "Activo",
                "Rol" => $request->Rol,
                "RFC" => $request->RFC,
                "CURP" => $request->CURP,
                "Contraseña" => $request->Contraseña,
         ]);
      
        return redirect("/Empleados");

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
        ])->get($backendApi."/api/Empleado/". $id);
    
        $Actual = json_decode($response->body());
    
        //dd($Cliente);

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

        //dd($Info);
        //dd($Empleados);

        foreach($Empleados as $Empleado){

            //dd($Empleado->id);

            if($Empleado->id === $Info->Confirmacion1){
                $Info->Confirmacion1 = $Empleado->Nombres . " " . $Empleado->Apellidos;
                //dd($Info);
            }

            if($Empleado->id === $Info->Confirmacion2){
                $Info->Confirmacion2 = $Empleado->Nombres . " " . $Empleado->Apellidos;
            }

            if($Empleado->id === $Info->Confirmacion3){
                $Info->Confirmacion3 = $Empleado->Nombres . " " . $Empleado->Apellidos;
            }
        }

        //dd($Empleado);

        $Empleado = $Actual;
    
        //return view("Clientes/EliminarCliente");

        return view('Empleados/EliminarEmpleado', compact('Empleado', "Info"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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
 
         // Realizar la solicitud HTTP con el token en el encabezado
         $response = Http::withHeaders([
             'Authorization' => 'Bearer ' . $token,
         ])->get($backendApi."/api/Empleado/" . $id);
 
         // Decodificar la respuesta JSON
         $Empleado = json_decode($response->body());

         //dd($Empleado);
 
         return view('Empleados/EditarEmpleado', ['Empleado' => $Empleado]);
 
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
        $token = Session::get('token');


        if (!$token) {
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $request->validate([
            'Telefono' => 'required|digits:10',
            "Nombres" => "required|max:50",
            "Apellidos" =>"required|max:50",
            "Puesto" => "required|max:30",
            "Direccion" => "required|max:255",
            "Correo" => 'required|email|max:255',
            'RFC' => 'required|string|size:13',
            'CURP' => 'required|string|size:18',
        ],  [
            'Correo.required' => 'El correo es obligatorio.',
            'Correo.email' => 'El correo debe ser una dirección de correo válida.',
            'Correo.max' => 'El correo no puede tener más de 255 caracteres.',
            'Telefono.required' => 'El teléfono es obligatorio.',
            'Telefono.digits' => 'El teléfono debe tener exactamente 10 dígitos.',
            'Nombres.required' => 'Los nombres son obligatorios.',
            'Nombres.max' => 'Los nombres no pueden tener más de 50 caracteres.',
            'Apellidos.required' => 'Los apellidos son obligatorios.',
            'Apellidos.max' => 'Los apellidos no pueden tener más de 50 caracteres.',
            'Puesto.required' => 'El puesto es obligatorio.',
            'Puesto.max' => 'El puesto no puede tener más de 30 caracteres.',
            'Direccion.required' => 'La dirección es obligatoria.',
            'Direccion.max' => 'La dirección no puede tener más de 255 caracteres.',
            'RFC.required' => 'El RFC es obligatorio.',
            'RFC.string' => 'El RFC debe ser una cadena de texto.',
            'RFC.size' => 'El RFC debe tener exactamente 13 caracteres.',
            'CURP.required' => 'El CURP es obligatorio.',
            'CURP.string' => 'El CURP debe ser una cadena de texto.',
            'CURP.size' => 'El CURP debe tener exactamente 18 caracteres.',
        ]);

        $backendApi = config('app.backend_api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put($backendApi."/api/Empleado/".$id,[

            "Nombres" =>$request->Nombres,
            "Apellidos" =>$request->Apellidos,
            "Puesto" => $request->Puesto,
            "Direccion" => $request->Direccion,
            "Telefono" => $request->Telefono,
            "Correo" => $request->Correo,
            "RFC" => $request->RFC,
            "CURP" => $request->CURP,
            "Estatus" => "Activo",
            "Rol" => $request->Rol,
            "_method" => "PUT"
         ]);
     
        return redirect("Empleados");

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
        ])->delete($backendApi."/api/Empleado/". $id);

        return redirect("/Empleados");
    }

    public function Votar($id)
    {
        $token = Session::get('token');
        $backendApi = config('app.backend_api');
        $idEmpleado = Session::get('user_id');

        $data = [
            'idEliminacion' => $id,
            'Tabla' => "Empleado",
            "Confirmacion" => $idEmpleado,
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post($backendApi."/api/Eliminacion",$data);

        $Eliminacion = json_decode($response->body());

            if($Eliminacion->Confirmacion1 == $idEmpleado||
            $Eliminacion->Confirmacion2 == $idEmpleado|| 
            $Eliminacion->Confirmacion3 == $idEmpleado){
                return redirect("Empleados/".$id)->with('error', 'No puedes votar dos veces para eliminar');
            }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put($backendApi."/api/Eliminaciones/".$id,$data);

        return redirect('Empleados/'.$id);
    }
}
