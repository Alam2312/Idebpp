<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Empleado;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class UsuarioController extends Controller
{
    public function index()
    {

        $token = Session::get('token');
        $idEmpleado = Session::get('user_id');

        // Verificar si el token existe
        if (!$token) {
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $backendApi = config('app.backend_api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($backendApi."/api/Empleado/".$idEmpleado);

        // Decodificar la respuesta JSON
        $Usuario = json_decode($response->body());


        return view('Usuario/Usuario', ['Usuario' => $Usuario]);
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
        //dd($request);
        // Obtener el token desde la sesión
        $token = Session::get('token');

        // Verificar si el token existe
        if (!$token) {
            // Manejar el caso donde no hay token disponible en la sesión
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $request->validate([
            'Correo' => 'required|email|max:255',
            'Tipo' => 'required|max:255',
            'Telefono' => 'required|max:10',
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
            'Tipo.required' => 'El tipo es obligatorio.',
            'Tipo.max' => 'El tipo no puede tener más de 255 caracteres.',
            'Telefono.required' => 'El teléfono es obligatorio.',
            'Telefono.numeric' => 'El teléfono debe ser un número.',
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

        $backendApi = config('app.backend_api');

        $response = Http::attach(
            'Imagen',file_get_contents($request->file('Imagen')),$request->file('Imagen')->getClientOriginalName())->
            withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post($backendApi."/api/Empleado",[

                "Nombres" =>$request->Nombres,
                "Apellidos" =>$request->Apellidos,
                "Puesto" => $request->Puesto,
                "Direccion" => $request->Direccion,
                "Telefono" => $request->Telefono,
                "Correo" => $request->Correo,
                "Estatus" => "Activo",
                "RFC" => $request->RFC,
                "CURP" => $request->CURP,
                "Contraseña" => $request->Contraseña,
         ]);
     
        return redirect("Empleados/Empleados");

        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        return view('Usuario/EditarContraseña');
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
     ])->get($backendApi."/api/Empleado/".$idEmpleado);

      // Decodificar la respuesta JSON
      $Usuario = json_decode($response->body());

      //dd($Usuario);

  return view('Usuario/EditarUsuario', ['Usuario' => $Usuario]);
  // Mostrar los datos obtenidos
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
       
               //dd($backendApi);
       
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
       
               //dd($response);
     
        return redirect("/Usuario");

    }

    public function CambiarContraseña(Request $request, $id)
    {
               $token = Session::get('token');

               if (!$token) {
                   return response()->json(['error' => 'Token no disponible'], 401);
               }
       
               $validatedData = $request->validate([
                'Contraseña' => 'required|min:8|confirmed',
            ], [
                'Contraseña.required' => 'La contraseña es obligatoria.',
                'Contraseña.min' => 'La contraseña debe tener al menos 8 caracteres.',
                'Contraseña.confirmed' => 'Las contraseñas no coinciden.',
            ]);

               $backendApi = config('app.backend_api');
       
               $response = Http::withHeaders([
                   'Authorization' => 'Bearer ' . $token,
               ])->put($backendApi."/api/CambiarContraseña/".$id,[
                   "Contraseña" =>$request->Contraseña,
                ]);
     
        return redirect("/Usuario");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);

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

}
