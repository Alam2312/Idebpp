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

    <form class="row g-3 needs-validation" method="POST" action="/Contraseña/{{Session::get('user_id')}}" enctype="multipart/form-data" novalidate>
      @csrf
      @method("PUT")
  
      <div class="col-md-6">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" class="form-control @error('Contraseña') is-invalid @enderror" id="password" name="Contraseña" required>
          <div class="invalid-feedback">
              @error('Contraseña') {{ $message }} @enderror
          </div>
      </div>
  
      <div class="col-md-6">
          <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
          <input type="password" class="form-control" id="password_confirmation" name="Contraseña_confirmation" required>
          <div class="invalid-feedback">
              @error('Contraseña_confirmation') {{ $message }} @enderror
          </div>
      </div>
  
      <center>
          <div class="col-12" style="margin-bottom: 50px">
              <button class="btn btn-primary" type="submit">Editar</button>
          </div>
      </center>
  </form>
  
  <script>
      // Bootstrap validation script
      (function () {
          'use strict'
  
          var forms = document.querySelectorAll('.needs-validation')
  
          Array.prototype.slice.call(forms)
              .forEach(function (form) {
                  form.addEventListener('submit', function (event) {
                      if (!form.checkValidity()) {
                          event.preventDefault()
                          event.stopPropagation()
                      }
  
                      form.classList.add('was-validated')
                  }, false)
              })
      })()
  </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('Todo.js') }}"></script>

</body>
</html>