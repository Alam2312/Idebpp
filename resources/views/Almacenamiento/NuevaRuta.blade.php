<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- <link href="{{ asset('Todo.css') }}" rel="stylesheet">  --}}
    <link href="{{ asset('Todo.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
    <h1>Agregar una ruta para guardar archivos</h1>
    </div>

    <form class="row g-3 needs-validation" method="POST" action="/Almacenamiento">
      @csrf
          
          <div class="col-md-12">
            <label for="Tipo" class="form-label">Ruta</label>
            <input type="text" class="form-control" id="validationCustom01" value="" name="Ruta" required>
        </div>

          <center>
        <div class="col-12">
          <button class="btn btn-primary" type="submit">Agregar</button>
        </div>
          </center>
    </form>

    </div> <!-- fin del cuerpo con margenes -->

    @if(session('mensaje'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('mensaje') }}',
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('Todo.js') }}"></script>

</body>
</html>