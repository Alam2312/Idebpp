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
    <h1>Pedidos Inactivos</h1>
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

        <input type="hidden" value="PedidosIna" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Tabla" accept="image/*"required>

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
              <th scope="col">Fecha</th>
              <th scope="col">Hora</th>
              <th scope="col">Pago</th>
              <th scope="col">Ver</th>
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
        <td>{{ $Servicio->Hora }}</td>
        <td>{{ $Servicio->Pago }}</td>
        <td><a href="/Archivos/{{ $Servicio->id }}">Ver</a></td> 
      </tr>
      @endforeach
    </tbody>
      </table>

      <div id="pagination-links" class="pagination">
        <!-- Mostrar el texto de la paginación actual -->
        <p style="position: relative; top: 5px;">Página {{ $ServiciosPaginados->currentPage() }} de {{ $ServiciosPaginados->lastPage() }}</p>
    
        <!-- Botones para avanzar y retroceder -->
        <div>
            @if ($ServiciosPaginados->currentPage() > 1)
                <a href="/Pedidos/Inactivos?page={{ $ServiciosPaginados->currentPage() - 1 }}" class="btn btn-primary" style="margin-left: 7px">Anterior</a>
            @endif
    
            @if ($ServiciosPaginados->hasMorePages())
                <a href="/Pedidos/Inactivos?page={{ $ServiciosPaginados->currentPage() + 1 }}" class="btn btn-primary" style="margin-left: 7px">Siguiente</a>
            @endif
        </div>
    </div>

      @else

      <h3>No hay registros hasta este momento</h3>

      @endif

    </div> <!-- fin del cuerpo con margenes -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('Todo.js') }}"></script>

</body>
</html>