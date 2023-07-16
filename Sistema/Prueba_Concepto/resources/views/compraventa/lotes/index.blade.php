@extends('layouts.app')

@section('content')

<style>
div {
    max-width: 300px;
}
</style>

<body>

    <h1>Lotes de {{$registro->tipo}} ID {{$registro->id}}</h1>
    <br>

    @if(Session::has('mensajeSuccess'))
    <div class="alert alert-success alert-dismissible fade show" role="alert"> {{ Session::get('mensajeSuccess') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    
    <p>
        Registro is {{$registro}}
    </p>
    <p>
        Data is {{$datos}}
    </p>

</body>

@endsection