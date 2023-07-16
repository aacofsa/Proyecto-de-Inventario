@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css"> 

@if(Session::has('mensaje'))
{{Session::get('mensaje')}}
@endif
<br/>
<a href="{{ url('lote/create') }}" class="btn btn-success"> Registrar nuevo lote </a>
<br/>
<br/>
<table class="table table-light" id="lote">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>ID Producto</th>
            <th>ID Registro</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($lotes as $lote)
        <tr>
            <td>{{$lote->id}}</td>
            <td>{{$lote->id_producto}}</td>
            <td>{{$lote->id_registro}}</td>
            <td>{{$lote->cantidad}}</td>
            <td>{{$lote->precio_unitario}}</td>
            <td>
            <a href="{{ url('/lote/'.$lote->id.'/edit') }}" class="btn btn-warning">
              <i class="fas fa-edit"></i>
            </a> 
            

            <form action="{{ url('/lote/'.$lote->id) }}" class="d-inline" method="post">
            @csrf
            {{method_field('DELETE')}}
            <button type="submit" onclick="return confirm('¿Desea borrar este lote?')" class="btn btn-danger">
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
$('#lote').DataTable({
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