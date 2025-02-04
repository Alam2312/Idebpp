<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('Todo.css') }}" rel="stylesheet">
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
    <h1>Editar Empleado</h1>
    </div>

    <form class="row g-3 needs-validation" method="POST" action="/Empleados/{{$Empleado->id}}" enctype="multipart/form-data" novalidate>
      @csrf
      @method("PUT")
  
      <div class="col-md-4">
          <label for="validationCustom01" class="form-label">Nombres</label>
          <input type="text" class="form-control @error('Nombres') is-invalid @enderror" id="validationCustom01" value="{{ old('Nombres', $Empleado->Nombres) }}" name="Nombres" required>
          <div class="invalid-feedback">
              @error('Nombres') {{ $message }} @enderror
          </div>
      </div>
  
      <div class="col-md-4">
          <label for="validationCustom01" class="form-label">Apellidos</label>
          <input type="text" class="form-control @error('Apellidos') is-invalid @enderror" id="validationCustom01" value="{{ old('Apellidos', $Empleado->Apellidos) }}" name="Apellidos" required>
          <div class="invalid-feedback">
              @error('Apellidos') {{ $message }} @enderror
          </div>
      </div>
  
      <div class="col-md-4">
          <label for="validationCustom01" class="form-label">Puesto</label>
          <input type="text" class="form-control @error('Puesto') is-invalid @enderror" id="validationCustom01" value="{{ old('Puesto', $Empleado->Puesto) }}" name="Puesto" required>
          <div class="invalid-feedback">
              @error('Puesto') {{ $message }} @enderror
          </div>
      </div>
  
      <div class="col-md-4">
          <label for="validationCustom01" class="form-label">Direccion</label>
          <input type="text" class="form-control @error('Direccion') is-invalid @enderror" id="validationCustom01" value="{{ old('Direccion', $Empleado->Direccion) }}" name="Direccion" required>
          <div class="invalid-feedback">
              @error('Direccion') {{ $message }} @enderror
          </div>
      </div>

      <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Correo</label>
        <input type="text" class="form-control @error('Correo') is-invalid @enderror" id="validationCustom01" value="{{ old('Correo', $Empleado->Correo) }}" name="Correo" required>
        <div class="invalid-feedback">
            @error('Correo') {{ $message }} @enderror
        </div>
    </div>
  
      <div class="col-md-4">
          <label for="validationCustomUsername" class="form-label">Telefono</label>
          <div class="input-group has-validation">
              <input type="text" class="form-control @error('Telefono') is-invalid @enderror" value="{{ old('Telefono', $Empleado->Telefono) }}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Telefono" required>
              <div class="invalid-feedback">
                  @error('Telefono') {{ $message }} @enderror
              </div>
          </div>
      </div>
  
      <div class="col-md-6">
          <label for="validationCustom02" class="form-label">RFC</label>
          <input type="text" class="form-control @error('RFC') is-invalid @enderror" value="{{ old('RFC', $Empleado->RFC) }}" id="validationCustom02" name="RFC" required>
          <div class="invalid-feedback">
              @error('RFC') {{ $message }} @enderror
          </div>
      </div>     
  
      <div class="col-md-6">
          <label for="validationCustom02" class="form-label">CURP</label>
          <input type="text" class="form-control @error('CURP') is-invalid @enderror" value="{{ old('CURP', $Empleado->CURP) }}" id="validationCustom02" name="CURP" required>
          <div class="invalid-feedback">
              @error('CURP') {{ $message }} @enderror
          </div>
      </div>         


        <input  class="form-control @error('Rol') is-invalid @enderror" value="{{ old('Rol', $Empleado->Rol) }}" id="validationCustom02" name="Rol" type="hidden">
 
</center>
  
      <center>
          <div class="col-12" style="margin-bottom: 50px">
              <button class="btn btn-primary" type="submit">Editar</button>
          </div>
      </center>
  </form>
    </div> <!-- fin del cuerpo con margenes -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('Todo.js') }}"></script>

</body>
</html>