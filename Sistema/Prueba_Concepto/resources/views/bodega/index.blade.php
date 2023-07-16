@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">



<br>



<div style="display: flex; justify-content: space-between">
    <h1>Bodegas</h1>

    <a href="{{url('bodega/create')}}" class="btn btn-success" style="align-self: center; width: 200px"> Crear nueva
        Bodega </a>
</div>

<br />


@if(Session::has('mensaje'))
<!--Si hay algun mensaje este de debe mostrar-->
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{Session::get('mensaje')}}

    <!--Para hacer desaparecer el alert-->
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

    </button>

</div>
@endif

<br />

<body>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="bodegas">
                <thead class="thead-light">
                    <tr>
                        <th style="text-align: center"># </th>
                        <th style="text-align: center">Comuna</th>
                        <th style="text-align: center">Empresa</th>
                        <th style="text-align: center">Nombre Bodega</th>
                        <th style="text-align: center">Descripción</th>
                        <th style="text-align: center">Dirección</th>
                        <th style="text-align: center; width: 220px">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bodegas as $bodega )
                    <tr>
                        <td>{{$bodega->id}}</td>
                        @foreach($comunas as $comuna)
                        @if($bodega->id_comuna == $comuna->id)
                        <td>{{ $comuna -> nombre }}</td>
                        @break
                        @endif
                        @endforeach

                        @foreach($empresas as $empresa)
                        @if($bodega->id_empresa == $empresa->id)
                        <td>{{ $empresa -> nombre }}</td>
                        @break
                        @endif
                        @endforeach

                        <td>{{$bodega->nombre}}</td>
                        <td>{{$bodega->descripcion}}</td>
                        <td>{{$bodega->direccion}}</td>
                        <td>
                            <div class="container-md">
                                <div class="row mb-2">
                                    <div class="col-13">

                                        <!--Boton para ver Detalle de Bodega-->
                                        <span data-toggle="modal" data-target="#ModalBodega">
                                            <button class="btn btn-primary btn-detalle" type="button"
                                                data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="bottom"
                                                title="Ver Detalle" data-id="{{$bodega->id}}"><i
                                                    class="fas fa-search"></i></button>
                                        </span>

                                        <a href="{{url('/pb/'.$bodega->id )}}" class="btn btn-info"
                                            data-toggle="tooltip" data-placement="bottom" title="Ver Productos"><i
                                                class="fas fa-sign-in-alt"></i></a>

                                        <form action="{{url('/bodega/'.$bodega->id.'/edit')}}" class="d-inline">
                                            <button type="submit" class="btn btn-warning" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="Editar Bodega"><i
                                                    class="fas fa-edit"></i></button>
                                        </form>



                                        <form action="{{url('/bodega/'.$bodega->id)}}" class="d-inline" method="post">
                                            @csrf
                                            {{method_field('DELETE')}}

                                            <button class="btn btn-danger" type="submit" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="Eliminar bodega"
                                                onclick="return confirm('¿Estás seguro/a que deseas eliminar esta bodega?')">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="ModalBodega" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="bodega-title" id="detalleModalLabel">Detalle de
                        Bodega </h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">

                    </button>
                </div>

                <!--Contenido del Modal-->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">

                            <p id="bd-comuna">Comuna: </p>
                            <p id="bd-empresa">Empresa: </p>
                            <p id="bd-nombre">Nombre de Bodega: </p>

                        </div>

                        <div class="col-md-6 ms-auto">

                            <p id="bd-direccion">Dirección: </p>
                            <p id="bd-correo">Correo de Encargado: </p>
                            <p id="bd-telefono">Teléfono de Encargado: </p>

                        </div>

                        <div class="col-sm-9">
                            <p id="bd-hora">Hora de Funcionamiento: </p>
                            <p id="bd-descripcion">Descripción: </p>
                            <a id="btn-exportar" class="btn btn-info btn-xs">
                                Descargar stock

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>



    <script>
    $(document).ready(function() {
        $('.btn-detalle').click(function() {
            const id = $(this).attr('data-id');
            $.ajax({
                url: id + '/bodega_detalle',
                type: 'GET',
                data: {
                    "id": id
                },
                success: function(data) {


                    $('#bd-nombre').html('Nombre Bodega:  ' + data.nombre);
                    $('#bd-descripcion').html('Descripción:  ' + data.descripcion);
                    $('#bd-direccion').html('Dirección:  ' + data.direccion);
                    $('#bd-correo').html('Correo de Encargado:  ' + data.correo_encargado);
                    $('#bd-telefono').html('Teléfono de Encargado:  ' + data
                        .telefono_encargado);
                    $('#bd-hora').html('Hora de Funcionamiento:  ' + data
                        .hora_funcionamiento);
                    $('#btn-exportar').attr("onclick", `descargarStock(${id})`);
                    var bodega = data;

                    $.ajax({
                        url: bodega.id + '/obtenercomuna',
                        type: 'GET',
                        data: {
                            "id": bodega.id_comuna
                        },
                        success: function(data) {

                            $('#bd-comuna').html('Comuna: ' + data.nombre);

                            $.ajax({
                                url: bodega.id + '/obtenerempresa',
                                type: 'GET',
                                data: {
                                    "id": bodega.id_empresa
                                },
                                success: function(data) {
                                    //console.log(data);
                                    $('#bd-empresa').html(
                                        'Empresa: ' + data
                                        .nombre);
                                }
                            })
                        }
                    })
                }
            })
            var modal = $(this)
            modal.find('.bodega-title').text('Detalle de Bodega ' + id)
        });

    });

    async function descargarStock(id) {
        const url = "{{ url('/api/bodega')}}/" + id + "/export";
        try {
            const result = await axios.get(url);
            const filename = result.headers['content-disposition'].split("=")[1];

            const fileUrl = window.URL.createObjectURL(new Blob([result.data]));
            const link = document.createElement('a');
            link.href = fileUrl;
            link.setAttribute('download', filename);
            document.body.appendChild(link);
            link.click();
        } catch (e) {
            console.error(e.message);
            return;
        }
    }
    </script>

</body>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>

<script>
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>

<script>
$('#bodegas').DataTable({
    responsive: true,
    autoWidth: false,
    "language": {
        "lengthMenu": "Mostrar _MENU_ bodegas por pagina",
        "info": "Mostrando pagina _PAGE_ de _PAGES_",
        "infoEmpty": "No existen bodegas que mostrar",
        "infoFiltered": "(filtrado de un total de _MAX_ bodegas)",
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