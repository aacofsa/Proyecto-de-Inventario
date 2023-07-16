@extends('layouts.app')

@section('content')

<br>
<form action="{{ url('/usuario') }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
@csrf

@include('usuario.form', ['boton'=>'Crear usuario', 'titulo'=>'Registrar nuevo usuario'])

</form>

@endsection