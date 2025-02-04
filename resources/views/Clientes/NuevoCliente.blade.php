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
    <h1>Nuevo Cliente</h1>
    </div>

    <form class="row g-3 needs-validation" method="POST" action="/Clientes" novalidate>
      @csrf
  
      <div class="col-md-6">
          <label for="validationCustom01" class="form-label">Nombre</label>
          <input type="text" class="form-control @error('Nombre') is-invalid @enderror" id="validationCustom01" value="{{ old('Nombre') }}" name="Nombre" required>
          @error('Nombre')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
      </div>
  
      <div class="col-md-6">
          <label for="validationCustomUsername" class="form-label">Telefono</label>
          <div class="input-group has-validation">
              <input type="text" class="form-control @error('Telefono') is-invalid @enderror" id="validationCustomUsername" value="{{ old('Telefono') }}" name="Telefono" aria-describedby="inputGroupPrepend" required>
              @error('Telefono')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          </div>
      </div>
  
      <div class="col-md-6">
          <label for="validationCustom02" class="form-label">Correo</label>
          <input type="email" class="form-control @error('Correo') is-invalid @enderror" id="validationCustom02" value="{{ old('Correo') }}" name="Correo" required>
          @error('Correo')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
      </div>
  
      <div class="col-md-6">
          <label for="Tipo" class="form-label">Tipo de persona ante el SAT</label>
          <select class="form-control @error('Tipo') is-invalid @enderror" id="Tipo" name="Tipo" required>
              <option value="">Selecciona...</option>
              <option value="Fisica" {{ old('Tipo') == 'Fisica' ? 'selected' : '' }}>Física</option>
              <option value="Moral" {{ old('Tipo') == 'Moral' ? 'selected' : '' }}>Moral</option>
          </select>
          @error('Tipo')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
      </div>
  
      <center>
      <div class="col-12">
          <button class="btn btn-primary" type="submit">Agregar</button>
      </div>
    </center>

  </form>
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('Todo.js') }}"></script>

</body>
</html>