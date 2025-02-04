<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('Todo.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
  </head>
  <body>

    <div class="header" style="display: flex;color: white;">
      <div>
        <img src="{{ asset('imagenes/logoBlanco.png') }}"  class="logoBlanco">
        <a style="font-weight: bold;" href="/Desloguearse" class="Links">Salir</a>
         <a style="font-weight: bold;" href="/Inicio" class="Links">Inicio</a>
        <a style="font-weight: bold;" class="Links" href="/Usuario" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Usuario</a>
        <a style="font-weight: bold;" href="/Pedidos/Activos/{{$Servicio->id}}" class="Links">Proyecto: {{$Servicio->Proyecto}}</a>
      </div>
      </div>
    
    <div class="cuerpo">

      <form method="POST" action="/BuscarPaso">
        @csrf
        <div class="form-group" style="margin-top: 30px">
            <label for="Paso">Seleccione un paso:</label>
            <select class="form-control" id="Paso" name="Paso">
                <option value="" disabled selected>Elegir</option>
                @if($request->Paso >= 1)
                <option value="1">Imagen del grupo de WhatsApp</option>
                @endif
                @if($request->Paso >= 2)
                <option value="2">Captura al Incluir a los participantes</option>
                @endif
                @if($request->Paso >= 3)
                <option value="3">Archivo de RFQ</option>
                @endif
                @if($request->Paso >= 4)
                <option value="4">Cotización</option>
                @endif
                @if($request->Paso >= 5)
                <option value="5">Captura del envío de la cotización</option>
                @endif
                @if($request->Paso >= 6)
                <option value="6">Captura de Aceptación de Cotización</option>
                @endif
                @if($request->Paso >= 7)
                <option value="7">Orden de Compra</option>
                @endif
                @if($request->Paso >= 8)
                <option value="8">¿Cuánto pagará el cliente por el servicio?</option>
                @endif
                @if($request->Paso >= 9)
                <option value="9">¿Cómo pagará el cliente?</option>
                @endif

                @if($Servicio->Pago == "Anticipo")

                @if($request->Paso >= 10)
                <option value="10">Anticipo</option>
                @endif

                @endif

                @if($request->Paso >= 12)
                <option value="12">Confirmación del envío de la factura por correo</option>
                @endif
                @if($request->Paso >= 13)
                <option value="13">Autorización de la factura</option>
                @endif
                @if($request->Paso >= 14)
                <option value="14">Reporte del servicio</option>
                @endif
                @if($request->Paso >= 15)
                <option value="15">Comprobante de pago final</option>
                @endif
                @if($request->Paso >= 16)
                <option value="16">Subir factura</option>
                @endif
                @if($request->Paso >= 18)
                <option value="18">Cerrar el proyecto</option>
                @endif
                @if($request->Paso >= 20)
                <option value="20">Notificar que la información está respaldada</option>
                @endif
                @if($request->Paso >= 21)
                <option value="21">Agregar una g al grupo de WhatsApp</option>
                @endif
            </select>
        </div>

        <input type="hidden" value="{{$request->id}}" name="id" required>

        <center><button type="submit" class="btn btn-primary" style="margin-top: 10px">Buscar Paso</button></center>

      </form>

    </div>

    </div> <!-- fin del cuerpo con margenes -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('Todo.js') }}"></script>

</body>
</html>
