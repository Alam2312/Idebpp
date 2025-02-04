<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Cliente;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;


class BusquedaController extends Controller

{

    public function store(Request $request)
    {
        $token = Session::get('token'); 
        $backendApi = config('app.backend_api');

        if (!$token) {
            return response()->json(['error' => 'Token no disponible'], 401);
        }

        $request->validate([
            'Buscar' => 'required|max:80',
        ], [
            'Buscar.required' => 'El campo Nombre es obligatorio.',
            "Buscar.max" => "Supera la cantidad permitidas de letras que son 80",
        ]);

        //dd($request);

        $data = [
            'Buscar' => $request->Buscar,
            "Tabla" => $request->Tabla
        ];

        // Realizar la solicitud HTTP POST con el token en el encabezado
        $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
        ])->post($backendApi."/api/Buscar", $data);

        $Busqueda = json_decode($response->body());

        switch ($request->Tabla) {
            case 'Empleados':

                return view('Empleados/BuscarEmpleados', ['EmpleadosPaginados' => $Busqueda]);

                break;
            
            case 'Clientes':
                
                return view('Clientes/BuscarClientes', ['clientesPaginados' => $Busqueda]);

                break;

            case 'PedidosAct':

                $pasos = [
                    0 => 'Imagen del grupo de WhatsApp',
                    1 => 'Captura al Incluir a los participantes',
                    2 => 'Archivo de RFQ',
                    3 => 'Cotización',
                    4 => 'Captura del envío de la cotización',
                    5 => 'Captura de Aceptación de Cotización',
                    6 => 'Orden de Compra',
                    7 => '¿Cuánto pagará el cliente por el servicio?',
                    8 => '¿Cómo pagará el cliente?',
                    9 => 'Anticipo',
                    10 => 'Valida el progreso',
                    11 => 'Confirmacion del del envio de la factura por correo',
                    12 => 'Autorización de la factura',
                    13 => 'Reporte del servicio',
                    14 => 'Comprobante de pago final',
                    15 => 'Subir factura',
                    16 => 'Valida el progreso',
                    17 => 'Cerrar el proyecto',
                    18 => 'Respaldar grupo de whatsApp',
                    19 => 'Notificar que la informacion esta respaldada',
                ];
                      // Recorrer los servicios obtenidos
                      foreach ($Busqueda as $Bus) {
                      // Variable para almacenar el nombre del paso encontrado
                      $nombrePasoEncontrado = '';

                      // Recorrer todos los pasos definidos
                      foreach ($pasos as $numeroPaso => $nombrePaso) {
                      // Comparar el número de paso del servicio con el número de paso del array
                      if ($Bus->Paso == $numeroPaso) {
     
                      $nombrePasoEncontrado = $nombrePaso;

                      $Bus->nombrePaso = $nombrePasoEncontrado;
                      break;
            }}}


                return view('Pedidos/BuscarActivos', ['ServiciosPaginados' => $Busqueda]);

                break;

            case 'PedidosIna':

                return view('Pedidos/BuscarInactivos', ['ServiciosPaginados' => $Busqueda]);

                break;

            case 'PedidosRec':

                return view('Pedidos/BuscarRechazados', ['ServiciosPaginados' => $Busqueda]);
                
                break;

            case 'PedidosPag':

                return view('Pedidos/BuscarPagos', ['ServiciosPaginados' => $Busqueda]);
                    
                break;
            
            default:
                break;
        }

    }
}
