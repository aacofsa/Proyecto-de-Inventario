@extends('layouts.app')
@section('content')

<form action="{{ url('/categoria') }}" method="post">

 @csrf
@include('categoria.form',['modo'=>'Crear'])

</form>
@endsection