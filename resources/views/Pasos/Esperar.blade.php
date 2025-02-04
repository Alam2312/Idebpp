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
    <h1>Pedido Nuevo</h1>
    </div>

    <form class="row g-3 needs-validation" novalidate method="POST" action="/Pedidos/Activos">
      @csrf
      @method("POST")
        <div class="col-md-4">
          <label for="validationCustom01" class="form-label">Servicio a realizar</label>
          <input type="text" class="form-control" id="validationCustom01" value="" name="Nombre" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
      
        <div class="col-md-4">
          <label for="validationCustomUsername" class="form-label">Costo</label>
          <div class="input-group has-validation">
            <input type="text" class="form-control"value="" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Telefono" required>
            <div class="invalid-feedback">
              Please choose a username.
            </div>
          </div>
        </div>

          <div class="col-md-4">
            <label for="validationCustom02" class="form-label">Fecha</label>
            <input type="text" class="form-control" id="validationCustom02" value="" method="POST" name="Correo" required>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>    
          
          <div class="col-md-4">
            <label for="validationCustom02" class="form-label">Hora</label>
            <input type="text" class="form-control" id="validationCustom02" value="" method="POST" name="Correo" required>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>   

                 <!-- Lista desplegable para Clientes -->
        <div class="col-md-4">
          <label for="cliente" class="form-label">Cliente</label>
          <select class="form-control" id="cliente" name="Cliente" required>
              @foreach($Clientes as $cliente)
                  <option value="{{ $cliente->id }}">{{ $cliente->Nombre }}</option>
              @endforeach
          </select>
      </div>

      <!-- Lista desplegable para Empleados -->
      <div class="col-md-4">
          <label for="empleado" class="form-label">Empleado</label>
          <select class="form-control" id="empleado" name="Empleado" required>
              @foreach($Empleados as $empleado)
                  <option value="{{ $empleado->id }}">{{ $empleado->Nombres }}</option>
              @endforeach
          </select>
      </div>

          <center>
        <div class="col-12">
          <button class="btn btn-primary" type="submit">Agregar</button>
        </div>
          </center>

    </div> <!-- fin del cuerpo con margenes -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('Todo.js') }}"></script>

</body>
</html>