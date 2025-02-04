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
    <h1>Eliminar Empleado</h1>
    </div>

    <form class="row g-3 needs-validation" novalidate method="POST" action="/Empleados/{{$Empleado->id}}">
      @csrf
      @method("DELETE") 
      <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Nombres</label>
        <input type="text" class="form-control" id="validationCustom01" value="{{$Empleado->Nombres}}" name="Nombres" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>

      <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Apellidos</label>
        <input type="text" class="form-control" id="validationCustom01" value="{{$Empleado->Apellidos}}" name="Apellidos" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
      
      <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Puesto</label>
        <input type="text" class="form-control" id="validationCustom01" value="{{$Empleado->Puesto}}" name="Puesto" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
    
      <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Direccion</label>
        <input type="text" class="form-control" id="validationCustom01" value="{{$Empleado->Direccion}}" name="Direccion" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>

      <div class="col-md-4">
        <label for="validationCustomUsername" class="form-label">Telefono</label>
        <div class="input-group has-validation">
          <input type="text" class="form-control"value="{{$Empleado->Telefono}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Telefono" required>
          <div class="invalid-feedback">
            Please choose a username.
          </div>
        </div>
      </div>

        <div class="col-md-4">
          <label for="validationCustom02" class="form-label">Correo</label>
          <input type="text" class="form-control" id="validationCustom02" value="{{$Empleado->Correo}}" name="Correo" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>      

        <div class="col-md-4">
          <label for="validationCustom02" class="form-label">RFC</label>
          <input type="text" class="form-control" value="{{$Empleado->RFC}}" id="validationCustom02" name="RFC" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>     

        <div class="col-md-4">
          <label for="validationCustom02" class="form-label">CURP</label>
          <input type="text" class="form-control" value="{{$Empleado->CURP}}" id="validationCustom02" name="CURP" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>         

        <table class="table table-striped">
          <thead>
              <tr>
                <th scope="col">Confirmacion 1</th>
                <th scope="col">Confirmacion 2</th>
                <th scope="col">Confirmacion 3</th>
                <th scope="col">Borrar</th>
  
              </thead>
              <tbody>
                <tr>
                  <th scope="row">@if($Info->Confirmacion1 != 0)
                      <a>{{$Info->Confirmacion1}}</a>
                    @else
                    <a href="/VotarE/{{$Empleado->id}}">Confirmar</a>
                   @endif 
                  </th>
  
                  <th scope="row">@if($Info->Confirmacion2 != 0)
                    <a>{{$Info->Confirmacion2}}</a>
                  @else
                  <a href="/VotarE/{{$Empleado->id}}">Confirmar</a>
                 @endif 
                </th>
  
                <th scope="row">@if($Info->Confirmacion3 != 0)
                  <a>{{$Info->Confirmacion2}}</a>
                @else
                <a href="/VotarE/{{$Empleado->id}}">Confirmar</a>
               @endif 
              </th>
  
              <th>
            @if($Info->Confirmacion1 != 0 && $Info->Confirmacion2 != 0 && $Info->Confirmacion3 != 0)
          <div class="col-12">
            <button class="btn btn-danger" type="submit">Borrar</button>
          </div>
          @else
            <div class="col-12">
              <button class="btn btn-danger" style="filter: brightness(0.7);" disabled>Borrar</button>
            </div>
          @endif
              </th>

    </div> <!-- fin del cuerpo con margenes -->

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('Todo.js') }}"></script>

</body>
</html>