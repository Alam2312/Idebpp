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
    <h1>Documentos sobre el Cliente</h1>
    </div>

    @if($Cliente->Tipo == "Fisica")

    <form class="row g-3 needs-validation" method="POST" action="/Documento" enctype="multipart/form-data">
      @csrf

      <div class="display">

      <div class="col-md-10" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label">Copia de la INE</label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
        </div>
      </div>

      <input type="hidden" value="{{$Cliente->id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>

      <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Lugar" required>

        <div class="BotonLado">
          <button class="btn btn-primary" type="submit">Agregar</button>
        </div>

      </div>

    </form>

    <form class="row g-3 needs-validation" method="POST" action="/Documento" enctype="multipart/form-data">
      @csrf

      <div class="display">

      <div class="col-md-10" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label">Constancia Fiscal</label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
        </div>
      </div>

      <input type="hidden" value="{{$Cliente->id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>

      <input type="hidden" value="2" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Lugar" required>


      <div class="BotonLado">
          <button class="btn btn-primary" type="submit">Agregar</button>
        </div>

      </div>

    </form>

    <form class="row g-3 needs-validation" method="POST" action="/Documento" enctype="multipart/form-data">
      @csrf

      <div class="display">

      <div class="col-md-10" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label">Comprobante de domicilio fiscal</label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-d
          escribedby="inputGroupPrepend" method="POST" name="Imagen" required>
        </div>
      </div>

      <input type="hidden" value="{{$Cliente->id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>

      <input type="hidden" value="3" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Lugar" required>

      <div class="BotonLado">
        <button class="btn btn-primary" type="submit">Agregar</button>
      </div>

      </div>

    </form>

    <form class="row g-3 needs-validation" method="POST" action="/Documento" enctype="multipart/form-data">
      @csrf

      <div class="display">

      <div class="col-md-10" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label">Formato lleno del Alta del cliente</label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
        </div>
      </div>

      <input type="hidden" value="{{$Cliente->id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>

      <input type="hidden" value="4" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Lugar" required>

      <div class="BotonLado">
        <button class="btn btn-primary" type="submit">Agregar</button>
      </div>
      </div>
    </form>

    <form class="row g-3 needs-validation" method="POST" action="/Documento" enctype="multipart/form-data">
      @csrf

      <div class="display">

      <div class="col-md-10" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label">Datos de contactos para comunicación</label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-d
          escribedby="inputGroupPrepend" method="POST" name="Imagen" required>
        </div>
      </div>

      <input type="hidden" value="{{$Cliente->id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>

      <input type="hidden" value="5" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Lugar" required>


      <div class="BotonLado">
        <button class="btn btn-primary" type="submit">Agregar</button>
      </div>

      </div>

    </form>

    <form class="row g-3 needs-validation" method="POST" action="/Documento" enctype="multipart/form-data">
      @csrf

      <div class="display">

      <div class="col-md-10" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label"> Datos de facturación</label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-d
          escribedby="inputGroupPrepend" method="POST" name="Imagen" required>
        </div>
      </div>

      <input type="hidden" value="{{$Cliente->id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>

      <input type="hidden" value="6" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Lugar" required>

      <div class="BotonLado">
        <button class="btn btn-primary" type="submit">Agregar</button>
      </div>

      </div>

    </form>


    @else {{-- Final de los archivos de la persona del tipo Fisica --}}
    

    <form class="row g-3 needs-validation" method="POST" action="/Documento" enctype="multipart/form-data">
      @csrf

      <div class="display">

      <div class="col-md-10" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label">Constancia fiscal</label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
        </div>
      </div>

      <input type="hidden" value="{{$Cliente->id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>

      <input type="hidden" value="1" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Lugar" required>

        <div class="BotonLado">
          <button class="btn btn-primary" type="submit">Agregar</button>
        </div>

      </div>

    </form>

    <form class="row g-3 needs-validation" method="POST" action="/Documento" enctype="multipart/form-data">
      @csrf

      <div class="display">

      <div class="col-md-10" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label"> Acta constitutiva o Poder del representante legal </label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
        </div>
      </div>

      <input type="hidden" value="{{$Cliente->id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>

      <input type="hidden" value="2" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Lugar" required>

      <div class="BotonLado">
          <button class="btn btn-primary" type="submit">Agregar</button>
        </div>

      </div>

    </form>

    <form class="row g-3 needs-validation" method="POST" action="/Documento" enctype="multipart/form-data">
      @csrf

      <div class="display">

      <div class="col-md-10" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label"> INE del representante legal </label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-d
          escribedby="inputGroupPrepend" method="POST" name="Imagen" required>
        </div>
      </div>

      <input type="hidden" value="{{$Cliente->id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>

      <input type="hidden" value="3" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Lugar" required>

      <div class="BotonLado">
        <button class="btn btn-primary" type="submit">Agregar</button>
      </div>

      </div>

    </form>

    <form class="row g-3 needs-validation" method="POST" action="/Documento" enctype="multipart/form-data">
      @csrf

      <div class="display">

      <div class="col-md-10" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label">	Comprobante de domicilio fiscal de la compañía</label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
        </div>
      </div>

      <input type="hidden" value="{{$Cliente->id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>

      <input type="hidden" value="4" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Lugar" required>

      <div class="BotonLado">
        <button class="btn btn-primary" type="submit">Agregar</button>
      </div>
      </div>
    </form>

    <form class="row g-3 needs-validation" method="POST" action="/Documento" enctype="multipart/form-data">
      @csrf

      <div class="display">

      <div class="col-md-10" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label">	•	Formato lleno del Alta del cliente. </label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Imagen" required>
        </div>
      </div>

      <input type="hidden" value="{{$Cliente->id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>

      <input type="hidden" value="5" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Lugar" required>

      <div class="BotonLado">
        <button class="btn btn-primary" type="submit">Agregar</button>
      </div>
      </div>
    </form>

    <form class="row g-3 needs-validation" method="POST" action="/Documento" enctype="multipart/form-data">
      @csrf

      <div class="display">

      <div class="col-md-10" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label"> Datos de contactos para comunicación. </label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-d
          escribedby="inputGroupPrepend" method="POST" name="Imagen" required>
        </div>
      </div>

      <input type="hidden" value="{{$Cliente->id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>

      <input type="hidden" value="6" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Lugar" required>

      <div class="BotonLado">
        <button class="btn btn-primary" type="submit">Agregar</button>
      </div>

      </div>

    </form>

    <form class="row g-3 needs-validation" method="POST" action="/Documento" enctype="multipart/form-data">
      @csrf

      <div class="display">

      <div class="col-md-10" style="margin-bottom: 30px">
        <label for="validationCustomUsername" class="form-label"> Datos de facturación </label>
        <div class="input-group has-validation">
          <input type="file" class="form-control"value="URL" id="validationCustomUsername" aria-d
          escribedby="inputGroupPrepend" method="POST" name="Imagen" required>
        </div>
      </div>

      <input type="hidden" value="{{$Cliente->id}}" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="id" required>

      <input type="hidden" value="7" id="validationCustomUsername" aria-describedby="inputGroupPrepend" method="POST" name="Lugar" required>

      <div class="BotonLado">
        <button class="btn btn-primary" type="submit">Agregar</button>
      </div>

      </div>

    </form>

    @endif


    </div> <!-- fin del cuerpo con margenes -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('Todo.js') }}"></script>

</body>
</html>