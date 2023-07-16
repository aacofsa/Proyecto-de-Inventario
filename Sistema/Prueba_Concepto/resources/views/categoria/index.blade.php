@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">


@if(Session::has('mensaje'))
<div class="alert alert-success alert-dismissible" role="alert">
    {{Session::get('mensaje')}}

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    </button>
    @endif
</div>
<br>
<div style="display: flex; justify-content: space-between;">
    <h1>Categorias</h1>

    <a href="{{ url('/categoria/create')}}" style="align-self: center;" class="btn btn-success">Registrar nueva categoria</a>
</div>
<br>

<br>
<br>
<table class="table table-light" id="categoria">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categorias as $datos)
        <tr>
            <td>{{ $datos->id }}</td>
            <td>{{$datos->nombre}}</td>
            <td>{{$datos-> description }}</td>
            <td>
                <form action="{{url('/categoria/'.$datos->id.'/edit')}}" class="d-inline">
                    <button type="submit" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="editar categoria">
                        <i class="fas fa-edit"></i>
                    </button>
                </form>



                <form action="{{ url('/categoria/'.$datos->id)}}" class="d-inline" method="post">
                    @csrf
                    {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="borrar categoria" onclick="return confirm ('¿Desea borrar?')"><i class="fas fa-trash"></i>
                    </button>
                </form>


            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<br>
<br>
<br>
<br>

<a href="{{ url('producto')}}" class="btn btn-success">Volver a Producto</a>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

<script>
$('#categoria').DataTable({
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