@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css"> 

@if(Session::has('mensaje'))
{{Session::get('mensaje')}}
@endif
<br/>
<a href="{{ url('acceso_bodega/create') }}" class="btn btn-success"> Registrar nuevo lote </a>
<br/>
<table class="table table-light" id="acceso_bodega">

    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Email Usuario</th>
            <th>ID Bodega</th>
            <th>Activo</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach( $acceso_bodegas as $acceso_bodega )
        <tr>
            <td>{{ $acceso_bodega->id }}</td>
            <td>{{ $acceso_bodega->email_usuario }}</td>
            <td>{{ $acceso_bodega->id_bodega }}</td>
            @if($acceso_bodega->activo == true)
                    <td>Activo</td>
                @else
                    <td>Inactivo</td>
                @endif
            <td>
                <a href="{{ url( '/acceso_bodega/'.$acceso_bodega->id.'/edit' ) }}">
                    <i class="fas fa-edit"></i>
                </a>    
                <form action="{{ url( '/acceso_bodega/'.$acceso_bodega->id )}}" method="post">
                @csrf
                {{ method_field('DELETE') }}
                <button type="submit" onclick="return cofirm('¿Quieres borrar?')" value="Borrar">
                <i class="fas fa-trash"></i>
                </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
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
$('#acceso_bodega').DataTable({
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