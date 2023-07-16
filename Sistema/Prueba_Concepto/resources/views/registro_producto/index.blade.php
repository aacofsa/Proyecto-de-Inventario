@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

<body>
    <h1>Manejo de registro de producto</h1>
    <br>

    @if(Session::has('mensajeSuccess'))
    <div class="alert alert-success alert-dismissible fade show" role="alert"> {{ Session::get('mensajeSuccess') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <a href="{{ url('/registro_producto/create') }}">
        <input type="submit" class="btn btn-success" value="Crear nuevo registro">
        <br>
    </a>
    <br>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered" id="tablaregistros">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Precio total</th>
                        <th>Factura </th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($rps as $rp)
                    <tr>
                        <td>{{ $rp -> id}}</td>
                        <td>{{ $rp -> fecha}}</td>
                        <td>{{ $rp -> tipo}}</td>
                        <td>{{ $rp -> precio_total}}</td>
                        <td>{{ $rp -> factura}}</td>
                        <td>
                            <!-- Acciones -->
                            <!-- Editar -->
                            <form action="{{ url('/registro_producto/'.$rp->id.'/edit') }}" class="d-inline">
                                <button type="submit" class="btn btn-warning" data-toggle="tooltip"
                                    data-placement="bottom" title="Editar movimiento">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>
                            <!-- Borrar -->
                            <form action="{{ url('/registro_producto/'.$rp->id) }}" class="d-inline" method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger" data-toggle="tooltip"
                                    data-placement="bottom" title="Eliminar movimiento"
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


</body>

<!-- JavaScript opcional-->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<!-- dataTables JS -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>


<script>
$('#tablaregistros').DataTable({
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