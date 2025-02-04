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

      @php
    $SLinea = 0;
    $paso1 = 'Imagen del grupo de WhatsApp';
    $paso2 = 'Captura al Incluir a los participantes';
    $paso3 = 'Archivo de RFQ';
    $paso4 = 'Cotización';
    $paso5 = 'Captura del envío de la cotización';
    $paso6 = 'Captura de Aceptación de Cotización';
    $paso7 = 'Orden de Compra';
    $paso8 = '¿Cuánto pagará el cliente por el servicio?';
    $paso9 = '¿Cómo pagará el cliente?';
    $paso10 = 'Anticipo';
    $paso11 = 'Valida el progreso';
    $paso12 = 'Confirmacion del del envio de la factura por correo';
    $paso13 = 'Autorización de la factura';
    $paso14 = 'Reporte del servicio';
    $paso15 = 'Comprobante de pago final';
    $paso16 = 'Subir factura';
    $paso17 = 'Valida el progreso';
    $paso18 = 'Cerrar el proyecto';
    $paso19 = 'Respaldar grupo de whatsApp';
    $paso20 = 'Notificar que la informacion esta respaldada';
    $paso21 = 'Agregar una g al  grupo de whatsapp';

    $Tipos = [
    1 => 'Imagenes',
    2 => 'Imagenes',
    3 => '',
    4 => 'Cotizacion',
    5 => 'Imagenes',
    6 => 'Imagenes',
    7 => 'OC',
    8 => '',
    9 => '',
    10 => 'Pago',
    11 => '',
    12 => 'Imagenes',
    13 => 'Imagenes',
    14 => 'Archivos',
    15 => 'Pago',
    16 => 'Factura',
    17 => '',
    18 => 'Imagenes',
    19 => 'Historico',
    20 => 'Imagenes',
    21 => 'Imagenes',
];
  
      @endphp
 
      @foreach ($Imagenes as $Archivo)

      @if($SLinea > 0)
      <hr>
      @endif

      <center>
      @switch($Archivo->Paso)
      @case(1)
          <h1>{{ $paso1 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por:  <b>{{ $Empleado->Nombres }}</b></a>
          @endif
          @endforeach
        
          @break

      @case(2)
          <h1>{{ $paso2 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por:  <b>{{ $Empleado->Nombres }}</b></a>
          @endif
          @endforeach

          @break
      @case(3)
          <h1>{{ $paso3 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por:  <b>{{ $Empleado->Nombres }}</b></a>
          @endif
          @endforeach

          @break
      @case(4)
          <h1>{{ $paso4 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por:  <b>{{ $Empleado->Nombres }}</b></a>
          @endif
          @endforeach

          @break
      @case(5)
          <h1>{{ $paso5 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por:  <b>{{ $Empleado->Nombres }}</b></a>
          @endif
          @endforeach

          @break
      @case(6)
          <h1>{{ $paso6 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por:  <b>{{ $Empleado->Nombres }}</b></a>
          @endif
          @endforeach

          @break
      @case(7)
          <h1>{{ $paso7 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por: <b>{{ $Empleado->Nombres }}</b></a>
          @endif
          @endforeach

          @break
      @case(8)
          <h1>{{ $paso8 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por:  <b>{{ $Empleado->Nombres }}</b></a>
          @endif
          @endforeach

          @break
      @case(9)
          <h1>{{ $paso9 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por:  <b>{{ $Empleado->Nombres }}</b></a>
          @endif
          @endforeach
        
          @break
      @case(10)
          <h1>{{ $paso10 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por:  <b>{{ $Empleado->Nombres }}</b></a>
          @endif
          @endforeach

          @break
      @case(11)
          <h1>{{ $paso11 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por:  <b>{{ $Empleado->Nombres }}</b>/a>
          @endif
          @endforeach

          @break
      @case(12)
          <h1>{{ $paso12 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por:  <b>{{ $Empleado->Nombres }}</b></a>
          @endif
          @endforeach

          @break
      @case(13)
          <h1>{{ $paso13 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por:  <b>{{ $Empleado->Nombres }}</b></a>
          @endif
          @endforeach

          @break
      @case(14)
          <h1>{{ $paso14 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por:  <b>{{ $Empleado->Nombres }}</b></a>
          @endif
          @endforeach

          @break
      @case(15)
          <h1>{{ $paso15 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por:  <b>{{ $Empleado->Nombres }}</b></a>
          @endif
          @endforeach

          @break
      @case(16)
          <h1>{{ $paso16 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por:  <b>{{ $Empleado->Nombres }}</b></a>
          @endif
          @endforeach

          @break
      @case(17)
          <h1>{{ $paso17 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por: <b>{{ $Empleado->Nombres }}</b></a>
          @endif
          @endforeach

          @break
      @case(18)
          <h1>{{ $paso18 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por: <b>{{ $Empleado->Nombres }}</b></a>
          @endif
          @endforeach

          @break
      @case(19)
          <h1>{{ $paso19 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por: <b>{{ $Empleado->Nombres }}</b></a>
          @endif
          @endforeach

          @break
      @case(20)
          <h1>{{ $paso20 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por: <b>{{ $Empleado->Nombres }}</b></a>
          @endif
          @endforeach

          @break
      @case(21)
          <h1>{{ $paso21 }}</h1>

          @foreach ($Empleados as $Empleado)
          @if($Empleado->id == $Archivo->Validacion )
          <a>Validado por: <b>{{ $Empleado->Nombres }}</b></a>
          @endif
          @endforeach

          @break
      @default
          <h1>Paso no definido</h1>
  @endswitch
      </center>

      @php
      $SLinea++;
      $tipo = $Tipos[$Archivo->Paso] ?? '';
      @endphp

      <div class="display">

      @if($Archivo->Paso != 22)
      @if(in_array($Archivo->extension, ['jpg', 'jpeg', 'png', 'gif']))
          <!-- Mostrar imagen -->
          <img src="{{ $Archivo->url }}" alt="Imagen" width="60%">
      @else
          
      @if(in_array($Archivo->extension, ['pdf']))
       
          <embed src="{{ $Archivo->url }}" width="60%" height="590px" />
      
      @else
      <a>Archivo no compatible  para visualizarlo</a>
      <a href="{{ $Archivo->url }}" target="_blank">Descargar</a>
      @endif
      @endif

      <div class="ValidarDivB"> 
        <center>
          <form method="POST" action="/ModificarImagen" enctype="multipart/form-data">
          @csrf

          <div class="col-md-12" style="margin-bottom: 30px">
            <label for="validationCustomUsername" class="form-label"></label>
            <div class="input-group has-validation">
              <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Imagen" required>
            </div>
          </div>

          <input type="hidden" value="{{$Archivo->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
          <input type="hidden" value="{{$Archivo->Paso}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
          <input type="hidden" value="{{$tipo}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Tipo" required>
          <button type="submit" class="btn btn-primary">Cambiar</button>
          </form>
        </center>      
      </div>

    </div>
      @endif
  @endforeach

    </div>

    </div> <!-- fin del cuerpo con margenes -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('Todo.js') }}"></script>

</body>
</html>
