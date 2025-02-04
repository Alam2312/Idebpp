<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="Todo.css" rel="stylesheet">

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

    <div class="margen" style="display: flex">
    <h1>Empleados</h1>
    @if(Session::get('Rol') == 0)
    <a href="Empleados/create" class="NuevoTabla">Nuevo</a>
      @endif
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

        <input type="hidden" value="Empleados" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Tabla" accept="image/*"required>

        <button class="btn btn-primary" style="margin-left: 2vw; padding-bottom: 4px">Buscar</button>
      </div>
    </style>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombres</th>
              <th scope="col">Apellidos</th>
              <th scope="col">Puesto</th>
              <th scope="col">Telefono</th>
              <th scope="col">Correo</th>
              <th scope="col">Editar</th>
              <th scope="col">Eliminar</th>
            </tr>
          </thead>
          <tbody>

            @php
            $counter = ($EmpleadosPaginados->currentPage() - 1) * $EmpleadosPaginados->perPage();
            @endphp

      @if(!empty($EmpleadosPaginados))
      @foreach ($EmpleadosPaginados as $Empleado)
    
      <tr>
        <td scope="row">{{ ++$counter }}</td>
        <td>{{ $Empleado->Nombres }}</td>
        <td>{{ $Empleado->Apellidos }}</td>
        <td>{{ $Empleado->Puesto }}</td>
        <td>{{ $Empleado->Telefono }}</td>
        <td>{{ $Empleado->Correo }}</td>
    
        <td><a href="/Empleados/{{ $Empleado->id }}/edit">Editar</a></td>
        
        <td><a href="/Empleados/{{ $Empleado->id }}">Borrar</a></td> 
      </tr>
      @endforeach
    </tbody>
      </table>

      <div id="pagination-links" class="pagination">
        <!-- Mostrar el texto de la paginación actual -->
        <p style="position: relative; top: 5px;">Página {{ $EmpleadosPaginados->currentPage() }} de {{ $EmpleadosPaginados->lastPage() }}</p>
    
        <!-- Botones para avanzar y retroceder -->
        <div>
            @if ($EmpleadosPaginados->currentPage() > 1)
                <a href="{{ route('Empleados.index') }}?page={{ $EmpleadosPaginados->currentPage() - 1 }}" class="btn btn-primary" style="margin-left: 7px">Anterior</a>
            @endif
    
            @if ($EmpleadosPaginados->hasMorePages())
                <a href="{{ route('Empleados.index') }}?page={{ $EmpleadosPaginados->currentPage() + 1 }}" class="btn btn-primary" style="margin-left: 7px">Siguiente</a>
            @endif
        </div>
    </div>

      @else

      <h1>No hay registros hasta este momento</h1>

      @endif

    </div> <!-- fin del cuerpo con margenes -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('Todo.js') }}"></script>

</body>
</html>