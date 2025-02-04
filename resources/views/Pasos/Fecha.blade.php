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
      </div>
      </div>
    
    <div class="cuerpo" style="margin-top: 70px;">

        <h1 style="margin-bottom: 25px;">Dale una nueva fecha vencimiento</h1>

        <form method="POST" action="/RehabilitarFecha">
          @csrf

             <div class="display">

            <div class="col-md-12" style="margin-bottom: 30px">
              <label for="validationCustomUsername" class="form-label">Fecha de Vencimiento</label>
              <div class="input-group has-validation">
                <input type="date" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Fecha" required>
              </div>
            </div>

          </div>
          
            <input type="hidden" value="{{$id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>
    
            <center>
              <div class="col-12" style="margin-bottom: 25px">
                <button class="btn btn-primary" type="submit">Agregar</button>
              </div>
            </center>   

        </form>




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

</body>
</html>