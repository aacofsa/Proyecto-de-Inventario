<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped" id="tabla_empresa">
            <thead class="thead-light">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Rut</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Telefono</th>
                    <th class="text-center">Correo</th>
                    <th class="text-center">Direccion</th>
                    <th class="text-center">Activo</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empresas as $empresa)
                    <tr>
                        <td class="text-center">{{ $empresa->id }}</td>
                        <td class="text-center">{{ $empresa->rut }}</td>
                        <td class="text-center">{{ $empresa->nombre }}</td>
                        <td class="text-center">{{ $empresa->telefono }}</td>
                        <td class="text-center">{{ $empresa->correo }}</td>
                        <td class="text-center">{{ $empresa->direccion }}</td>
                        <td class="text-center">
                            <div class="form-check form-switch" style="display: flex; justify-content: center;">
                                <input class="form-check-input" type="checkbox" role="switch" @if ($empresa->activo) checked @endif
                                    onclick="turnActive({{ $empresa->id }}, {{ $empresa->activo }})">
                            </div>
                        </td>
                        <td class="text-center">
                            <a href="{{ url('/empresa/' . $empresa->id . '/ver') }}" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </a>
                            <a href="{{ url('/empresa/' . $empresa->id . '/modificar') }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<script>
    $('#tabla_empresa').DataTable({
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
        try {
            const url = "{{ url('api/empresa') }}/" + id;
            const result = await axios.patch(url, data);
        } catch (err) {
            console.error(err);
            await swal.fire("Error!", 'Problema de conexion', "error");
            location.reload();
            return;
        }

        await swal.fire("Exito!", 'Empresa ' + accion + ' correctamente', "success")
        location.reload();
    }
</script>
