@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">

<style>
    .header-alineado {
        display: flex;
        justify-content: space-between;
    }
    .boton {
        width: 50px;
        height: 38px;
    }
</style>

    <br>
    <div class="header-alineado">
    <h1>Tabla de usuarios</h1>

    <a href="{{ url('/usuario/create') }}" style="align-self: center; width: 150px" class="btn btn-success">Crear usuario</a>
    </div>
    <br>
    @if(Session::has('msg_usuario_eliminado'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('msg_usuario_eliminado') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif
    
    @if(Session::has('msg_usuario_creado'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('msg_usuario_creado') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @if(Session::has('msg_usuario_modificado'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('msg_usuario_modificado') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered" id="usuarios">

                <thead>
                    <tr>
                        <th class="align-middle text-center">Empresa</th>
                        <th class="align-middle text-center">Rol</th>
                        <th class="align-middle text-center">Nombre</th>
                        <th class="align-middle text-center">Apellido Paterno</th>
                        <th class="align-middle text-center">Apellido Materno</th>
                        <th class="align-middle text-center">Estado</th>
                        <th class="align-middle text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($usuario as $user)
                    <tr>
                        <td class="align-middle">
                        @foreach($empresas as $empresa)
                            @if($user->id_empresa == $empresa->id)
                                {{ $empresa -> nombre }}
                                @break
                            @endif
                        @endforeach
                        </td>
                        <td class="align-middle">
                        @if($user->rol == 'empleado')
                            Empleado
                        @elseif($user->rol == 'admin')
                            Dueño
                        @endif
                        </td>
                        <td class="align-middle">{{ $user -> nombre }}</td>
                        <td class="align-middle">{{ $user -> apellido_paterno }}</td>
                        <td class="align-middle">{{ $user -> apellido_materno }}</td>
                        <td class="align-middle" style="width: 10%; white-space: nowrap;">
                        @if($user->activo == true)
                            Activo
                        @else
                            Inactivo
                        @endif
                        </td>
                        <td class="align-middle" style="width: 1%; white-space: nowrap;">

                        <form action="{{ url('/usuario/'.$user->email.'/edit') }}" class="d-inline">
                            <button type="submit" class="btn btn-warning boton" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Editar usuario">
                                <i class="fas fa-user-edit"></i>
                            </button>
                        </form>

                        <form action="{{ url('/usuario/'.$user->email) }}" class="d-inline" method="post">
                            @csrf
                            
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger boton" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Eliminar usuario" onclick="return confirm('¿Estás seguro/a que deseas eliminar este usuario?')">
                                <i class="fas fa-user-times"></i>
                            </button>
                        </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script>
    $('#usuarios').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ usuarios por página",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No existen usuarios que mostrar",
            "infoFiltered": "(filtrado de un total de _MAX_ usuarios)",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar",
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
        },
        "columns": [{},{},{},{},{"orderable": false},{},{"orderable": false}
        ]
    });
</script>
<script>
    $(document).ready(function() {
    $('#usuarios').DataTable( {
        responsive: true
    } );
} );
</script>
@endsection