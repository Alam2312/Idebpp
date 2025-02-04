<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="Todo.css" rel="stylesheet">

</head>
<body>

  <div class="header" style="display: flex;color: white;">
    <div>
      <img src="{{ asset('imagenes/logoBlanco.png') }}"  class="logoBlanco">
      <a style="font-weight: bold;" href="/Desloguearse" class="Links">Salir</a>
       <a style="font-weight: bold;" href="/Inicio" class="Links">Inicio</a>
      <a style="font-weight: bold;" class="Links" href="/Usuario" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Usuario</a>
    </div>
    </div>
      
      <div class="cuerpo">
  
      <div class="margen">
      <h1>Elige una ruta para guardar tus archivos</h1>
      </div>

      @if(!empty($Rutas))
        @foreach($Rutas as $Ruta)
           @if( $Ruta->id == Session::get('Almacenamiento'))
           <div class="col-md-12">
            <label for="Tipo" class="form-label">Ruta Activa</label>
            <input class="form-control" id="Ruta" name="Ruta" value="{{$Ruta->Ruta}}" disabled>
        </div>  
            @endif
        @endforeach




    <form class="row g-3 needs-validation" method="POST" action="/Actualizar">
        @csrf
            
            <div class="col-md-11">
              <label for="Tipo" class="form-label">Ruta</label>
              <select class="form-control" id="Ruta" name="Ruta" required>
                @foreach($Rutas as $Ruta)
                    <option value="{{ $Ruta->id }}">{{ $Ruta->Ruta }}</option>
                @endforeach
            </select>
          </div>
  
            <center>
          <div class="col-12">
            <button class="btn btn-primary" type="submit">Usar</button>
          </div>
            </center>
      </form>

      @else

      <h3>No tienes ninguna ruta registrada aun</h3>

     @endif
     
    </div> <!-- fin del cuerpo con margenes -->

    <div id="overlay">
      <div id="overlay-content">
          <div class="spinner-border text-primary" role="status">
              <span class="visually-hidden">Cargando...</span>
          </div>
      </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('Todo.js') }}"></script>
  
</body>
</html>