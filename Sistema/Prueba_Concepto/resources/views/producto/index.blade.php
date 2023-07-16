@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">

<br>

<div style="display: flex; justify-content: space-between">
    <h1> Productos </h1>
    <div>
        <a class="btn btn-success" style="align-self: center; width: 210px" href="{{  url('producto/create') }}"> Registrar nuevo producto </a>

        <a class="btn btn-primary" style="align-self: center; width: 210px" href="{{  url('categoria') }}"> Registrar nueva categoria </a>
    </div>
</div>

<br>

@if(Session::has('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ Session::get('mensaje') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    </button>
</div>
<br>
@endif

<body>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered" id="productos">
                <thead class="thead-light">
                    <tr>
                        <th class="align-middle">ID</th>
                        <th class="align-middle">Categoria</th>
                        <th class="align-middle">Nombre</th>
                        <th class="align-middle">Descripcion</th>
                        <th class="align-middle">Dimensiones</th>
                        <th class="align-middle">Stock</th>
                        <th class="align-middle">Peso</th>
                        <th class="align-middle">Foto</th>
                        <th class="align-middle">Precio</th>
                        <th class="align-middle">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($producto as $product)
                    <tr>
                        <td class="align-middle">{{$product->id}}</td>
                        @foreach($categoria as $cat)
                        @if($product->id_categoria == $cat->id)
                        <td class="align-middle"> {{ $cat -> nombre }} </td>
                        @break
                        @endif
                        @endforeach
                        <td class="align-middle">{{$product->nombre}}</td>
                        <td class="align-middle">{{$product->descripcion}}</td>
                        <td class="align-middle">{{$product->dimensiones}}</td>
                        <td class="align-middle">{{$product->stock}}</td>
                        <td class="align-middle">{{$product->peso}}</td>
                        <td class="align-middle">
                            <img src="{{ asset('storage').'/'.$product->foto }}" witdh="100" height="100" alt="">
                        </td>
                        <td class="align-middle">{{$product->precio}}</td>
                        <td class="align-middle" style="width: 1%; white-space: nowrap;">

                            <form action="{{ url('/producto/'.$product->id.'/edit')}}" class="d-inline">
                                <button type="submit" class="btn btn-warning" style="width: 50px; height: 38px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Editar producto">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>

                            <form class="d-inline" action="{{url('/producto/'.$product->id )}}" method="post">

                                @csrf
                                {{method_field('DELETE')}}

                                <button style="width: 50px; height: 38px" class="btn btn-danger" type="submit" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Eliminar producto" onclick="return confirm('¿Estás seguro/a que deseas eliminar este movimiento?')">
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
<br>
<a class="btn btn-success" href="{{  url('bodega') }}"> Volver a Bodega </a>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
<script>
    $('#productos').DataTable({
        responsive: true,
        autoWidth: false,
        "language": {
            "lengthMenu": "Mostrar _MENU_ productos por pagina",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No existen ptroductos que mostrar",
            "infoFiltered": "(filtrado de un total de _MAX_ productos)",
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