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
        @endphp

      @switch( Session::get('Paso'))
      @case(1)

      <div class="margen" style="display: flex">
        <h1>Paso {{ Session::get('Paso') }} </h1>

        <form method="POST" action="/MostrarOPasos">
          @csrf
          <input type="hidden" value="{{$id}}" name="id" required>
          <input type="hidden" value="1" name="Paso" required>
        <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
        </form>

        <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
      </div>    

          <h1>Imagen del grupo de whatsap</h1>
              
          @if(empty($Imagenes))

          <form method="POST" action="/Imagen" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12" style="margin-bottom: 30px">
              <label for="validationCustomUsername" class="form-label">Imagen</label>
              <div class="input-group has-validation">
                <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" 
                accept="image/*"required>
              </div>
            </div>
      
            
            <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

            <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

            <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

            <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

            <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
      
            <center>
              <div class="col-12" style="margin-bottom: 25px">
                <button class="btn btn-primary" type="submit">Agregar</button>
              </div>

            </center>   
          </form>

          @if(Session::get('Rol') == 0)
          <center>
            <div style="padding-bottom: 30px;">
          <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 10px">
            @csrf
            <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
            <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
            <button type="submit" class="btn btn-primary">Saltar Paso</button>
            </form>
            </div>
          </center>  
          @endif

          @endif

          <div class="display">

          @foreach ($Imagenes as $Archivo)

          @if($Archivo->Paso == 1)

          @if(in_array($Archivo->extension, ['jpg', 'jpeg', 'png', 'gif']))
              <!-- Mostrar imagen -->
              <img src="{{ $Archivo->url }}" alt="Imagen" width="60%">
          @else
              
          @if(in_array($Archivo->extension, ['pdf']))
              <embed src="{{ $Archivo->url }}" width="60% " height="600px" />
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

              <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

              <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>
  
              <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>
  
              <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>
  
              <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
              
              <button type="submit" class="btn btn-primary">Cambiar</button>
              </form>

              <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 10px">
                @csrf
                <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
                <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
                <button type="submit" class="btn btn-primary">Validar</button>
                </form>
            </center>      
          </div>

        </div>
          @endif
      @endforeach

         

  @break
  
      @case(2)

      <div class="margen" style="display: flex">
        <h1>Paso {{ Session::get('Paso') }} </h1>

        <form method="POST" action="/MostrarOPasos">
          @csrf
          <input type="hidden" value="{{$id}}" name="id" required>
          <input type="hidden" value="2" name="Paso" required>
        <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
        </form>

        <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
      </div>   

          <h1>Captura al Incliuir a los participates</h1>
          {{-- <p>Esta es la acción de crear contenido.</p> --}}

          @php
          $Bandera = 0; 
          @endphp
          
          @if(!empty($Imagenes))
          @foreach ($Imagenes as $Archivo)
          
          @if($Archivo->Paso == 2)

          @php
          $Bandera++; 
          @endphp       

          @endif

          @endforeach
          @endif

          @if($Bandera == 0)

          <form method="POST" action="/Imagen" enctype="multipart/form-data">
            @csrf
    
          <div class="col-md-12" style="margin-bottom: 30px">
            <label for="validationCustomUsername" class="form-label">Incliuir a los participates</label>
            <div class="input-group has-validation">
              <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" 
              accept="image/*"required>
            </div>
          </div>
    
              <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

              <input type="hidden" value="2" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

              <input type="hidden" value="2" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

              <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>
  
              <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
    
              <center>
                <div class="col-12" style="margin-bottom: 25px">
                  <button class="btn btn-primary" type="submit">Agregar</button>
                </div>
              </center> 
        </form>

        @if(Session::get('Rol') == 0)
        <center>
          <div style="padding-bottom: 30px;">
          <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
            @csrf
            <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
            <input type="hidden" value="2" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
            <button type="submit" class="btn btn-primary">Saltar Paso</button>
            </form>
          </div>
        </center>  
        @endif
         
        <center>
          <form method="GET" action="/Regresar/{{$id}}">

            <div class="col-12" style="margin-bottom: 25px">
              <button class="btn btn-warning" type="submit">Paso Anterior</button>
            </div>

          </form>
        </center>

        @endif
 

        <div class="display">

        @foreach ($Imagenes as $Archivo)

        @if($Archivo->Paso == 2)

        @if(in_array($Archivo->extension, ['jpg', 'jpeg', 'png', 'gif']))
            <!-- Mostrar imagen -->
            <img src="{{ $Archivo->url }}" alt="Imagen" width="60%">
        @else
            
        @if(in_array($Archivo->extension, ['pdf']))
            <embed src="{{ $Archivo->url }}" width="60% " height="600px" />
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

              <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

              <input type="hidden" value="2" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

              <input type="hidden" value="2" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

              <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>
  
              <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
    
              
              <button type="submit" class="btn btn-primary">Cambiar</button>
              </form>

            <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
            @csrf
            <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
            <input type="hidden" value="2" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
            <button type="submit" class="btn btn-primary">Validar</button>
            </form>
          </center>      
        </div>

        @endif
    @endforeach

        </div>

  @break
  
      @case(3)

      <div class="margen" style="display: flex">
        <h1>Paso {{ Session::get('Paso') }} </h1>

        <form method="POST" action="/MostrarOPasos">
          @csrf
          <input type="hidden" value="{{$id}}" name="id" required>
          <input type="hidden" value="3" name="Paso" required>
        <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
        </form>

        <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
      </div>   

          <h1>Archivo de RFQ</h1>

          @php
          $Bandera = 0; 
          @endphp
          
          @if(!empty($Imagenes))
          @foreach ($Imagenes as $Archivo)
          
          @if($Archivo->Paso == 3)

          @php
          $Bandera++; 
          @endphp       

          @endif

          @endforeach
          @endif

          @if($Bandera == 0)

          <form method="POST" action="/Imagen" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12" style="margin-bottom: 30px">
              <label for="validationCustomUsername" class="form-label">Archivo</label>
              <div class="input-group has-validation">
                <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
              </div>
            </div>
      
            
            <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

            <input type="hidden" value="3" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

            <input type="hidden" value="RFQ" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

            <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

            <input type="hidden" value="" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
      
            <center>
              <div class="col-12" style="margin-bottom: 25px">
                <button class="btn btn-primary" type="submit">Agregar</button>
              </div>
            </center>   
          </form>

          @if(Session::get('Rol') == 0)
          <center>
            <div style="padding-bottom: 30px;">
            <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
              @csrf
              <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
              <input type="hidden" value="3" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
              <button type="submit" class="btn btn-primary">Saltar Paso</button>
            </form>
            </div>
          </center>  
          @endif

          <center>
            <form method="GET" action="/Regresar/{{$id}}">
  
              <div class="col-12" style="margin-bottom: 25px">
                <button class="btn btn-warning" type="submit">Paso Anterior</button>
              </div>
  
            </form>
          </center>  

          @endif
  
          <div class="display">
  
          @foreach ($Imagenes as $Archivo)
  
          @if($Archivo->Paso == 3)
  
          @if(in_array($Archivo->extension, ['jpg', 'jpeg', 'png', 'gif']))
              <!-- Mostrar imagen -->
              <img src="{{ $Archivo->url }}" alt="Imagen" width="60%">
          @else
              
          @if(in_array($Archivo->extension, ['pdf']))
              <embed src="{{ $Archivo->url }}" width="60% " height="600px" />
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
  
                <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

            <input type="hidden" value="3" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

            <input type="hidden" value="RFQ" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

            <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

            <input type="hidden" value="" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
      
                
                <button type="submit" class="btn btn-primary">Cambiar</button>
                </form>

              <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
              @csrf
              <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
              <input type="hidden" value="3" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
              <button type="submit" class="btn btn-primary">Validar</button>
              </form>
            </center>          
          </div>
  
          @endif
      @endforeach
  
          </div>

  @break
  
      @case(4)

      <div class="margen" style="display: flex">
        <h1>Paso {{ Session::get('Paso') }} </h1>

        <form method="POST" action="/MostrarOPasos">
          @csrf
          <input type="hidden" value="{{$id}}" name="id" required>
          <input type="hidden" value="4" name="Paso" required>
        <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
        </form>

        <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
      </div>   

          <h1>Cotizacion</h1>
          {{-- <p>Esta es la acción de eliminar contenido.</p> --}}

          @php
          $Bandera = 0; 
          @endphp
          
          @if(!empty($Imagenes))
          @foreach ($Imagenes as $Archivo)
          
          @if($Archivo->Paso == 4)

          @php
          $Bandera++; 
          @endphp       

          @endif

          @endforeach
          @endif

          @if($Bandera == 0)

          <form method="POST" action="/Imagen" enctype="multipart/form-data">
            @csrf
    
          <div class="col-md-12" style="margin-bottom: 30px">
            <label for="validationCustomUsername" class="form-label">Archivo</label>
            <div class="input-group has-validation">
              <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
            </div>
          </div>
    
              <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

              <input type="hidden" value="4" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

              <input type="hidden" value="Cotizacion" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

              <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

              <input type="hidden" value="Cotizacion" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
      
              <center>
                <div class="col-12" style="margin-bottom: 25px">
                  <button class="btn btn-primary" type="submit">Agregar</button>
                </div>
              </center>      
        </form>

        @if(Session::get('Rol') == 0)
        <center>
          <div style="padding-bottom: 30px;">
          <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
            @csrf
            <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
            <input type="hidden" value="4" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
            <button type="submit" class="btn btn-primary">Saltar Paso</button>
            </form>
          </div>
        </center>  
        @endif

        <center>
          <form method="GET" action="/Regresar/{{$id}}">

            <div class="col-12" style="margin-bottom: 25px">
              <button class="btn btn-warning" type="submit">Paso Anterior</button>
            </div>

          </form>
        </center>


        @endif
  
        <div class="display">

        @foreach ($Imagenes as $Archivo)

        @if($Archivo->Paso == 4)

        @if(in_array($Archivo->extension, ['jpg', 'jpeg', 'png', 'gif']))
            <!-- Mostrar imagen -->
            <img src="{{ $Archivo->url }}" alt="Imagen" width="60%">
        @else
            
        @if(in_array($Archivo->extension, ['pdf']))
            <embed src="{{ $Archivo->url }}" width="60% " height="600px" />
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

              <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

              <input type="hidden" value="4" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

              <input type="hidden" value="Cotizacion" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

              <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

              <input type="hidden" value="Cotizacion" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">

              
              <button type="submit" class="btn btn-primary">Cambiar</button>
              </form>

            <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
            @csrf
            <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
            <input type="hidden" value="4" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
            <button type="submit" class="btn btn-primary">Validar</button>
            </form>
          </center>      
        </div>

        @endif
        @endforeach

        </div>

    @break

      @case(5)

      <div class="margen" style="display: flex">
        <h1>Paso {{ Session::get('Paso') }} </h1>

        <form method="POST" action="/MostrarOPasos">
          @csrf
          <input type="hidden" value="{{$id}}" name="id" required>
          <input type="hidden" value="5" name="Paso" required>
        <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
        </form>

        <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
      </div>      

          <h1>Captura del envio de la cotizacion</h1>

          @php
          $Bandera = 0; 
          @endphp
          
          @if(!empty($Imagenes))
          @foreach ($Imagenes as $Archivo)
          
          @if($Archivo->Paso == 5)

          @php
          $Bandera++; 
          @endphp       

          @endif

          @endforeach
          @endif

          @if($Bandera == 0)

          <form method="POST" action="/Imagen" enctype="multipart/form-data">
            @csrf
      
          <div class="col-md-12" style="margin-bottom: 30px">
            <label for="validationCustomUsername" class="form-label">Imagen</label>
            <div class="input-group has-validation">
              <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" 
              accept="image/*"required>
            </div>
          </div>
      
              <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

              <input type="hidden" value="5" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

              <input type="hidden" value="5" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

              <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>
  
              <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
      
          <center>
            <div class="col-12" style="margin-bottom: 3 0px">
              <button class="btn btn-primary" type="submit">Agregar</button>
            </div>
          </center>    
          </form>

          @if(Session::get('Rol') == 0)
          <center>
            <div style="padding-bottom: 30px;">
            <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
              @csrf
              <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
              <input type="hidden" value="5" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
              <button type="submit" class="btn btn-primary">Saltar Paso</button>
              </form>
            </div>
          </center>  
          @endif
          
          <center>
            <form method="GET" action="/Regresar/{{$id}}">
  
              <div class="col-12" style="margin-bottom: 25px">
                <button class="btn btn-warning" type="submit">Paso Anterior</button>
              </div>
  
            </form>
          </center>
  
          
          @endif
  
          <div class="display">
  
          @foreach ($Imagenes as $Archivo)
  
          @if($Archivo->Paso == 5)
  
          @if(in_array($Archivo->extension, ['jpg', 'jpeg', 'png', 'gif']))
              <!-- Mostrar imagen -->
              <img src="{{ $Archivo->url }}" alt="Imagen" width="60%">
          @else
              
          @if(in_array($Archivo->extension, ['pdf']))
              <embed src="{{ $Archivo->url }}" width="60% " height="600px" />
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
  
                <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

                <input type="hidden" value="5" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>
  
                <input type="hidden" value="5" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>
  
                <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>
    
                <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">  
                
                
                <button type="submit" class="btn btn-primary">Cambiar</button>
                </form>

              <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
              @csrf
              <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
              <input type="hidden" value="5" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
              <button type="submit" class="btn btn-primary">Validar</button>
              </form>
            </center>      
          </div>
  
          @endif
          @endforeach
  
          </div>

          @break

          @case(6)

      <div class="margen" style="display: flex">
        <h1>Paso {{ Session::get('Paso') }} </h1>

        <form method="POST" action="/MostrarOPasos">
          @csrf
          <input type="hidden" value="{{$id}}" name="id" required>
          <input type="hidden" value="6" name="Paso" required>
        <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
        </form>

        <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
      </div>   

          <h1>Captura de Aceptacion de Cotizacion</h1>
 
          @php
          $Bandera = 0; 
          @endphp
          
          @if(!empty($Imagenes))
          @foreach ($Imagenes as $Archivo)
          
          @if($Archivo->Paso == 6)

          @php
          $Bandera++; 
          @endphp       

          @endif

          @endforeach
          @endif

          @if($Bandera == 0)

          <form method="POST" action="/Imagen" enctype="multipart/form-data">
            @csrf
      
          <div class="col-md-12" style="margin-bottom: 30px">
            <label for="validationCustomUsername" class="form-label">Imagen</label>
            <div class="input-group has-validation">
              <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" 
              accept="image/*"required>
            </div>
          </div>
      
              <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

              <input type="hidden" value="6" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

              <input type="hidden" value="6" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

              <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>
  
              <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
      
          <center>
            <div class="col-12" style="margin-bottom: 25px">
              <button class="btn btn-primary" type="submit">Agregar</button>
            </div>
          </center>       
        </form>

        @if(Session::get('Rol') == 0)
        <center>
          <div style="padding-bottom: 30px;">
          <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px;">
            @csrf
            <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
            <input type="hidden" value="6" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
            <button type="submit" class="btn btn-primary">Saltar Paso</button>
            </form>
          </div>
        </center>  
        @endif

        <center>
          <form method="GET" action="/Regresar/{{$id}}">

            <div class="col-12" style="margin-bottom: 25px">
              <button class="btn btn-warning" type="submit">Paso Anterior</button>
            </div>

          </form>
        </center>


        <center>
          <form method="POST" action="/Rechazar" enctype="multipart/form-data">
            @csrf

            <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>

            <input type="hidden" value="6" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

          <div class="col-12" style="margin-bottom: 50px">
            <button class="btn btn-danger" >Rechazada</button>
          </div>
          </form>
        </center>     

        @endif
  
        <div class="display">

        @foreach ($Imagenes as $Archivo)

        @if($Archivo->Paso == 6)

        @if(in_array($Archivo->extension, ['jpg', 'jpeg', 'png', 'gif']))
            <!-- Mostrar imagen -->
            <img src="{{ $Archivo->url }}" alt="Imagen" width="60%">
        @else
            
        @if(in_array($Archivo->extension, ['pdf']))
            <embed src="{{ $Archivo->url }}" width="60% " height="600px" />
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

              <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

              <input type="hidden" value="6" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

              <input type="hidden" value="6" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

              <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>
  
              <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
      
              
              <button type="submit" class="btn btn-primary">Cambiar</button>
              </form>

            <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px;">
            @csrf
            <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
            <input type="hidden" value="6" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
            <button type="submit" class="btn btn-primary">Validar</button>
            </form>

            <form method="POST" action="/Rechazar" enctype="multipart/form-data" style="margin-top: 20px">
              @csrf
  
              <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>
  
              <input type="hidden" value="6" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>
  
            <div class="col-12" style="margin-bottom: 50px">
              <button class="btn btn-danger" >Rechazada</button>
            </div>
            </form>
 
          </center>        

        </div>

        @endif
        @endforeach

        </div>


          @break

      @case(7)

      <div class="margen" style="display: flex">
        <h1>Paso {{ Session::get('Paso') }} </h1>

        <form method="POST" action="/MostrarOPasos">
          @csrf
          <input type="hidden" value="{{$id}}" name="id" required>
          <input type="hidden" value="7" name="Paso" required>
        <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
        </form>

        <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
      </div>   

      <h1>Orden de Compra</h1>

      @php
      $Bandera = 0; 
      @endphp
      
      @if(!empty($Imagenes))
      @foreach ($Imagenes as $Archivo)
      
      @if($Archivo->Paso == 7)

      @php
      $Bandera++; 
      @endphp       

      @endif

      @endforeach
      @endif

      @if($Bandera == 0)

      <form method="POST" action="/Imagen" enctype="multipart/form-data">
        @csrf
        @method("POST")

      <div class="col-md-12" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label">Archivo</label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
        </div>
      </div>
        
          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

          <input type="hidden" value="7" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

          <input type="hidden" value="OC" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

          <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

          <input type="hidden" value="OC" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
  
      <center>
        <div class="col-12" style="margin-bottom: 25px">
          <button class="btn btn-primary" type="submit">Agregar</button>
        </div>
      </center>       
    </form>

    @if(Session::get('Rol') == 0)
    <center>
      <div style="padding-bottom: 30px;">
      <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
        @csrf
        <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
        <input type="hidden" value="7" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
        <button type="submit" class="btn btn-primary">Saltar Paso</button>
      </form>
      </div>
    </center>  
    @endif

    <center>
      <form method="GET" action="/Regresar/{{$id}}">
        <div class="col-12" style="margin-bottom: 25px">
          <button class="btn btn-warning" type="submit">Paso Anterior</button>
        </div>
      </form>
    </center>


    @endif
  
    <div class="display">

    @foreach ($Imagenes as $Archivo)

    @if($Archivo->Paso == 7)

    @if(in_array($Archivo->extension, ['jpg', 'jpeg', 'png', 'gif']))
        <!-- Mostrar imagen -->
        <img src="{{ $Archivo->url }}" alt="Imagen" width="60%">
    @else
        
    @if(in_array($Archivo->extension, ['pdf']))
        <embed src="{{ $Archivo->url }}" width="60% " height="600px" />
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

          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

          <input type="hidden" value="7" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

          <input type="hidden" value="OC" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

          <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

          <input type="hidden" value="OC" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
  
          
          <button type="submit" class="btn btn-primary">Cambiar</button>
          </form>

        <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
        @csrf
        <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
        <input type="hidden" value="7" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
        <button type="submit" class="btn btn-primary">Validar</button>
        </form>
      </center>      
    </div>

    @endif
    @endforeach

    </div>
        @break

        @case(8)

        <div class="margen" style="display: flex">
          <h1>Paso {{ Session::get('Paso') }} </h1>

          <form method="POST" action="/MostrarOPasos">
            @csrf
            <input type="hidden" value="{{$id}}" name="id" required>
            <input type="hidden" value="8" name="Paso" required>
          <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
          </form>

          <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
        </div>   

        <h1>¿Cuánto pagara el cliente por el servicio?</h1>


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
                <label for="validationCustomUsername" class="form-label">Cantidad</label>
                <div class="input-group has-validation">
                  <input type="number" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Cantidad" step="0.01" required>
                </div>
              </div>

            <div class="col-md-6" style="margin-bottom: 30px">
              <label for="validationCustomUsername" class="form-label">Fecha de Vencimiento</label>
              <div class="input-group has-validation">
                <input type="date" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Fecha" required>
              </div>
            </div>

          </div>
          
            <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>
    
            <center>
              <div class="col-12" style="margin-bottom: 20px">
                <button class="btn btn-primary" type="submit">Agregar</button>
              </div>
            </center>   

        </form>

        @if($Servicio->Costo != 0)
        <center>
          <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px;margin-bottom: 20px;">
            @csrf
            <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
            <input type="hidden" value="8" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
            <button type="submit" class="btn btn-primary">Validar</button>
            </form>
        </center>
        @endif

        <center>
          <form method="GET" action="/Regresar/{{$id}}">
            <div class="col-12" style="margin-bottom: 25px">
              <button class="btn btn-warning" type="submit">Paso Anterior</button>
            </div>
          </form>
        </center>


        
        @break

        @case(9)

        <div class="margen" style="display: flex">
          <h1>Paso {{ Session::get('Paso') }} </h1>

          <form method="POST" action="/MostrarOPasos">
            @csrf
            <input type="hidden" value="{{$id}}" name="id" required>
            <input type="hidden" value="9" name="Paso" required>
          <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
          </form>

          <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
        </div>    

        <h1>¿Como pagará el cliente?</h1>

      <center>
        @if($Servicio->Pago != "vacio")
        <div class="col-md-6" style="margin-bottom: 30px">
            <label for="validationCustomUsername" class="form-label">Tipo de pago <b> Actual </b></label>
            <div class="input-group has-validation">
            <input value="{{$Servicio->Pago}}" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" readonly>
            </div>
        </div>
        </div>  
        @endif
      </center>

      <div class="display" style="justify-content: center; align-items: center; margin-top: 60px">
        <form method="POST" action="/Pagos/{{$id}}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <input type="hidden" value="Credito" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Pago" required>
            <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>
            <div class="col-12" style="margin-bottom: 25px">
                <button class="btn btn-info" id="submitCredito" type="button">Credito</button>
            </div>
        </form>

        <form method="POST" action="/Pagos/{{$id}}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <input type="hidden" value="Anticipo" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Pago" required>
            <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>
            <div class="col-12" style="margin-bottom: 25px">
                <button class="btn btn-info" id="submitAnticipo" type="button" style="margin-left: 20px;">Anticipo</button>
            </div>     
        </form>
    </div>

    @if($Servicio->Pago != "vacio")
    <center>
      <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-bottom: 20px;">
        @csrf
        <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
        <input type="hidden" value="9" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
        <button type="submit" class="btn btn-primary">Validar</button>
        </form>
    </center>
    @endif

        <center>
          <form method="GET" action="/Regresar/{{$id}}">
            <div class="col-12" style="margin-bottom: 25px">
              <button class="btn btn-warning" type="submit">Paso Anterior</button>
            </div>
          </form>
        </center>

        @break
     
        @case(10)

        <div class="margen" style="display: flex">
          <h1>Paso {{ Session::get('Paso') }} </h1>

          <form method="POST" action="/MostrarOPasos">
            @csrf
            <input type="hidden" value="{{$id}}" name="id" required>
            <input type="hidden" value="10" name="Paso" required>
          <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
          </form>

          <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
        </div>   

        <h1>Anticipo</h1>

        @php
        $Bandera = 0; 
        @endphp
        
        @if(!empty($Imagenes))
        @foreach ($Imagenes as $Archivo)
        
        @if($Archivo->Paso == 10)

        @php
        $Bandera++; 
        @endphp       

        @endif

        @endforeach
        @endif

        @if($Bandera == 0)
       
        <form method="POST" action="/Imagen/{{$id}}" enctype="multipart/form-data">
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
          
      <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>
    
        <center>
          <div class="col-12" style="margin-bottom: 25px">
            <button class="btn btn-primary" type="submit">Agregar</button>
          </div>
        </center>       
      </form>

      @if(Session::get('Rol') == 0)
      <center>
        <div style="padding-bottom: 30px;">
        <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
          @csrf
          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
          <input type="hidden" value="10" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
          <button type="submit" class="btn btn-primary">Saltar Paso</button>
          </form>
        </div>
      </center>  
      @endif

      <center>
        <form method="GET" action="/Regresar/{{$id}}">
          <div class="col-12" style="margin-bottom: 25px">
            <button class="btn btn-warning" type="submit">Paso Anterior</button>
          </div>
        </form>
      </center>

      @endif



      @if($Servicio->Pagado != 0) 

      <form method="POST" action="/ModificarFC" style="margin-top: 30px; margin-bottom: 30px;">
        @csrf

        <div class="display">
            <div class="col-md-11">
              <label for="validationCustomUsername" class="form-label"> <b> Cambiar </b> Cantidad</label>
              <div class="input-group has-validation">
                <input type="number" value="{{$Servicio->Pagado}}" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Pagado" step="0.01" required>
              </div>
            </div>

          <input type="hidden" value="10" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>
        
          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>
  
            <div class="col-1" style="position: relative; bottom: -32.5px; left: 15px">
              <button class="btn btn-primary" type="submit">Agregar</button>
            </div>    
        </div>
      </form>
      @endif 


  
      <div class="display">
  
      @foreach ($Imagenes as $Archivo)
  
      @if($Archivo->Paso == 10)
  
      @if(in_array($Archivo->extension, ['jpg', 'jpeg', 'png', 'gif']))
          <!-- Mostrar imagen -->
          <img src="{{ $Archivo->url }}" alt="Imagen" width="60%">
      @else
          
      @if(in_array($Archivo->extension, ['pdf']))
          <embed src="{{ $Archivo->url }}" width="60% " height="600px" />
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

          <input type="hidden" value="10" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

      <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

      <input type="hidden" value="Anticipo" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

      <input type="hidden" value="Pago" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
          
      <input type="hidden" value="{{$id}}" id="validationCustom" name="id">
          
          <button type="submit" class="btn btn-primary">Cambiar</button>
          </form>

          <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
          @csrf
          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
          <input type="hidden" value="10" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
          <button type="submit" class="btn btn-primary">Validar</button>
          </form>
        </center>      
      </div>
  
      @endif
      @endforeach
  
      </div>

        @break
     
        @case(11)

        <div class="margen" style="display: flex">
          <h1>Paso {{ Session::get('Paso') }} </h1>
          <form method="POST" action="/MostrarOPasos">
            @csrf
            <input type="hidden" value="{{$id}}" name="id" required>
            <input type="hidden" value="11" name="Paso" required>
          <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
          </form>

          <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
        </div>   
          
          @if( Session::get('Rol') == 0)
              <h1>Valida el progreso</h1>

              <center>
                <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 40px">
                  @csrf
                  <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
                  <input type="hidden" value="11" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
                  <button type="submit" class="btn btn-primary">Validar</button>
                  </form>
              </center>       

              <center>
                <form method="GET" action="/Regresar/{{$id}}">
                  <div class="col-12" style="margin-bottom: 25px;margin-top: 25px">
                    <button class="btn btn-warning" type="submit">Paso Anterior</button>
                  </div>
                </form>
              </center>

             
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
                    <!-- Contenido específico del paso 1 -->
                    @break
                @case(2)
                    <h1>{{ $paso2 }}</h1>
                    <!-- Contenido específico del paso 2 -->
                    @break
                @case(3)
                    <h1>{{ $paso3 }}</h1>
                    <!-- Contenido específico del paso 3 -->
                    @break
                @case(4)
                    <h1>{{ $paso4 }}</h1>
                    <!-- Contenido específico del paso 4 -->
                    @break
                @case(5)
                    <h1>{{ $paso5 }}</h1>
                    <!-- Contenido específico del paso 5 -->
                    @break
                @case(6)
                    <h1>{{ $paso6 }}</h1>
                    <!-- Contenido específico del paso 6 -->
                    @break
                @case(7)
                    <h1>{{ $paso7 }}</h1>
                    <!-- Contenido específico del paso 7 -->
                    @break
                @case(8)
                    <h1>{{ $paso8 }}</h1>
                    <!-- Contenido específico del paso 8 -->
                    @break
                @case(9)
                    <h1>{{ $paso9 }}</h1>
                    <!-- Contenido específico del paso 9 -->
                    @break
                @case(10)
                    <h1>{{ $paso10 }}</h1>
                    <!-- Contenido específico del paso 10 -->
                    @break
                @case(11)
                    <h1>{{ $paso11 }}</h1>
                    <!-- Contenido específico del paso 11 -->
                    @break
                @case(12)
                    <h1>{{ $paso12 }}</h1>
                    <!-- Contenido específico del paso 12 -->
                    @break
                @case(13)
                    <h1>{{ $paso13 }}</h1>
                    <!-- Contenido específico del paso 13 -->
                    @break
                @case(14)
                    <h1>{{ $paso14 }}</h1>
                    <!-- Contenido específico del paso 14 -->
                    @break
                @case(15)
                    <h1>{{ $paso15 }}</h1>
                    <!-- Contenido específico del paso 15 -->
                    @break
                @case(16)
                    <h1>{{ $paso16 }}</h1>
                    <!-- Contenido específico del paso 16 -->
                    @break
                @case(17)
                    <h1>{{ $paso17 }}</h1>
                    <!-- Contenido específico del paso 17 -->
                    @break
                @case(18)
                    <h1>{{ $paso18 }}</h1>
                    <!-- Contenido específico del paso 18 -->
                    @break
                @case(19)
                    <h1>{{ $paso19 }}</h1>
                    <!-- Contenido específico del paso 19 -->
                    @break
                @case(20)
                    <h1>{{ $paso20 }}</h1>
                    <!-- Contenido específico del paso 20 -->
                    @break
                @case(21)
                    <h1>{{ $paso21 }}</h1>
                    <!-- Contenido específico del paso 21 -->
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
          
          @else
              
          <h1>Espera a que validen el progreso</h1>

          <center>
            <form method="GET" action="/Regresar/{{$id}}">
              <div class="col-12" style="margin-bottom: 25px">
                <button class="btn btn-warning" type="submit">Paso Anterior</button>
              </div>
            </form>
          </center>

          @endif

        @break

      @case(12)

      <div class="margen" style="display: flex">
        <h1>Paso {{ Session::get('Paso') }} </h1>

        <form method="POST" action="/MostrarOPasos">
          @csrf
          <input type="hidden" value="{{$id}}" name="id" required>
          <input type="hidden" value="12" name="Paso" required>
        <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
        </form>

        <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
      </div>   

      <h1>Confirmacion del del envio de la factura por correo</h1>

      @php
      $Bandera = 0; 
      @endphp
      
      @if(!empty($Imagenes))
      @foreach ($Imagenes as $Archivo)
      
      @if($Archivo->Paso == 12)

      @php
      $Bandera++; 
      @endphp       

      @endif

      @endforeach
      @endif

      @if($Bandera == 0)

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
        
          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

          <input type="hidden" value="12" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

          <input type="hidden" value="12" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

          <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

          <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
  
      <center>
        <div class="col-12" style="margin-bottom: 25px">
          <button class="btn btn-primary" type="submit">Agregar</button>
        </div>
      </center>       
    </form>

    @if(Session::get('Rol') == 0)
    <center>
      <div style="padding-bottom: 30px;">
      <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
        @csrf
        <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
        <input type="hidden" value="12" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
        <button type="submit" class="btn btn-primary">Saltar Paso</button>
        </form>
      </div>
    </center>  
    @endif

    <center>
      <form method="GET" action="/Regresar/{{$id}}">
        <div class="col-12" style="margin-bottom: 25px">
          <button class="btn btn-warning" type="submit">Paso Anterior</button>
        </div>
      </form>
    </center>

    @endif
  
    <div class="display">

    @foreach ($Imagenes as $Archivo)

    @if($Archivo->Paso == 12)

    @if(in_array($Archivo->extension, ['jpg', 'jpeg', 'png', 'gif']))
        <!-- Mostrar imagen -->
        <img src="{{ $Archivo->url }}" alt="Imagen" width="60%">
    @else
        
    @if(in_array($Archivo->extension, ['pdf']))
        <embed src="{{ $Archivo->url }}" width="60% " height="600px" />
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

          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

          <input type="hidden" value="12" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

          <input type="hidden" value="12" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

          <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

          <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
          <button type="submit" class="btn btn-primary">Cambiar</button>
        </form>

        <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
        @csrf
        <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
        <input type="hidden" value="12" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
        <button type="submit" class="btn btn-primary">Validar</button>
        </form>
      </center>      
    </div>

    @endif
    @endforeach

    </div>
      
      @break

      @case(13)

      <div class="margen" style="display: flex">
        <h1>Paso {{ Session::get('Paso') }} </h1>

        <form method="POST" action="/MostrarOPasos">
          @csrf
          <input type="hidden" value="{{$id}}" name="id" required>
          <input type="hidden" value="13" name="Paso" required>
        <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
        </form>

        <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
      </div>   

      <h1>Autorización de la factura</h1>

      @php
      $Bandera = 0; 
      @endphp
      
      @if(!empty($Imagenes))
      @foreach ($Imagenes as $Archivo)
      
      @if($Archivo->Paso == 13)

      @php
      $Bandera++; 
      @endphp       

      @endif

      @endforeach
      @endif

      @if($Bandera == 0)


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
        
          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

          <input type="hidden" value="13" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

          <input type="hidden" value="13" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

          <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

          <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
  
  
      <center>
        <div class="col-12" style="margin-bottom: 25px">
          <button class="btn btn-primary" type="submit">Agregar</button>
        </div>
      </center>       
    </form>

    @if(Session::get('Rol') == 0)
    <center>
      <div style="padding-bottom: 30px;">
      <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
        @csrf
        <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
        <input type="hidden" value="13" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
        <button type="submit" class="btn btn-primary">Saltar Paso</button>
        </form>
      </div>
    </center>  
    @endif

    <center>
      <form method="GET" action="/Regresar/{{$id}}">
        <div class="col-12" style="margin-bottom: 25px">
          <button class="btn btn-warning" type="submit">Paso Anterior</button>
        </div>
      </form>
    </center>

    @endif
  
    <div class="display">

    @foreach ($Imagenes as $Archivo)

    @if($Archivo->Paso == 13)

    @if(in_array($Archivo->extension, ['jpg', 'jpeg', 'png', 'gif']))
        <!-- Mostrar imagen -->
        <img src="{{ $Archivo->url }}" alt="Imagen" width="60%">
    @else
        
    @if(in_array($Archivo->extension, ['pdf']))
        <embed src="{{ $Archivo->url }}" width="60% " height="600px" />
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

          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

          <input type="hidden" value="13" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

          <input type="hidden" value="13" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

          <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

          <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
  
          <button type="submit" class="btn btn-primary">Cambiar</button>
        </form>

        <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
        @csrf
        <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
        <input type="hidden" value="13" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
        <button type="submit" class="btn btn-primary">Validar</button>
        </form>
      </center>      
    </div>

    @endif
    @endforeach

    </div>
      
      @break

      @case(14)

      <div class="margen" style="display: flex">
        <h1>Paso {{ Session::get('Paso') }} </h1>

        <form method="POST" action="/MostrarOPasos">
          @csrf
          <input type="hidden" value="{{$id}}" name="id" required>
          <input type="hidden" value="14" name="Paso" required>
        <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
        </form>

        <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
      </div>    

      <h1>Reporte del servicio</h1>

      @php
      $Bandera = 0; 
      @endphp
      
      @if(!empty($Imagenes))
      @foreach ($Imagenes as $Archivo)
      
      @if($Archivo->Paso == 14)

      @php
      $Bandera++; 
      @endphp       

      @endif

      @endforeach
      @endif

      @if($Bandera == 0)

      <form method="POST" action="/Imagen" enctype="multipart/form-data">
        @csrf
        @method("POST")

      <div class="col-md-12" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label">Archivo</label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
        </div>
      </div>
        
          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

          <input type="hidden" value="14" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

          <input type="hidden" value="Reporte" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

          <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

          <input type="hidden" value="Archivos" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
  
      <center>
        <div class="col-12" style="margin-bottom: 25px">
          <button class="btn btn-primary" type="submit">Agregar</button>
        </div>
      </center>       
    </form>

    @if(Session::get('Rol') == 0)
    <center>
      <div style="padding-bottom: 30px;">
      <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
        @csrf
        <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
        <input type="hidden" value="14" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
        <button type="submit" class="btn btn-primary">Saltar Paso</button>
      </form>
      </div>
    </center>  
    @endif

    <center>
      <form method="GET" action="/Regresar/{{$id}}">
        <div class="col-12" style="margin-bottom: 25px">
          <button class="btn btn-warning" type="submit">Paso Anterior</button>
        </div>
      </form>
    </center>

    @endif
  
    <div class="display">

    @foreach ($Imagenes as $Archivo)

    @if($Archivo->Paso == 14)

    @if(in_array($Archivo->extension, ['jpg', 'jpeg', 'png', 'gif']))
        <!-- Mostrar imagen -->
        <img src="{{ $Archivo->url }}" alt="Imagen" width="60%">
    @else
        
    @if(in_array($Archivo->extension, ['pdf']))
        <embed src="{{ $Archivo->url }}" width="60% " height="600px" />
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

          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

          <input type="hidden" value="14" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

          <input type="hidden" value="Reporte" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

          <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

          <input type="hidden" value="Archivos" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
  
          <button type="submit" class="btn btn-primary">Cambiar</button>
        </form>

        <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
        @csrf
        <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
        <input type="hidden" value="14" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
        <button type="submit" class="btn btn-primary">Validar</button>
        </form>
      </center>      
    </div>

    @endif
    @endforeach

    </div>
      
      @break

      @case(15)

      <div class="margen" style="display: flex">
        <h1>Paso {{ Session::get('Paso') }} </h1>

        <form method="POST" action="/MostrarOPasos">
          @csrf
          <input type="hidden" value="{{$id}}" name="id" required>
          <input type="hidden" value="15" name="Paso" required>
        <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
        </form>

        <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
      </div>   

      <h1>Comprobante de pago final</h1>

      @php
      $Bandera = 0; 
      @endphp
      
      @if(!empty($Imagenes))
      @foreach ($Imagenes as $Archivo)
      
      @if($Archivo->Paso == 15)

      @php
      $Bandera++; 
      @endphp       

      @endif

      @endforeach
      @endif

      @if($Bandera == 0)

      <form method="POST" action="/Imagen" enctype="multipart/form-data">
        @csrf
        @method("POST")

      <div class="col-md-12" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label">Comprobante del pago</label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
        </div>
      </div>
        
          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

          <input type="hidden" value="15" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

          <input type="hidden" value="Pago" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

          <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

          <input type="hidden" value="Pago" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
  
  
      <center>
        <div class="col-12" style="margin-bottom: 25px">
          <button class="btn btn-primary" type="submit">Agregar</button>
        </div>
      </center>       
    </form>

    @if(Session::get('Rol') == 0)
    <center>
      <div style="padding-bottom: 30px;">
      <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
        @csrf
        <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
        <input type="hidden" value="15" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
        <button type="submit" class="btn btn-primary">Saltar Paso</button>
      </form>
      </div>
    </center>  
    @endif

    <center>
      <form method="GET" action="/Regresar/{{$id}}">
        <div class="col-12" style="margin-bottom: 25px">
          <button class="btn btn-warning" type="submit">Paso Anterior</button>
        </div>
      </form>
    </center>

    @endif
  
    <div class="display">

    @foreach ($Imagenes as $Archivo)

    @if($Archivo->Paso == 15)

    @if(in_array($Archivo->extension, ['jpg', 'jpeg', 'png', 'gif']))
        <!-- Mostrar imagen -->
        <img src="{{ $Archivo->url }}" alt="Imagen" width="60%">
    @else
        
    @if(in_array($Archivo->extension, ['pdf']))
        <embed src="{{ $Archivo->url }}" width="60% " height="600px" />
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

          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

          <input type="hidden" value="15" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

          <input type="hidden" value="Pago" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

          <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

          <input type="hidden" value="Pago" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
  
          <button type="submit" class="btn btn-primary">Cambiar</button>
        </form>


        <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
        @csrf
        <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
        <input type="hidden" value="15" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
        <button type="submit" class="btn btn-primary">Validar</button>
        </form>
      </center>      
    </div>

    @endif
    @endforeach

    </div>
      
      @break

      @case(16)

      <div class="margen" style="display: flex">
        <h1>Paso {{ Session::get('Paso') }} </h1>

        <form method="POST" action="/MostrarOPasos">
          @csrf
          <input type="hidden" value="{{$id}}" name="id" required>
          <input type="hidden" value="16" name="Paso" required>
        <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
        </form>

        <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
      </div>   

      <h1>Subir factura</h1>

      @php
      $Bandera = 0; 
      @endphp
      
      @if(!empty($Imagenes))
      @foreach ($Imagenes as $Archivo)
      
      @if($Archivo->Paso == 16)

      @php
      $Bandera++; 
      @endphp       

      @endif

      @endforeach
      @endif

      @if($Bandera == 0)

      <form method="POST" action="/Imagen" enctype="multipart/form-data">
        @csrf
        @method("POST")

      <div class="col-md-12" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label">Archivo</label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
        </div>
      </div>
        
          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

          <input type="hidden" value="16" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

          <input type="hidden" value="Factura" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

          <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

          <input type="hidden" value="Factura" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
  
  
      <center>
        <div class="col-12" style="margin-bottom: 25px">
          <button class="btn btn-primary" type="submit">Agregar</button>
        </div>
      </center>       
    </form>

    @if(Session::get('Rol') == 0)
    <center>
      <div style="padding-bottom: 30px;">
      <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
        @csrf
        <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
        <input type="hidden" value="16" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
        <button type="submit" class="btn btn-primary">Saltar Paso</button>
        </form>
      </div>
    </center>  
    @endif

    <center>
      <form method="GET" action="/Regresar/{{$id}}">
        <div class="col-12" style="margin-bottom: 25px">
          <button class="btn btn-warning" type="submit">Paso Anterior</button>
        </div>
      </form>
    </center>

    @endif
  
    <div class="display">

    @foreach ($Imagenes as $Archivo)

    @if($Archivo->Paso == 16)

    @if(in_array($Archivo->extension, ['jpg', 'jpeg', 'png', 'gif']))
        <!-- Mostrar imagen -->
        <img src="{{ $Archivo->url }}" alt="Imagen" width="60%">
    @else
        
    @if(in_array($Archivo->extension, ['pdf']))
        <embed src="{{ $Archivo->url }}" width="60% " height="600px" />
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

          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

          <input type="hidden" value="16" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

          <input type="hidden" value="Factura" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

          <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

          <input type="hidden" value="Factura" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
  
          <button type="submit" class="btn btn-primary">Cambiar</button>
        </form>

        <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
        @csrf
        <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
        <input type="hidden" value="16" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
        <button type="submit" class="btn btn-primary">Validar</button>
        </form>
      </center>      
    </div>

    @endif
    @endforeach

    </div>
      
      @break

      @case(17)

      <div class="margen" style="display: flex">
        <h1>Paso {{ Session::get('Paso') }} </h1>

        <form method="POST" action="/MostrarOPasos">
          @csrf
          <input type="hidden" value="{{$id}}" name="id" required>
          <input type="hidden" value="17" name="Paso" required>
        <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
        </form>

        <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
      </div>    
          
          @if( Session::get('Rol') == 0)
              <h1>Valida el progreso</h1>

              <center>
                <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-bottom: 50px; margin-top: 50px">
                  @csrf
                  <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
                  <input type="hidden" value="17" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
                  <button type="submit" class="btn btn-primary">Validar</button>
                  </form>
              </center>      

              <center>
                <form method="GET" action="/Regresar/{{$id}}">
                  <div class="col-12" style="margin-bottom: 25px">
                    <button class="btn btn-warning" type="submit">Paso Anterior</button>
                  </div>
                </form>
              </center>
              
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
                    <!-- Contenido específico del paso 1 -->
                    @break
                @case(2)
                    <h1>{{ $paso2 }}</h1>
                    <!-- Contenido específico del paso 2 -->
                    @break
                @case(3)
                    <h1>{{ $paso3 }}</h1>
                    <!-- Contenido específico del paso 3 -->
                    @break
                @case(4)
                    <h1>{{ $paso4 }}</h1>
                    <!-- Contenido específico del paso 4 -->
                    @break
                @case(5)
                    <h1>{{ $paso5 }}</h1>
                    <!-- Contenido específico del paso 5 -->
                    @break
                @case(6)
                    <h1>{{ $paso6 }}</h1>
                    <!-- Contenido específico del paso 6 -->
                    @break
                @case(7)
                    <h1>{{ $paso7 }}</h1>
                    <!-- Contenido específico del paso 7 -->
                    @break
                @case(8)
                    <h1>{{ $paso8 }}</h1>
                    <!-- Contenido específico del paso 8 -->
                    @break
                @case(9)
                    <h1>{{ $paso9 }}</h1>
                    <!-- Contenido específico del paso 9 -->
                    @break
                @case(10)
                    <h1>{{ $paso10 }}</h1>
                    <!-- Contenido específico del paso 10 -->
                    @break
                @case(11)
                    <h1>{{ $paso11 }}</h1>
                    <!-- Contenido específico del paso 11 -->
                    @break
                @case(12)
                    <h1>{{ $paso12 }}</h1>
                    <!-- Contenido específico del paso 12 -->
                    @break
                @case(13)
                    <h1>{{ $paso13 }}</h1>
                    <!-- Contenido específico del paso 13 -->
                    @break
                @case(14)
                    <h1>{{ $paso14 }}</h1>
                    <!-- Contenido específico del paso 14 -->
                    @break
                @case(15)
                    <h1>{{ $paso15 }}</h1>
                    <!-- Contenido específico del paso 15 -->
                    @break
                @case(16)
                    <h1>{{ $paso16 }}</h1>
                    <!-- Contenido específico del paso 16 -->
                    @break
                @case(17)
                    <h1>{{ $paso17 }}</h1>
                    <!-- Contenido específico del paso 17 -->
                    @break
                @case(18)
                    <h1>{{ $paso18 }}</h1>
                    <!-- Contenido específico del paso 18 -->
                    @break
                @case(19)
                    <h1>{{ $paso19 }}</h1>
                    <!-- Contenido específico del paso 19 -->
                    @break
                @case(20)
                    <h1>{{ $paso20 }}</h1>
                    <!-- Contenido específico del paso 20 -->
                    @break
                @case(21)
                    <h1>{{ $paso21 }}</h1>
                    <!-- Contenido específico del paso 21 -->
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
          
          @else
              
          <h1>Espera a que validen el progreso</h1>

          <center>
            <form method="GET" action="/Regresar/{{$id}}">
              <div class="col-12" style="margin-bottom: 25px">
                <button class="btn btn-warning" type="submit">Paso Anterior</button>
              </div>
            </form>
          </center>

          @endif

        @break

        @case(18)

        <div class="margen" style="display: flex">
          <h1>Paso {{ Session::get('Paso') }} </h1>

          <form method="POST" action="/MostrarOPasos">
            @csrf
            <input type="hidden" value="{{$id}}" name="id" required>
            <input type="hidden" value="18" name="Paso" required>
          <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
          </form>

          <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
        </div>   
  
        <h1>Cerrar el proyecto</h1>
        
        @php
        $Bandera = 0; 
        @endphp
        
        @if(!empty($Imagenes))
        @foreach ($Imagenes as $Archivo)
        
        @if($Archivo->Paso == 18)

        @php
        $Bandera++; 
        @endphp       

        @endif

        @endforeach
        @endif

        @if($Bandera == 0)
  
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
          
            <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

            <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>
  
            <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">

            <input type="hidden" value="18" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>
  
            <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>
    

        <center>
          <div class="col-12" style="margin-bottom: 25px">
            <button class="btn btn-primary" type="submit">Agregar</button>
          </div>
        </center>       
      </form>

      @if(Session::get('Rol') == 0)
      <center>
        <div style="padding-bottom: 30px;">
        <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px;">
          @csrf
          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
          <input type="hidden" value="18" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
          <button type="submit" class="btn btn-primary">Saltar Paso</button>
          </form>
        </div>
      </center>  
      @endif

      <center>
        <form method="GET" action="/Regresar/{{$id}}">
          <div class="col-12" style="margin-bottom: 25px">
            <button class="btn btn-warning" type="submit">Paso Anterior</button>
          </div>
        </form>
      </center>

      @endif
  
      <div class="display">
  
      @foreach ($Imagenes as $Archivo)
  
      @if($Archivo->Paso == 18)
  
      @if(in_array($Archivo->extension, ['jpg', 'jpeg', 'png', 'gif']))
          <!-- Mostrar imagen -->
          <img src="{{ $Archivo->url }}" alt="Imagen" width="60%">
      @else
          
      @if(in_array($Archivo->extension, ['pdf']))
          <embed src="{{ $Archivo->url }}" width="60% " height="600px" />
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
  
            <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

            <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>
  
            <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">

            <input type="hidden" value="18" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>
  
            <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>
    
            <button type="submit" class="btn btn-primary">Cambiar</button>
          </form>

          <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px;">
          @csrf
          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
          <input type="hidden" value="18" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
          <button type="submit" class="btn btn-primary">Validar</button>
          </form>
        </center>      
      </div>
  
      @endif
      @endforeach
  
      </div>
        
        
        @break

        @case(19)

        <div class="margen" style="display: flex">
          <h1>Paso {{ Session::get('Paso') }} </h1>

          <form method="POST" action="/MostrarOPasos">
            @csrf
            <input type="hidden" value="{{$id}}" name="id" required>
            <input type="hidden" value="19" name="Paso" required>
          <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
          </form>

          <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
        </div>   
  
        <h1>Respaldar grupo de whatsApp</h1>
  
        <form method="POST" action="/Historico" enctype="multipart/form-data">
          @csrf
          @method("POST")
  
        <div class="col-md-12" style="margin-bottom: 30px">
          <label for="validationCustomUsername" class="form-label">Diversos archivos</label>
          <div class="input-group has-validation">
            <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
          </div>
        </div>
          
            <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>
  
            <input type="hidden" value="19" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

            <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>
  
            <input type="hidden" value="Historico" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
    
        <center>
          <div class="col-12" style="margin-bottom: 20px">
            <button class="btn btn-primary" type="submit">Agregar</button>
          </div>
        </center>       
      </form>

      <center>
        <form method="POST" action="/Validar" enctype="multipart/form-data">
          @csrf
          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
          <input type="hidden" value="19" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
          <button type="submit" class="btn btn-primary">Avanzar</button>
          </form>
      </center>

      <center>
        <form method="GET" action="/Regresar/{{$id}}">
          <div class="col-12" style="margin-bottom: 25px; margin-top: 20px">
            <button class="btn btn-warning" type="submit">Paso Anterior</button>
          </div>
        </form>
      </center>

      @foreach ($Imagenes as $Archivo)

      @if($Archivo->Paso == 19)

      <div class="display">

      @if(in_array($Archivo->extension, ['jpg', 'jpeg', 'png', 'gif']))
          <!-- Mostrar imagen -->
          <img src="{{ $Archivo->url }}" alt="Imagen" width="60%" height="">
      @else
          
      @if(in_array($Archivo->extension, ['pdf']))
      <center>
          <embed src="{{ $Archivo->url }}" width="60% " height="600px" />
      </center>
      @else
      <a>Archivo no compatible  para visualizarlo</a>
      <a href="{{ $Archivo->url }}" target="_blank">Descargar</a>
      @endif
      @endif

      <div class="ValidarDivB" style="width: 38%; position: relative; left: 50px;" > 
        <center>
          <form method="GET" action="/EliminarImagen/{{$Archivo->id}}">
            @csrf
          <button class="btn btn-danger"> Eliminar </button>
          </form>
        </center>      
      </div>
    </div>

      @endif
  @endforeach
        
        @break
  
        @case(20)

        <div class="margen" style="display: flex">
          <h1>Paso {{ Session::get('Paso') }} </h1>

          <form method="POST" action="/MostrarOPasos">
            @csrf
            <input type="hidden" value="{{$id}}" name="id" required>
            <input type="hidden" value="20" name="Paso" required>
          <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
          </form>

          <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
        </div>   
        
        <h1>Notificar que la informacion esta respaldada</h1>

            @php
        $Bandera = 0; 
        @endphp
        
        @if(!empty($Imagenes))
        @foreach ($Imagenes as $Archivo)
        
        @if($Archivo->Paso == 20)

        @php
        $Bandera++; 
        @endphp       

        @endif

        @endforeach
        @endif

        @if($Bandera == 0)
  
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

        <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

        <input type="hidden" value="20" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

        <input type="hidden" value="20" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

        <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>

        <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">

          
        <center>
          <div class="col-12" style="margin-bottom: 25px">
            <button class="btn btn-primary" type="submit">Agregar</button>
          </div>
        </center>       
      </form>

      @if(Session::get('Rol') == 0)
      <center>
        <div style="padding-bottom: 30px;">
          <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 10px">
          @csrf
          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
          <input type="hidden" value="20" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
          <button type="submit" class="btn btn-primary">Saltar Paso</button>
          </form>
        </div>
      </center>  
      @endif

      <center>
        <form method="GET" action="/Regresar/{{$id}}">
          <div class="col-12" style="margin-bottom: 25px">
            <button class="btn btn-warning" type="submit">Paso Anterior</button>
          </div>
        </form>
      </center>

      @endif
  
      <div class="display">
  
      @foreach ($Imagenes as $Archivo)
  
      @if($Archivo->Paso == 20)
  
      @if(in_array($Archivo->extension, ['jpg', 'jpeg', 'png', 'gif']))
          <!-- Mostrar imagen -->
          <img src="{{ $Archivo->url }}" alt="Imagen" width="60%">
      @else
          
      @if(in_array($Archivo->extension, ['pdf']))
          <embed src="{{ $Archivo->url }}" width="60% " height="600px" />
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
  
            <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

            <input type="hidden" value="20" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

            <input type="hidden" value="20" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>

            <input type="hidden" value="{{$Servicio->Proyecto}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Proyecto" required>
  
            <input type="hidden" value="Imagenes" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="Tipo">
    
            <button type="submit" class="btn btn-primary">Cambiar</button>
          </form>


          <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 10px">
          @csrf
          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
          <input type="hidden" value="20" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
          <button type="submit" class="btn btn-primary">Validar</button>
          </form>
        </center>      
      </div>
  
      @endif
      @endforeach
  
      </div>
        
        @break

        @case(21)

        <div class="margen">
          <h1>Paso {{ Session::get('Paso') }} </h1>

          <div style="position: relative; top: -50px; left: 60px;">
          <form method="POST" action="/MostrarOPasos">
            @csrf
            <input type="hidden" value="{{$id}}" name="id" required>
            <input type="hidden" value="21" name="Paso" required>
          <a class="botonPasos"><button class="btn btn-info" type="submit">Paso</button></a>
          </form>

          <a class="botonArchivos" href="/Archivos/{{$id}}"><button class="btn btn-info"> Archivos </button></a>
          </div>
        </div>  
  
        <h1>Agregar una G al final del grupo de whatsApp y mandar la ruta de lo almacenado</h1>

        @php
        $Bandera = 0; 
        @endphp
        
        @if(!empty($Imagenes))
        @foreach ($Imagenes as $Archivo)
        
        @if($Archivo->Paso == 21)

        @php
        $Bandera++; 
        @endphp       

        @endif

        @endforeach
        @endif

        @if($Bandera == 0)
  
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
          
            <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>
    
        <center>
          <div class="col-12" style="margin-bottom: 25px">
            <button class="btn btn-primary" type="submit">Agregar</button>
          </div>
        </center>       
      </form>

      @if(Session::get('Rol') == 0)
      <center>
        <div style="padding-bottom: 30px;">
          <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
          @csrf
          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
          <input type="hidden" value="21" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
          <button type="submit" class="btn btn-primary">Validar</button>
          </form>
        </div>
      </center>  
      @endif

      <center>
        <form method="GET" action="/Regresar/{{$id}}">
          <div class="col-12" style="margin-bottom: 25px">
            <button class="btn btn-warning" type="submit">Paso Anterior</button>
          </div>
        </form>
      </center>

      @endif
  
      <div class="display">
  
      @foreach ($Imagenes as $Archivo)
  
      @if($Archivo->Paso == 21)
  
      @if(in_array($Archivo->extension, ['jpg', 'jpeg', 'png', 'gif']))
          <!-- Mostrar imagen -->
          <img src="{{ $Archivo->url }}" alt="Imagen" width="60%">
      @else
          
      @if(in_array($Archivo->extension, ['pdf']))
          <embed src="{{ $Archivo->url }}" width="60% " height="600px" />
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

          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" accept="image/*"required>

          <input type="hidden" value="21" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Paso" required>

          <input type="hidden" value="21" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Nombre" required>
          
          <button type="submit" class="btn btn-primary">Cambiar</button>
        </form>

          <form method="POST" action="/Validar" enctype="multipart/form-data" style="margin-top: 20px">
          @csrf
          <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend"  name="id" required>
          <input type="hidden" value="21" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Paso" required>
          <button type="submit" class="btn btn-primary">Validar</button>
          </form>
        </center>      
      </div>
  
      @endif
      @endforeach
      </div>
        @break

      @default
          <h1>Acción no reconocida</h1>
          <p>No se ha reconocido la acción solicitada.</p>
  @endswitch

  @if(session('success'))
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
              title: 'Éxito',
              text: '{{ session('success') }}',
              icon: 'success',
              confirmButtonText: 'OK'
          }).then((result) => {
          });
      });
  </script>
@endif


    </div>

    </div> <!-- fin del cuerpo con margenes -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('Todo.js') }}"></script>

    <script>
      document.getElementById('submitCredito').addEventListener('click', function() {
          Swal.fire({
              title: '¿Estás seguro?',
              text: "¡Al usar este botón el pago del cliente iniciará a 0!",
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
              text: "¡Al usar este botón el pago del cliente  iniciará a 0!",
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