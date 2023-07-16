@extends('layouts.app')
@section('content')

<br>
<br>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>Categoria</th>
            <th>Nombre</th>
            <th>descripcion</th>
            <th>Stock</th>
            <th>Foto</th>
            <th>Peso</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>
        @foreach($datos as $pro)
        <tr>
            <td>{{$pro->id_categoria}}</td>
            <td>{{$pro->nombre}}</td>
            <td>{{$pro->descripcion}}</td>
            <td>{{$pro->stock}}</td>
            <td>{{$pro->foto}}</td>
            <td>{{$pro->peso}}</td>
            <td>{{$pro->precio}}</td>
        </tr>

        @endforeach


    </tbody>
</table>
@endsection