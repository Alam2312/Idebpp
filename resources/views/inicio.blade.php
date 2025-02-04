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

    <div class="margen" style="text-align: center;">
    <h1>Acciones</h1>
    </div>

    <div class="Mostrar4">
    <div class="display">

    <div class="contenedorAcciones"><a href="/Clientes" class="AccionesLink">Clientes</a></div>
    <div class="contenedorAcciones" style="margin-left: 3.9%"><a href="/NuevoPedido" class="AccionesLink">Nuevo Servicio</a></div>
    <div class="contenedorAcciones" style="margin-left: 3.9%"><a href="/Empleados" class="AccionesLink">Empleados</a></div>
    <div class="contenedorAcciones" style="margin-left: 3.9%"><a style="" href="/Almacenamiento" class="AccionesLink">Ruta Archivos</a></div>

    </div><!--fin del display flex-->

    <div class="display" style="margin-top: 30px;">

<div class="contenedorAcciones"><a href="/Pagos" class="AccionesLink">Pagos Pendientes</a></div>
<div class="contenedorAcciones" style="margin-left: 3.9%"><a href="/Pedidos/Activos" class="AccionesLink">Pedidos activos</a></div>
<div class="contenedorAcciones" style="margin-left: 3.9%"><a href="/Pedidos/Inactivos" class="AccionesLink">Pedidos Finalizados</a></div>
<div class="contenedorAcciones" style="margin-left: 3.9%"><a href="/Pedidos/Rechazados" class="AccionesLink">Pedidos Rechazados</a></div>

</div><!--fin del display flex-->
    </div>

    <div class="Mostrar2">
        
            <div class="display">
            <div class="contenedorAcciones"><a href="/Clientes" class="AccionesLink">Registrar Cliente</a></div>
            <div class="contenedorAcciones"><a href="/NuevoPedido" class="AccionesLink">Nuevo Pedido</a></div>
            </div><!--fin del display flex-->

            <br>

            <div class="display">
            <div class="contenedorAcciones"><a href="/Empleados" class="AccionesLink">Registrar Empleado</a></div>
            <div class="contenedorAcciones"><a style="" href="/Almacenamiento" class="AccionesLink">Ruta Archivos</a></div>
            </div><!--fin del display flex-->

            <br>
        
            <div class="display">
        
        <div class="contenedorAcciones"><a href="/Pagos" class="AccionesLink">Pagos Pendientes</a></div>
        <div class="contenedorAcciones"><a href="/Pedidos/Activos" class="AccionesLink">Pedidos activos</a></div>
        
        </div><!--fin del display flex-->

        <br>

        <div class="display">

        <div class="contenedorAcciones"><a href="/Pedidos/Inactivos" class="AccionesLink">Pedidos Finalizados</a></div>
        <div class="contenedorAcciones"><a href="/Pedidos/Rechazados" class="AccionesLink">Pedidos Rechazados</a></div>
        
        </div><!--fin del display flex-->

    </div>

</div> <!-- fin del cuerpo con margenes -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/checkConnection.js') }}"></script>

</body>
</html>