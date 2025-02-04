<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="Todo.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
      <h1>Ruta en la que se guardan tus archivos</h1>
      </div>

      @if(!empty($Rutas))
      @if(Session::get('Almacenamiento') != 0)
        @foreach($Rutas as $Ruta)
           @if( $Ruta->id == Session::get('Almacenamiento'))
           <div class="col-md-12">
            <label for="Tipo" class="form-label">Ruta</label>
            <input class="form-control" id="Ruta" name="Ruta" value="{{$Ruta->Ruta}}" disabled>
        </div>  
            @endif
        @endforeach

        @else
        <h3>Elige una ruta</h3>
        @endif

      @else

       <h3>No tienes ninguna ruta registrada aun</h3>

      @endif
    
    
            <div class="botonesAlm">

          <form class="row g-3 needs-validation" method="GET" action="Almacenamiento/create">
            @csrf
          <div>
           <a href=""><button class="btn btn-primary">Agregar</button></a>
          </div>
          </form>

          <form class="row g-3 needs-validation" method="GET" action="/Elegir">
          @csrf
          <div style="margin-left: 10px;">
            <a href=""><button class="btn btn-info">Elegir</button></a>
           </div>
          </form>

          @if(!empty($Rutas) || Session::get('Almacenamiento') == 0)

          <form id="deleteForm" class="row g-3 needs-validation" method="POST" action="/Almacenamiento/{{Session::get('Almacenamiento')}}">
            @csrf
            @method('DELETE')
           <div style="margin-left: 10px;">
            <button type="button" class="btn btn-danger" id="deleteButton">Eliminar</button>
           </div>
          </form>

          @endif

            </div>

            <script>
            document.getElementById('deleteButton').addEventListener('click', function(event) {
              event.preventDefault(); // Evita el envío del formulario inmediato
  
              Swal.fire({
                  title: '¿Estás seguro?',
                  text: 'Esta acción no se puede deshacer.',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Sí, eliminar',
                  cancelButtonText: 'Cancelar'
              }).then((result) => {
                  if (result.isConfirmed) {
                      document.getElementById('deleteForm').submit(); // Envía el formulario si el usuario confirma
                  }
              });
          });
          </script>

            @if(session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error',
                        html: '{{ session('error') }} <br> <b>Usa otra ruta</b>',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        // Aquí puedes agregar acciones adicionales si es necesario.
                    });
                });
            </script>
        @endif

                    {{-- @dd(session('error'))  --}}
     
      </form>
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