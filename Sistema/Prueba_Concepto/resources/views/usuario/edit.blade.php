@extends('layouts.app')

@section('content')

<br>
<form action="{{ url('/usuario/'.$usuario->email) }}" method="post" enctype="multipart/form-data" class="row g-3">
@csrf
{{ method_field('PATCH') }}

@include('usuario.form', ['boton'=>'Guardar', 'titulo'=>'Modificar usuario'])

</form>

@endsection