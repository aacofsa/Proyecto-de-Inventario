@extends('layouts.app')

@section('content')


<form action="{{url('/bodega')}}" method="post" enctype="multipart/form-data"> <!--entype permite que se puedan enviar archivos-->
@csrf    <!--llave de seguridad-->

@include('bodega.form',['modo'=>'Crear']) <!--llama a form.blade-->

</form>


@endsection