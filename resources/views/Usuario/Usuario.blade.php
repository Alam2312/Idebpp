<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('Todo.css') }}" rel="stylesheet">
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
    <h1>Usuario</h1>
    </div>

    <form class="row g-3 needs-validation" id="deleteForm" novalidate method="POST" action="/Usuario/{{$Usuario->id}}">
      @csrf
      @method("DELETE") 
      <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Nombres</label>
        <input type="text" class="form-control" id="validationCustom01" value="{{$Usuario->Nombres}}" name="Nombres" readonly>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>

      <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Apellidos</label>
        <input type="text" class="form-control" id="validationCustom01" value="{{$Usuario->Apellidos}}" name="Apellidos" readonly>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
      
      <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Puesto</label>
        <input type="text" class="form-control" id="validationCustom01" value="{{$Usuario->Puesto}}" name="Puesto" readonly>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
    
      <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Direccion</label>
        <input type="text" class="form-control" id="validationCustom01" value="{{$Usuario->Direccion}}" name="Direccion" readonly>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>

      <div class="col-md-4">
        <label for="validationCustomUsername" class="form-label">Telefono</label>
        <div class="input-group has-validation">
          <input type="text" class="form-control"value="{{$Usuario->Telefono}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Telefono" readonly>
          <div class="invalid-feedback">
            Please choose a username.
          </div>
        </div>
      </div>

        <div class="col-md-4">
          <label for="validationCustom02" class="form-label">Correo</label>
          <input type="text" class="form-control" id="validationCustom02" value="{{$Usuario->Correo}}" name="Correo" readonly>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>      

        <div class="col-md-6">
          <label for="validationCustom02" class="form-label">RFC</label>
          <input type="text" class="form-control" value="{{$Usuario->RFC}}" id="validationCustom02" name="RFC" readonly>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>     

        <div class="col-md-6">
          <label for="validationCustom02" class="form-label">CURP</label>
          <input type="text" class="form-control" value="{{$Usuario->CURP}}" id="validationCustom02" name="CURP" readonly>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>         

    </div> <!-- fin del cuerpo con margenes -->


    <center>
    @if($Usuario->id>1)
    <div class="col-12">
   <button type="button" style="margin-top: 20px" class="btn btn-danger" id="deleteButton">Eliminar</button>
    </div>
   @endif
  </form>
</center>

<center>
  <div style="margin-top: 20px" >
  <button class="btn btn-primary"><a style="color: white;text-decoration: none;" href="/Usuario/{{$Usuario->id}}/edit">Editar Credenciales</a></button>

  <button style="margin-left: 5px" class="btn btn-info"><a style="color: white;text-decoration: none;" href="/Usuario/{{$Usuario->id}}">Editar Contraseña</a></button>
  </div>
</center>
   </div>

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('Todo.js') }}"></script>



</body>
</html>