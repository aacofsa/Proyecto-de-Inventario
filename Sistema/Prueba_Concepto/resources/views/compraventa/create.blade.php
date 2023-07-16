@extends('layouts.app')

@section('content')

<form action="{{ url('/compraventa') }}" method="post" enctype="multipart/form-data">
    @csrf

    @include('compraventa.partials.form',['modo'=>'Crear'])

</form>

@endsection