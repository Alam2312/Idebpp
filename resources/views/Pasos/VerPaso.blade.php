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
    
    <div class="cuerpo" style="margin-top: 30px">

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

      <center>
      @switch($Imagen->Paso)
      @case(1)
          <h1>{{ $paso1 }}</h1>
          @break
      @case(2)
          <h1>{{ $paso2 }}</h1>
          @break
      @case(3)
          <h1>{{ $paso3 }}</h1>
          @break
      @case(4)
          <h1>{{ $paso4 }}</h1>
          @break
      @case(5)
          <h1>{{ $paso5 }}</h1>
          @break
      @case(6)
          <h1>{{ $paso6 }}</h1>
          @break
      @case(7)
          <h1>{{ $paso7 }}</h1>
          @break
      @case(8)
          <h1>{{ $paso8 }}</h1>
          @break
      @case(9)
          <h1>{{ $paso9 }}</h1>
          @break
      @case(10)
          <h1>{{ $paso10 }}</h1>
          @break
      @case(11)
          <h1>{{ $paso11 }}</h1>
          @break
      @case(12)
          <h1>{{ $paso12 }}</h1>
          @break
      @case(13)
          <h1>{{ $paso13 }}</h1>
          @break
      @case(14)
          <h1>{{ $paso14 }}</h1>
          @break
      @case(15)
          <h1>{{ $paso15 }}</h1>
          @break
      @case(16)
          <h1>{{ $paso16 }}</h1>
          @break
      @case(17)
          <h1>{{ $paso17 }}</h1>
          @break
      @case(18)
          <h1>{{ $paso18 }}</h1>
          @break
      @case(19)
          <h1>{{ $paso19 }}</h1>
          @break
      @case(20)
          <h1>{{ $paso20 }}</h1>
          @break
      @case(21)
          <h1>{{ $paso21 }}</h1>
          @break
      @default
          <h1>Paso no definido</h1>
  @endswitch

    <a class="botonArchivos" href="/Pedidos/Activos/{{$Imagen->idServicio}}"><button class="btn btn-info"> Regresar </button></a>

  <br>

  @if(!empty($Imagen->Ruta))

  @foreach ($Empleados as $Empleado)
  @if($Empleado->id == $Imagen->Validacion )
  <a>Validado por:  <b>{{ $Empleado->Nombres }}</b></a>
  @endif
  @endforeach

      </center>

      {{-- @dd($Servicio->Pagado) --}}

      @if($Servicio->Pagado != 0 && $Imagen->Paso == 10) 

      <form method="POST" action="/ModificarFC" style="margin-top: 30px; margin-bottom: 30px;">
        @csrf

        <div class="display">
            <div class="col-md-11">
              <label for="validationCustomUsername" class="form-label"> <b> Cambiar </b> Cantidad</label>
              <div class="input-group has-validation">
                <input type="number" value="{{$Servicio->Pagado}}" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Pagado" step="0.01" required>
              </div>
            </div>

          <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>

          <input type="hidden" value="10" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>
        
          <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>
  
            <div class="col-1" style="position: relative; bottom: -32.5px; left: 15px">
              <button class="btn btn-primary" type="submit">Agregar</button>
            </div>    
        </div>
      </form>

      @endif 

      @php
      $SLinea++;
      $tipo = $Tipos[$Imagen->Paso] ?? '';
      //dd($Imagen);
      @endphp

      <div class="display">

      @if($Imagen->Paso != 22)
       @if(in_array($Imagen->extension, ['jpg', 'jpeg', 'png', 'gif']))
          <!-- Mostrar imagen -->
          <img src="{{ $Imagen->url }}" alt="Imagen" width="60%">
       @else
          
       @if(in_array($Imagen->extension, ['pdf']))
       
          <embed src="{{ $Imagen->url }}" width="60%" />
      
       @else
       <a>Archivo no compatible  para visualizarlo</a>
       <a href="{{ $Imagen->url }}" target="_blank">Descargar</a>
       @endif
      @endif

      <div style="display: flex; justify-content: center; align-items: center; height: 100vh; text-align: center; margin-left: 5vw"> 
        <center>
          <form method="POST" action="/ModificarImagen" enctype="multipart/form-data">
          @csrf

          <div class="col-md-12" style="margin-bottom: 30px">
            <label for="validationCustomUsername" class="form-label"></label>
            <div class="input-group has-validation">
              <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Imagen" required>
            </div>
          </div>

          <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
          <input type="hidden" value="{{$Imagen->Paso}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
          <input type="hidden" value="{{$tipo}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Tipo" required>
          <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>
          <button type="submit" class="btn btn-primary">Cambiar</button>
          </form>
        </center>      
      </div>

    </div>
    @endif
    @else

    @switch($Imagen->Paso)

    @case(1)

        <form method="POST" action="/Imagen" enctype="multipart/form-data">
          @csrf
          <div class="col-md-12" style="margin-bottom: 30px">
            <label for="validationCustomUsername" class="form-label">Imagen</label>
            <div class="input-group has-validation">
              <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" 
              accept="image/*"required>
            </div>
          </div>
    
          
          <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

          <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

          <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

          <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

          <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">

          <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>
    
          <center>
            <div class="col-12" style="margin-bottom: 25px">
              <button class="btn btn-primary" type="submit">Agregar</button>
            </div>

          </center>   
        </form>
       
@break

    @case(2)


        <form method="POST" action="/Imagen" enctype="multipart/form-data">
          @csrf
  
        <div class="col-md-12" style="margin-bottom: 30px">
          <label for="validationCustomUsername" class="form-label">Incliuir a los participates</label>
          <div class="input-group has-validation">
            <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" 
            accept="image/*"required>
          </div>
        </div>
  
            <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

            <input type="hidden" value="2" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

            <input type="hidden" value="2" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

            <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

            <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">

            <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>
  
            <center>
              <div class="col-12" style="margin-bottom: 25px">
                <button class="btn btn-primary" type="submit">Agregar</button>
              </div>
            </center> 

      </form>
@break

    @case(3)

        <form method="POST" action="/Imagen" enctype="multipart/form-data">
          @csrf
          <div class="col-md-12" style="margin-bottom: 30px">
            <label for="validationCustomUsername" class="form-label">Archivo</label>
            <div class="input-group has-validation">
              <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
            </div>
          </div>
    
          
          <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

          <input type="hidden" value="3" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

          <input type="hidden" value="RFQ" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

          <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

          <input type="hidden" value="" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">

          <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>
    
          <center>
            <div class="col-12" style="margin-bottom: 25px">
              <button class="btn btn-primary" type="submit">Agregar</button>
            </div>
          </center>   
        </form>

        @break
    @case(4)

        <form method="POST" action="/Imagen" enctype="multipart/form-data">
          @csrf
  
        <div class="col-md-12" style="margin-bottom: 30px">
          <label for="validationCustomUsername" class="form-label">Archivo</label>
          <div class="input-group has-validation">
            <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
          </div>
        </div>
  
            <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

            <input type="hidden" value="4" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

            <input type="hidden" value="Cotizacion" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

            <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

            <input type="hidden" value="Cotizacion" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">

            <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>
    
            <center>
              <div class="col-12" style="margin-bottom: 25px">
                <button class="btn btn-primary" type="submit">Agregar</button>
              </div>
            </center>      
      </form>

  @break

    @case(5)

        <form method="POST" action="/Imagen" enctype="multipart/form-data">
          @csrf
    
        <div class="col-md-12" style="margin-bottom: 30px">
          <label for="validationCustomUsername" class="form-label">Imagen</label>
          <div class="input-group has-validation">
            <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" 
            accept="image/*"required>
          </div>
        </div>
    
            <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

            <input type="hidden" value="5" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

            <input type="hidden" value="5" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

            <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

            <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">

            <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>
    
        <center>
          <div class="col-12" style="margin-bottom: 3 0px">
            <button class="btn btn-primary" type="submit">Agregar</button>
          </div>
        </center>    
        </form> 
    
        @break
        @case(6)

        <form method="POST" action="/Imagen" enctype="multipart/form-data">
          @csrf
    
        <div class="col-md-12" style="margin-bottom: 30px">
          <label for="validationCustomUsername" class="form-label">Imagen</label>
          <div class="input-group has-validation">
            <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" 
            accept="image/*"required>
          </div>
        </div>
    
            <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

            <input type="hidden" value="6" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

            <input type="hidden" value="6" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

            <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

            <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">

            <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>
    
        <center>
          <div class="col-12" style="margin-bottom: 25px">
            <button class="btn btn-primary" type="submit">Agregar</button>
          </div>
        </center>       
      </form>

      <center>
        <form method="POST" action="/Rechazar" enctype="multipart/form-data">
          @csrf

          <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>

          <input type="hidden" value="6" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

        <div class="col-12" style="margin-bottom: 50px">
          <button class="btn btn-danger" >Rechazada</button>
        </div>
        </form>
      </center>     

    

        @break

    @case(7)

    <form method="POST" action="/Imagen" enctype="multipart/form-data">
      @csrf
      @method("POST")

    <div class="col-md-12" style="margin-bottom: 30px">
      <label for="validationCustomUsername" class="form-label">Archivo</label>
      <div class="input-group has-validation">
        <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
      </div>
    </div>
      
        <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

        <input type="hidden" value="7" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

        <input type="hidden" value="OC" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

        <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

        <input type="hidden" value="OC" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">

        <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>

    <center>
      <div class="col-12" style="margin-bottom: 25px">
        <button class="btn btn-primary" type="submit">Agregar</button>
      </div>
    </center>       
  </form>
    @break

      @case(8)

      @if($Servicio->Costo != 0)

      <div class="display">
      <div class="col-md-6" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label">Cantidad <b>Actual</b></label>
        <div class="input-group has-validation">
          <input value="{{$Servicio->Costo}}" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" readonly>
        </div>
      </div>

    <div class="col-md-6" style="margin-bottom: 30px">
      <label for="validationCustomUsername" class="form-label">Fecha de Vencimiento <b> Actual </b></label>
      <div class="input-group has-validation">
        <input value="{{$Servicio->Fecha}}" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" readonly>
      </div>
    </div>
      </div>

    @endif

      <form method="POST" action="/ModificarFC">
        @csrf

           <div class="display">

            <div class="col-md-6" style="margin-bottom: 30px">
              <label for="validationCustomUsername" class="form-label"> <b> Cambiar </b> Cantidad</label>
              <div class="input-group has-validation">
                <input type="number" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Cantidad" step="0.01" required>
              </div>
            </div>

          <div class="col-md-6" style="margin-bottom: 30px">
            <label for="validationCustomUsername" class="form-label"><b> Cambiar </b> Fecha de Vencimiento</label>
            <div class="input-group has-validation">
              <input type="date" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Fecha" required>
            </div>
          </div>

        </div>

        <input type="hidden" value="8" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>
        
          <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>
  
          <center>
            <div class="col-12" style="margin-bottom: 25px">
              <button class="btn btn-primary" type="submit">Agregar</button>
            </div>
          </center>   

      </form>
      
      @break

      @case(9)

        @if($Servicio->Pago != "vacio")
        <div class="col-md-6" style="margin-bottom: 30px">
            <label for="validationCustomUsername" class="form-label">Tipo de pago <b> Actual </b></label>
            <div class="input-group has-validation">
            <input value="{{$Servicio->Pago}}" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" readonly>
            </div>
        </div>
        </div>  
        @endif

        <div class="display" style="justify-content: center; align-items: center; margin-top: 60px">
            <form method="POST" action="/Pagos/{{$Imagen->idServicio}}" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <input type="hidden" value="9" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>
                <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>
                <input type="hidden" value="Credito" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Pago" required>
                <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>
                <div class="col-12" style="margin-bottom: 25px">
                    <button class="btn btn-info" id="submitCredito" type="button">Credito</button>
                </div>
            </form>
    
            <form method="POST" action="/Pagos/{{$Imagen->idServicio}}" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <input type="hidden" value="9" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>
                <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>
                <input type="hidden" value="Anticipo" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Pago" required>
                <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>
                <div class="col-12" style="margin-bottom: 25px">
                    <button class="btn btn-info" id="submitAnticipo" type="button" style="margin-left: 20px;">Anticipo</button>
                </div>     
            </form>
        </div>

        @break
   
      @case(10)
     
      <form method="POST" action="/Imagen/{{$Imagen->idServicio}}" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="display">
      <div class="col-md-6" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label">Imagen del comprobante del pago</label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" 
          accept="image/*"required>
        </div>
      </div>

      <div class="col-md-6" style="margin-bottom: 30px; margin-left: 5px;">
        <label for="validationCustomUsername" class="form-label">Cantidad del Anticipo</label>
        <div class="input-group has-validation">
          <input type="number" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" step="0.01" name="Pagado" 
          accept="image/*"required>
        </div>
      </div>

    </div>

    <input type="hidden" value="10" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

    <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

    <input type="hidden" value="Anticipo" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

    <input type="hidden" value="Pago" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
        
    <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

    <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>
  
      <center>
        <div class="col-12" style="margin-bottom: 25px">
          <button class="btn btn-primary" type="submit">Agregar</button>
        </div>
      </center>       
    </form>

      @break
   
      @case(11)

      <h2>No puedes realizar ninguna accion en este paso</h2>

      @break

    @case(12)

    <form method="POST" action="/Imagen" enctype="multipart/form-data">
      @csrf
      @method("POST")

    <div class="col-md-12" style="margin-bottom: 30px">
      <label for="validationCustomUsername" class="form-label">Imagen</label>
      <div class="input-group has-validation">
        <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" 
        accept="image/*"required>
      </div>
    </div>
      
        <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

        <input type="hidden" value="12" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

        <input type="hidden" value="12" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

        <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

        <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">

        <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>

    <center>
      <div class="col-12" style="margin-bottom: 25px">
        <button class="btn btn-primary" type="submit">Agregar</button>
      </div>
    </center>       
  </form>
    
    @break

    @case(13)

    <form method="POST" action="/Imagen" enctype="multipart/form-data">
      @csrf
      @method("POST")

    <div class="col-md-12" style="margin-bottom: 30px">
      <label for="validationCustomUsername" class="form-label">Imagen</label>
      <div class="input-group has-validation">
        <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" 
        accept="image/*"required>
      </div>
    </div>
      
        <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

        <input type="hidden" value="13" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

        <input type="hidden" value="13" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

        <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

        <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">

        <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>

    <center>
      <div class="col-12" style="margin-bottom: 25px">
        <button class="btn btn-primary" type="submit">Agregar</button>
      </div>
    </center>       
  </form>
    
    @break

    @case(14)

    <form method="POST" action="/Imagen" enctype="multipart/form-data">
      @csrf
      @method("POST")

    <div class="col-md-12" style="margin-bottom: 30px">
      <label for="validationCustomUsername" class="form-label">Archivo</label>
      <div class="input-group has-validation">
        <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
      </div>
    </div>
      
        <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

        <input type="hidden" value="14" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

        <input type="hidden" value="Reporte" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

        <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

        <input type="hidden" value="Archivos" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">

        <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>

    <center>
      <div class="col-12" style="margin-bottom: 25px">
        <button class="btn btn-primary" type="submit">Agregar</button>
      </div>
    </center>       
  </form>

  
    @break

    @case(15)

    <form method="POST" action="/Imagen" enctype="multipart/form-data">
      @csrf
      @method("POST")

    <div class="col-md-12" style="margin-bottom: 30px">
      <label for="validationCustomUsername" class="form-label">Comprobante del pago</label>
      <div class="input-group has-validation">
        <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
      </div>
    </div>
      
        <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

        <input type="hidden" value="15" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

        <input type="hidden" value="Pago" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

        <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

        <input type="hidden" value="Pago" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">

        <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>

    <center>
      <div class="col-12" style="margin-bottom: 25px">
        <button class="btn btn-primary" type="submit">Agregar</button>
      </div>
    </center>       
  </form>

    @break

    @case(16)

    <form method="POST" action="/Imagen" enctype="multipart/form-data">
      @csrf
      @method("POST")

    <div class="col-md-12" style="margin-bottom: 30px">
      <label for="validationCustomUsername" class="form-label">Archivo</label>
      <div class="input-group has-validation">
        <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
      </div>
    </div>
      
        <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

        <input type="hidden" value="16" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

        <input type="hidden" value="Factura" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

        <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

        <input type="hidden" value="Factura" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">

          <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>

    <center>
      <div class="col-12" style="margin-bottom: 25px">
        <button class="btn btn-primary" type="submit">Agregar</button>
      </div>
    </center>       
  </form>

    @break

    @case(17)

    <h2>No puedes realizar ninguna accion en este paso</h2>

      @break

      @case(18)

      <form method="POST" action="/Imagen" enctype="multipart/form-data">
        @csrf
        @method("POST")

      <div class="col-md-12" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label">Imagen</label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" 
          accept="image/*"required>
        </div>
      </div>
        
          <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

          <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

          <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">

          <input type="hidden" value="18" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

          <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

            <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>

      <center>
        <div class="col-12" style="margin-bottom: 25px">
          <button class="btn btn-primary" type="submit">Agregar</button>
        </div>
      </center>       
    </form>
      
      @break

      @case(19)

      <form method="POST" action="/Historico" enctype="multipart/form-data">
        @csrf
        @method("POST")

      <div class="col-md-12" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label">Diversos archivos</label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
        </div>
      </div>
        
          <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

          <input type="hidden" value="19" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

          <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

          <input type="hidden" value="Historico" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">

          <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>
  
      <center>
        <div class="col-12" style="margin-bottom: 20px">
          <button class="btn btn-primary" type="submit">Agregar</button>
        </div>
      </center>       
    </form>

      @break

      @case(20)

      <form method="POST" action="/Imagen" enctype="multipart/form-data">
        @csrf
        @method("POST")

      <div class="col-md-12" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label">Imagen</label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" 
          accept="image/*"required>
        </div>
      </div>

      <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

      <input type="hidden" value="20" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

      <input type="hidden" value="20" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

      <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

      <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">

          <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>
        
      <center>
        <div class="col-12" style="margin-bottom: 25px">
          <button class="btn btn-primary" type="submit">Agregar</button>
        </div>
      </center>       
    </form>

      @break

      @case(21)

      <form method="POST" action="/Finalizar" enctype="multipart/form-data">
        @csrf
        @method("POST")

      <div class="col-md-12" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label">Imagen</label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" 
          accept="image/*"required>
        </div>
      </div>
        
      <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="I" required>
      <input type="hidden" value="{{$Imagen->idServicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>
  
      <center>
        <div class="col-12" style="margin-bottom: 25px">
          <button class="btn btn-primary" type="submit">Agregar</button>
        </div>
      </center>       
    </form>

    @break

      @default
          <h1>Acción no reconocida</h1>
          <p>No se ha reconocido la acción solicitada.</p>
  @endswitch

    @endif

    </div> <!-- fin del cuerpo con margenes -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('Todo.js') }}"></script>

    <script>
        document.getElementById('submitCredito').addEventListener('click', function() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Al usar este botón el pago del cliente será a 0!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, enviar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            });
        });
    
        document.getElementById('submitAnticipo').addEventListener('click', function() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Al usar este botón el pago del cliente será a 0!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, enviar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            });
        });
    </script>

</body>
</html>
