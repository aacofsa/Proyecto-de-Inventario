@extends('layouts.app')

@section('content')

<form action="{{ url('/compraventa/'.$rp->id) }}" method="post" enctype="multipart/form-data">
    @csrf

    {{ method_field('PUT') }}
    @include('compraventa.partials.form',['modo'=>'Editar'])

</form>

@endsection