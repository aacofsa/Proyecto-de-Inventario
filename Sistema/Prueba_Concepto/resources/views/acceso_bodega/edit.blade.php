@extends('layouts.app')

@section('content') 
<form action="{{ url('/acceso_bodega/'.$acceso_bodega->id) }}" method="post">
@csrf
{{ method_field('PATCH') }}

@include('acceso_bodega.form',['modo'=>'Editar'])

</form>
@endsection