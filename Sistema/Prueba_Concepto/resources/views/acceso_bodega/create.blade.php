@extends('layouts.app')

@section('content') 
<form action="{{ url('/acceso_bodega') }}" method="post">
@csrf
@include('acceso_bodega.form',['modo'=>'Crear'])

</form>
@endsection