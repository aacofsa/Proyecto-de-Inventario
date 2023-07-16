@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

<body>
    <br>
    <div style="display: flex; justify-content: space-between">
        <!-- Header -->
        <h1>Compras y ventas</h1>
        <!-- Boton para crear nuevo movimiento -->
        <a href="{{ url('/compraventa/create') }}" style="align-self: center;">
            <input type="submit" class="btn btn-success" value="Crear nuevo movimiento">
        </a>
    </div>

    <!-- Muesta el mensaje si este existe, la alerta puede cerrarse -->
    @if(Session::has('mensajeSuccess'))
    <div class="alert alert-success alert-dismissible fade show" role="alert"> {{ Session::get('mensajeSuccess') }}
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <br>

    <!-- Tabla de movimientos -->
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered" id="movimientos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Factura</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($rps as $rp)
                    <tr>
                        <!-- Datos de registro_producto -->
                        <td>{{ $rp -> id}}</td>
                        <td>{{ $rp -> tipo}}</td>
                        <td>{{ $rp -> precio_total}}</td>
                        <td>{{ $rp -> fecha}}</td>
                        <td>{{ $rp -> factura}}</td>
                        <td>
                            <!-- Acciones -->
                            <!-- Ver detalle usando modal-->
                            <span data-bs-toggle="modal" data-bs-target="#modalDetalle" id="modalButton">
                                <button class="btn btn-primary btn-detalle" type="button" data-bs-toggle="tooltip"
                                    data-rpid="{{$rp->id}}" data-bs-html="true" data-bs-placement="bottom"
                                    title="Ver Detalle" data-bs-html="true">
                                    <i class="fas fa-search"></i></button>
                            </span>

                            <!-- Editar -->
                            <form action="{{ url('/compraventa/'.$rp->id.'/edit') }}" class="d-inline">
                                <button type="submit" class="btn btn-warning" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Editar movimiento">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>
                            <!-- Borrar -->
                            <form action="{{ url('/compraventa/'.$rp->id) }}" class="d-inline" method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Eliminar movimiento"
                                    onclick="return confirm('¿Estás seguro/a que deseas eliminar este movimiento?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal del detalle -->
    <div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="modalDetalleLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- Cabezal del modal -->
                <div class="modal-header">
                    <!-- Header del modal -->
                    <!-- Detalle para $ID -->
                    <h5 class="modal-title" id="detalleModalLabel">Detalle</h5>
                    <!-- Boton de cerrado -->
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Cuerpo del modal -->
                <div class="modal-body" id="modalDetalleBody">
                    <div>
                        <!-- Contenedor del cuerpo -->
                        <div>
                            <!-- Contenedor de los datos del registro -->
                            <div class="row" id="modal-rp-info">
                                <div class="col-sm" id="col-izq">
                                    <!-- Fecha -->
                                    <p id="rp-fecha"> Fecha: </p>
                                    <!-- Factura -->
                                    <p id="rp-factura"> Factura: </p>
                                </div>
                                <div class="col-sm" id="col-der">
                                    <!-- Tipo -->
                                    <p id="rp-tipo"> Tipo: </p>
                                    <!-- Monto -->
                                    <p id="rp-monto"> Monto: </p>
                                </div>
                            </div>
                            <!-- Tabla, Contenedor de los datos de lotes -->
                            <div>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Descripción</th>
                                            <th>Cantidad</th>
                                            <th>Precio unitario</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modal-tbody">
                                    </tbody>
                                </table>
                            </div>
                            <!-- Div bajo la tabla -->
                            <div id="modal-undertable">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- JavaScript opcional-->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<!-- dataTables JS -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>

<script>
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>

<!-- Relleno del modal usando el id de registro asociado a la tupla -->
<script>
$(document).ready(function() {
    $("body").on("click",".btn-detalle", function(event) {
        
        // Restaurar el modal a su estado por defecto (vacio)
        $('#detalleModalLabel').html('Detalle ');
        $('#rp-fecha').html('Fecha: ');
        $('#rp-tipo').html('Tipo: ');
        $('#rp-monto').html('Monto: ');
        $('#rp-factura').html('Factura: ');
        $('#modal-tbody tr').remove();

        // se extrae el id del registro desde data-rpid usando el boton que triggereo el modal
        var button = $(event.relatedTarget)
        var rpid = $(this).attr('data-rpid');

        // Solicitudes ajax
        // Solicitud ajax para extraer la informacion del registro
        $.ajax({
            url: rpid + '/compraventa_detalle',
            type: 'GET',
            data: {
                "id": rpid
            },
            success: function(data) {

                // almacena data del registro de producto en variable para la siguiente solicitud
                var dataRegistro = data;

                // Solicitud ajax para extraer los lotes correspondientes al registro
                $.ajax({
                    url: dataRegistro.id + '/obtenerLotesRP/',
                    type: 'GET',
                    data: {
                        "id": dataRegistro.id
                    },
                    success: function(data) {

                        // Si no existen lotes para este registro mostrar mensaje
                        $('#modal-undertable').html("");
                        if (data.length === 0) {
                            var r = document.createElement("p");
                            r.innerHTML = 'No existen lotes para este registro'
                            $('#modal-undertable').append(r);
                            return;
                        }

                        // almacena data de los lotes en array para la siguiente solicitud
                        var dataLotes_array = [];
                        var idsProductos = [];

                        // fuerza la data devuelta por la solicitud a [[Prototype]]: Array(0)
                        for (var k in data) {
                            dataLotes_array[k] = [data[k].id_producto,
                                data[k].id_registro,
                                data[k].cantidad, data[k].id_producto,
                                data[k].precio_unitario
                            ];

                            idsProductos[k] = data[k].id_producto;
                        }

                        // Pasar array de ids a JSON
                        var strIdsProductos = JSON.stringify(idsProductos);

                        // Solicitud ajax para extraer los productos correspondientes a los lotes
                        $.ajax({
                            url: dataRegistro.id +
                                '/obtenerProductos/' +
                                strIdsProductos,
                            type: 'GET',
                            data: {
                                "ids": strIdsProductos
                            },
                            success: function(data) {

                                // Almacena data de los productos 
                                var dataProductos = data;

                                // Contador
                                var index = 0;

                                // Itera los lotes
                                dataLotes_array.forEach(element => {

                                    // fuerza los datos del producto a [[Prototype]]: Array(0)
                                    var dataProducto = [
                                        dataProductos[
                                            index]
                                        .nombre,
                                        dataProductos[
                                            index]
                                        .descripcion
                                    ];

                                    // Crea elementos para la tupla
                                    var row = document
                                        .createElement(
                                            "tr");
                                    var producto = document
                                        .createElement(
                                            "td");
                                    var descripcion =
                                        document
                                        .createElement(
                                            "td");
                                    var cantidad = document
                                        .createElement(
                                            "td");
                                    var precio_unitario =
                                        document
                                        .createElement(
                                            "td");

                                    // Setea el html interno de los elementos de la tupla
                                    producto.innerHTML =
                                        dataProducto[
                                            0];
                                    descripcion.innerHTML =
                                        dataProducto[1];
                                    cantidad.innerHTML =
                                        element[2];
                                    precio_unitario
                                        .innerHTML =
                                        element[
                                            3];

                                    // Incorpora los elementos a la tupla
                                    row.appendChild(
                                        producto);
                                    row.appendChild(
                                        descripcion);
                                    row.appendChild(
                                        cantidad);
                                    row.appendChild(
                                        precio_unitario);

                                    // Agrega la tupla a la tabla del modal
                                    $('#modal-tbody')
                                        .append(row);

                                    index++;
                                });

                            }
                        })

                    }
                })

                // actualizar atributos necesarios del registro en el cabezal de la tabla
                $('#rp-fecha').html('Fecha: ' + dataRegistro
                    .fecha);
                $('#rp-tipo').html('Tipo: ' + dataRegistro
                    .tipo);
                $('#rp-monto').html('Monto: ' + dataRegistro
                    .precio_total);

                // actualizar atributos nullables del registro en el cabezal de la tabla
                var strFactura = dataRegistro.factura == null ?
                    'Factura: ' :
                    'Factura: ' + dataRegistro.factura;
                $('#rp-factura').html(strFactura);
            }
        })

        // Actualizar titulo del modal
        var modal = $(this)
        modal.find('.modal-title').text('Detalle para ' + rpid)
    })
})
</script>

<!-- Aplicar formato de dataTables JS a tabla principal -->
<script>
$('#movimientos').DataTable({
    "language": {
        "lengthMenu": "Mostrar _MENU_ movimientos por pagina",
        "info": "Mostrando pagina _PAGE_ de _PAGES_",
        "infoEmpty": "No existen movimientos que mostrar",
        "infoFiltered": "(filtrado de un total de _MAX_ movimientos)",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "No se encontraron coincidencias",
        "paginate": {
            "first": "Primera",
            "last": "Ultima",
            "next": "Siguente",
            "previous": "Anterior"
        },
        "aria": {
            "sortAscending": ": ordenar columna de forma ascendente",
            "sortDescending": ": ordenar columna de forma descendente"
        }
    }
});
</script>

@endsection