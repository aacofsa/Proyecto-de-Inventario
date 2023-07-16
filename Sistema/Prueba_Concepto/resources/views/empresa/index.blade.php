@extends('layouts.app')

@section('content') 
    <div class="container mt-5">
        <h1>Empresas</h1>
        <a class="btn btn-success pull-right mt-3" href="{{ url('/empresa/crear') }}" role="button">Registrar nueva empresa</a>
        @include('empresa.partials.tabla')
    </div>
    
@endsection