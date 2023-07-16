@extends('layouts.app')

@section('content')
<form action="{{ url('/registro_producto') }}" method="post" enctype="multipart/form-data">
    @csrf

    @include('registro_producto.form',['modo'=>'Crear'])

</form>

@endsection