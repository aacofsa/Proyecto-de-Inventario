
@extends('layouts.app')

@section('content') 
<form action="{{ url('/lote') }}" method="post">
@csrf 
@include('lote.form',['modo'=>'Crear'])
</form>
@endsection