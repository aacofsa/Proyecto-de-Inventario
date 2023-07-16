@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="justify-content: center">Modificar Empresa</h1>
        <form action="/empresa/{{$empresa->id}}" method="POST">
            @csrf
            @method('PATCH')
            @include('empresa.partials.form')
            <div class="container mt-2" style="display: flex; justify-content: right;">
                <button type="submit" class="btn btn-primary me-2 btn-xs">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true">Guardar cambios</span>
                </button>
                <a href="{{ url('/empresa/') }}" class="btn btn-info btn-xs">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true">Volver</span>
                </a>
            </div>
            
        </form>
    </div>
   
    <script>
        async function update(id) {
            const data = {
              nombre: document.getElementById("nombre").value == '' ? undefined : document.getElementById("nombre").value,
              telefono: document.getElementById("telefono").value == '' ? undefined : document.getElementById("telefono").value,
              correo: document.getElementById("correo").value == '' ? undefined : document.getElementById("correo").value,
              direccion: document.getElementById("direccion").value == '' ? undefined : document.getElementById("direccion").value,
              rl_nombre: document.getElementById("rl_nombre").value == '' ? undefined : document.getElementById("rl_nombre").value,
              rl_paterno: document.getElementById("rl_paterno").value == '' ? undefined : document.getElementById("rl_paterno").value,
              rl_materno: document.getElementById("rl_materno").value == '' ? undefined : document.getElementById("rl_materno").value,
              rl_telefono: document.getElementById("rl_telefono").value == '' ? undefined : document.getElementById("rl_telefono").value,
              rl_correo: document.getElementById("rl_correo").value == '' ? undefined : document.getElementById("rl_correo").value,
            }
            console.log(data)
            const result = await axios.patch('http://localhost:8000/api/empresa/'+id, data);
            if(result.data.status=='ok'){
                await swal("Exito!", 'Empresa modificada correctamente', "success")
                location.replace('http://localhost:8000/empresa');
            }else{
                console.error(result.data.errores);
                await swal("Error!", result.data.message, "error");
            }
        }
    </script>
@endsection
