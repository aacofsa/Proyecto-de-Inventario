@extends('layouts.app')

@section('content')

@if(Session::has('mensaje'))
{{ Session::get('mensaje') }}
<br>
@endif

<div class="container">

    <form action="{{url('/producto')}}" method="post" enctype="multipart/form-data">
        @csrf
        @include('producto.form', ['modo'=>'Crear'])

    </form>

</div>
@endsection