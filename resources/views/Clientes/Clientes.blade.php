<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Clientes</title>
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

        <div class="margen" style="display: flex">
            <h1>Clientes</h1>
            <a href="/Clientes/create" class="NuevoTabla">Nuevo</a>
        </div>

        {{-- formuylario para la barra de busqueda --}}
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

              <input type="hidden" value="Clientes" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Tabla" accept="image/*"required>

              <button class="btn btn-primary" style="margin-left: 2vw; padding-bottom: 4px">Buscar</button>
            </div>
          </style>
          </form>
      
      

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Persona (SAT)</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody id="cliente-table">

                @php
                $counter = ($clientesPaginados->currentPage() - 1) * $clientesPaginados->perPage();
                @endphp
    
                @foreach ($clientesPaginados as $cliente)
                <tr>
                    <td scope="row">{{ ++$counter }}</td>
                    <td>{{ $cliente['Nombre'] }}</td>
                    <td>{{ $cliente['Telefono'] }}</td>
                    <td>{{ $cliente['Correo'] }}</td>
                    <td>{{ $cliente['Tipo'] }}</td>
                    <td><a href="/Clientes/{{ $cliente['id'] }}/edit">Editar</a></td>
                    <td><a href="/Clientes/{{ $cliente['id'] }}">Borrar</a></td> 
                </tr>
            @endforeach
            </tbody>
        </table>

        <div id="pagination-links" class="pagination">
            <!-- Mostrar el texto de la paginación actual -->
            <p style="position: relative; top: 5px;">Página {{ $clientesPaginados->currentPage() }} de {{ $clientesPaginados->lastPage() }}</p>
        
            <!-- Botones para avanzar y retroceder -->
            <div>
                @if ($clientesPaginados->currentPage() > 1)
                    <a href="{{ route('Clientes.index') }}?page={{ $clientesPaginados->currentPage() - 1 }}" class="btn btn-primary" style="margin-left: 7px">Anterior</a>
                @endif
        
                @if ($clientesPaginados->hasMorePages())
                    <a href="{{ route('Clientes.index') }}?page={{ $clientesPaginados->currentPage() + 1 }}" class="btn btn-primary" style="margin-left: 7px">Siguiente</a>
                @endif
            </div>
        </div>

        @if(empty($clientesPaginados))
            <h3>No hay registros hasta este momento</h3>
        @endif

    </div> <!-- fin del cuerpo con margenes -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('Todo.js') }}"></script>

</body>
</html>
