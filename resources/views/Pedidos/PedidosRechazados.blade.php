<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('Todo.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.0/dist/sweetalert2.min.js"></script>
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
    <h1>Servicios donde se no se realizó el pago</h1>
    </div>

    <form action="{{ route('buscar') }}" method="POST">
      @csrf
      <div class="display">
       <div class="col-md-11">
            <input type="text" class="form-control @error('Buscar') is-invalid @enderror" id="validationCustom01" name="Buscar" value="{{ old('Buscar') }}" required>
            @error('Buscar')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <input type="hidden" value="PedidosRec" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Tabla" accept="image/*"required>

        <button class="btn btn-primary" style="margin-left: 2vw; padding-bottom: 4px">Buscar</button>
      </div>
    </style>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Proyecto</th>
              <th scope="col">Servicio</th>
              <th scope="col">Costo</th>
              <th scope="col">Fecha Limite</th>
              <th scope="col">Pago</th>
              <th scope="col">Estatus</th>
              <th scope="col">Rehabilitar</th>
            </tr>
          </thead>
          <tbody>

            @php
            $counter = ($ServiciosPaginados->currentPage() - 1) * $ServiciosPaginados->perPage();
            @endphp
            
          @if(!empty($ServiciosPaginados))
      @foreach ($ServiciosPaginados as $Servicio)
    
      <tr>
        <td scope="row">{{ ++$counter }}</td>
        <td>{{ $Servicio->Proyecto }}</td>
        <td>{{ $Servicio->Servicio }}</td>
        <td>{{ $Servicio->Costo }}</td>
        <td>{{ $Servicio->Fecha }}</td>
        <td>{{ $Servicio->Pago }}</td>
        <td>{{ $Servicio->Estatus }}</td>

        @if($Servicio->Estatus == "SinPago")

        <td><a  class="confirm-link" href="/Rehabilitar/{{ $Servicio->id }}">Rehabilitar</a></td></tr>

        @endif

        @if($Servicio->Estatus == "Rechazado")

        <td><a  class="confirm-link" href="/Rehabilitar/{{ $Servicio->id }}">ReCotizar</a></td></tr>

        @endif
        
      @endforeach
    </tbody>
      </table>

      <div id="pagination-links" class="pagination">
        <!-- Mostrar el texto de la paginación actual -->
        <p style="position: relative; top: 5px;">Página {{ $ServiciosPaginados->currentPage() }} de {{ $ServiciosPaginados->lastPage() }}</p>
    
        <!-- Botones para avanzar y retroceder -->
        <div>
            @if ($ServiciosPaginados->currentPage() > 1)
                <a href="/Pedidos/Rechazados?page={{ $ServiciosPaginados->currentPage() - 1 }}" class="btn btn-primary" style="margin-left: 7px">Anterior</a>
            @endif
    
            @if ($ServiciosPaginados->hasMorePages())
                <a href="/Pedidos/Rechazados?page={{ $ServiciosPaginados->currentPage() + 1 }}" class="btn btn-primary" style="margin-left: 7px">Siguiente</a>
            @endif
        </div>
    </div>

      @else

      <h3>No hay registros hasta este momento</h3>

      @endif

    </div> <!-- fin del cuerpo con margenes -->

    <script>
      document.addEventListener('DOMContentLoaded', function () {
          const links = document.querySelectorAll('.confirm-link');
          links.forEach(function (link) {
              link.addEventListener('click', function (event) {
                  event.preventDefault(); // Previene la redirección inmediata

                  Swal.fire({
                      title: '¿Estás seguro?',
                      text: "¡No podrás revertir esto!",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Sí, adelante',
                      cancelButtonText: 'Cancelar'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          window.location.href = link.href; // Redirige si se confirma
                      }
                  });
              });
          });
      });
  </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('Todo.js') }}"></script>

</body>
</html>