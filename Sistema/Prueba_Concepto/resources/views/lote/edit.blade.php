
@extends('layouts.app')

@section('content') 
<form action="{{ route('lote.update',$lote->id) }}" method="post">
@csrf 
{{ method_field('PATCH') }}

@include('lote.form',['modo'=>'Editar'])

</form>
@endsection
