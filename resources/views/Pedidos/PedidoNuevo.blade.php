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
        <a style="font-weight: bold;" class="Links" href="/Usuario" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Usuario</a>
      </div>
      </div>
    
    <div class="cuerpo">

    <div class="margen">
    <h1>Servicio Nuevo</h1>
    </div>

    @if(!empty($Clientes))


    <form class="row g-3 needs-validation" novalidate method="POST" action="/Pedidos/Activos">
      @csrf
      @method("POST")
      <div class="col-md-12">
        <label for="validationCustom01" class="form-label">Servicio a realizar</label>
        <input type="text" class="form-control @error('Servicio') is-invalid @enderror" id="validationCustom01" name="Servicio" value="{{ old('Servicio') }}" required>
        <div class="invalid-feedback">
            @error('Servicio') {{ $message }} @else Por favor ingresa el servicio a realizar. @enderror
        </div>
    </div>

    <div class="col-md-6">
        <label for="validationCustom02" class="form-label">Nombre del proyecto (Se usará como nombre de carpeta)</label>
        <input type="text" class="form-control @error('Proyecto') is-invalid @enderror" id="validationCustom02" name="Proyecto" value="{{ old('Proyecto') }}" required>
        <div class="invalid-feedback">
            @error('Proyecto') {{ $message }} @else Por favor ingresa el nombre del proyecto. @enderror
        </div>
    </div>

    <!-- Lista desplegable para Clientes -->
    <div class="col-md-6">
        <label for="cliente" class="form-label">Cliente</label>
        <select class="form-control @error('idCliente') is-invalid @enderror" id="cliente" name="idCliente" required>
            @foreach($Clientes as $cliente)
                <option value="{{ $cliente->id }}" {{ old('idCliente') == $cliente->id ? 'selected' : '' }}>{{ $cliente->Nombre }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">
            @error('idCliente') {{ $message }} @else Por favor selecciona un cliente. @enderror
        </div>
    </div>

          <center>
        <div class="col-12">
          <button class="btn btn-primary" type="submit">Agregar</button>
        </div>
          </center>
    </form>

    </div> <!-- fin del cuerpo con margenes -->

@else

<h3>No tienes a ningun cliente registrado aun</h3>

@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('Todo.js') }}"></script>

</body>
</html>