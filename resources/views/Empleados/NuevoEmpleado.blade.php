<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- <link href="{{ asset('Todo.css') }}" rel="stylesheet">  --}}
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
    <h1>Nuevo Empleado</h1>
    </div>

    <form class="row g-3 needs-validation" method="POST" action="/Empleados" enctype="multipart/form-data">
      @csrf
      @method("POST")

      <div class="col-md-4">
          <label for="validationCustom01" class="form-label">Nombres</label>
          <input type="text" class="form-control @error('Nombres') is-invalid @enderror" id="validationCustom01" value="{{ old('Nombres') }}" name="Nombres" required>
          @error('Nombres')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
      </div>

      <div class="col-md-4">
          <label for="validationCustom01" class="form-label">Apellidos</label>
          <input type="text" class="form-control @error('Apellidos') is-invalid @enderror" id="validationCustom01" value="{{ old('Apellidos') }}" name="Apellidos" required>
          @error('Apellidos')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
      </div>

      <div class="col-md-4">
          <label for="validationCustom01" class="form-label">Puesto</label>
          <input type="text" class="form-control @error('Puesto') is-invalid @enderror" id="validationCustom01" value="{{ old('Puesto') }}" name="Puesto" required>
          @error('Puesto')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
      </div>

      <div class="col-md-4">
          <label for="validationCustom01" class="form-label">Direccion</label>
          <input type="text" class="form-control @error('Direccion') is-invalid @enderror" id="validationCustom01" value="{{ old('Direccion') }}" name="Direccion" required>
          @error('Direccion')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
      </div>

      <div class="col-md-4">
          <label for="validationCustomUsername" class="form-label">Telefono</label>
          <div class="input-group has-validation">
              <input type="text" class="form-control @error('Telefono') is-invalid @enderror" value="{{ old('Telefono') }}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="Telefono" required>
              @error('Telefono')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          </div>
      </div>

      <div class="col-md-4">
          <label for="validationCustom02" class="form-label">Correo</label>
          <input type="text" class="form-control @error('Correo') is-invalid @enderror" id="validationCustom02" value="{{ old('Correo') }}" name="Correo" required>
          @error('Correo')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
      </div>

      <div class="col-md-4">
          <label for="validationCustom02" class="form-label">RFC</label>
          <input type="text" class="form-control @error('RFC') is-invalid @enderror" id="validationCustom02" value="{{ old('RFC') }}" name="RFC" required>
          @error('RFC')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
      </div>

      <div class="col-md-4">
          <label for="validationCustom02" class="form-label">CURP</label>
          <input type="text" class="form-control @error('CURP') is-invalid @enderror" id="validationCustom02" value="{{ old('CURP') }}" name="CURP" required>
          @error('CURP')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
      </div>

      <div class="col-md-4">
          <label for="validationCustom02" class="form-label">Contraseña</label>
          <input type="password" class="form-control @error('Contraseña') is-invalid @enderror" id="validationCustom02" name="Contraseña" required>
          @error('Contraseña')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
      </div>
<center>
      <div class="col-md-6">
        <label for="Tipo" class="form-label">Tipo de empleado</label>
        <select class="form-control @error('Tipo') is-invalid @enderror" id="Tipo" name="Rol" required>
            <option value="1">Empleado</option>
            <option value="0">Administrador</option>
        </select>
    </div>
</center>

      <center>
          <div class="col-12" style="margin-bottom: 50px">
              <button class="btn btn-primary" type="submit">Agregar</button>
          </div>
      </center>
  </form>
    </div> <!-- fin del cuerpo con margenes -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('Todo.js') }}"></script>

</body>
</html>