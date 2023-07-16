@extends('layouts.app')

@section('content')


    <div class="container-fluid">

        <div class="container mt-4">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Empresa: {{ $empresa->nombre }}</h3>
                    <div class="card" style="width: 18rem;">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item">ID: {{ $empresa->id }}</li>
                          <li class="list-group-item">Rut: {{ $empresa->rut }}</li>
                          <li class="list-group-item">Telefono: {{ $empresa->telefono }}</li>
                          <li class="list-group-item">Correo: {{ $empresa->correo }}</li>
                          <li class="list-group-item">Dirección: {{ $empresa->direccion }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-6">
                    <h3 class="card-title">Representante:</h3>
                    <div class="card" style="width: 18rem;">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item">Nombre: {{ $empresa->rl_nombre }}</li>
                          <li class="list-group-item">Apellido P.: {{ $empresa->rl_paterno }}</li>
                          <li class="list-group-item">Apellido M.: {{ $empresa->rl_materno }}</li>
                          <li class="list-group-item">Rut: {{ $empresa->rl_rut }}</li>
                          <li class="list-group-item">Telefono: {{ $empresa->rl_telefono }}</li>
                          <li class="list-group-item">Correo: {{ $empresa->rl_correo }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row flex-row flex-nowrap mt-5 pb-2 pt-5" style="overflow-x: auto;">
            @if ( count($bodegas) == 0)
                <p>La empresa seleccionada no cuenta con bodegas actualmente</p>
            @else
                <div class="container">
                    <h3>Bodegas de la empresa:</h3>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="tabla_bodega_empresa">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Descripcion</th>
                                        <th class="text-center">Region</th>
                                        <th class="text-center">Comuna</th>
                                        <th class="text-center">Direccion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bodegas as $bodega)
                                        <tr>
                                            <td class="text-center">{{ $bodega->id }}</td>
                                            <td class="text-center">{{ $bodega->nombre }}</td>
                                            <td class="text-center">{{ $bodega->descripcion }}</td>
                                            <td class="text-center">{{ $bodega->comuna->region->nombre }}</td>
                                            <td class="text-center">{{ $bodega->comuna->nombre }}</td>
                                            <td class="text-center">{{ $bodega->direccion }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            
            
        </div>
            <a class="btn btn-primary pull-left" href={{ url("/empresa/$empresa->id/metricas") }} role="button">Ver metricas</a>
        </div>
    
        <script>
            $('#tabla_bodega_empresa').DataTable({
                responsive: true,
                autoWidth: false,
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
        
            async function turnActive(id, valorActual) {
                const data = {
                    activo: !valorActual
                }
                const accion = valorActual == true ? 'desactivada' : 'activada';
                try{ 
                    const url = "{{ url('api/empresa') }}/" + id;
                    const result = await axios.patch( url, data);
                }catch(err){
                    console.error(err);
                    await swal.fire("Error!", 'Problema de conexion', "error");
                    location.reload();
                    return;
                }
        
                await swal.fire("Exito!", 'Empresa ' + accion + ' correctamente', "success")
                location.reload();
            }
        </script>
        
@endsection
