@extends('layouts.app')

@section('content')

<form action="{{ url('/registro_producto/'.$rp->id ) }}" method="post" enctype="multipart/form-data">
    @csrf

    {{ method_field('PATCH') }}

    @include('registro_producto.form',['modo'=>'Editar'])

</form>

@endsection