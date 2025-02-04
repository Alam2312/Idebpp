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
    <h1>Eliminar Cliente</h1>
    </div>

    <form class="row g-3 needs-validation" method="POST" action="/Pedidos/Activos/{{$Servicio->id}}">
      @csrf
      @method("DELETE") 
        <div class="col-md-4">
          <label for="validationCustom01" class="form-label">Proyecto</label>
          <input type="text" class="form-control" id="validationCustom01" value="{{$Servicio->Proyecto}}" name="Nombre" readonly>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
      
        <div class="col-md-4">
          <label for="validationCustomUsername" class="form-label">Servicio</label>
          <div class="input-group has-validation">
            <input type="text" class="form-control"value="{{$Servicio->Servicio}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Telefono" readonly>
            <div class="invalid-feedback">
              Please choose a username.
            </div>
          </div>
        </div>
          
          <div class="col-md-4">
            <label for="validationCustom02" class="form-label">Costo</label>
            <input type="text" class="form-control" id="validationCustom02" value="{{$Servicio->Costo}}" method="POST" name="Correo" readonly>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>    

          <div class="col-md-4">
            <label for="validationCustom02" class="form-label">Pagado</label>
            <input type="text" class="form-control" id="validationCustom02" value="{{$Servicio->Pagado}}" method="POST" name="Correo" readonly>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div> 

          <div class="col-md-4">
            <label for="validationCustom02" class="form-label">Fecha de vencimiento</label>
            <input type="text" class="form-control" id="validationCustom02" value="{{$Servicio->Fecha}}" method="POST" name="Correo" readonly>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div> 

          <div class="col-md-4">
          <label for="validationCustom02" class="form-label">Pago</label>
          <input type="text" class="form-control" id="validationCustom02" value="{{$Servicio->Pago}}" method="POST" name="Correo" readonly>
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
                  <a href="/VotarP/{{$Servicio->id}}">Confirmar</a>
                 @endif 
                </th>

                <th scope="row">@if($Info->Confirmacion2 != 0)
                  <a>{{$Info->Confirmacion2}}</a>
                @else
                <a href="/VotarP/{{$Servicio->id}}">Confirmar</a>
               @endif 
              </th>

              <th scope="row">@if($Info->Confirmacion3 != 0)
                <a>{{$Info->Confirmacion3}}</a>
              @else
              <a href="/VotarP/{{$Servicio->id}}">Confirmar</a>
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