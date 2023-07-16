@extends('layouts.app')

@section('content')


<form action="{{url('/bodega/'.$bodega->id)}}" method="post">
@csrf
{{ method_field('PATCH')}}
@include('bodega.form',['modo'=>'Editar']) 
</form>


@endsection
