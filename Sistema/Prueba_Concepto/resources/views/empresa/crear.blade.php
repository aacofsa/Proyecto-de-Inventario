@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="justify-content: center">Registrar Empresa</h1>
        
        <form method="POST" action="/empresa" style="margin-top: 2%">
            @csrf()
            @include('empresa.partials.form')


            <div class="row">
                <div class="col mt-2" style="display: flex; justify-content: left;">
                    <p>Los campos con <a style="color: tomato; bold">*</a> son requeridos</p>
                </div>

                <div class="col mt-2" style="display: flex; justify-content: right;">
                    <button type="submit" class="btn btn-primary  me-2 btn-xs">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true">Guardar Datos</span>
                    </button>
                    <a href="{{ url('/empresa/') }}" class="btn btn-info btn-xs">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true">Volver</span>
                    </a>
                </div>
            </div>
        </form>
    </div>
    
    <script>
        async function create() {
            const data = {
              rut: document.getElementById("rut").value,
              nombre: document.getElementById("nombre").value,
              telefono: document.getElementById("telefono").value,
              correo: document.getElementById("correo").value,
              direccion: document.getElementById("direccion").value,
              rl_rut: document.getElementById("rl_rut").value,
              rl_nombre: document.getElementById("rl_nombre").value,
              rl_paterno: document.getElementById("rl_paterno").value,
              rl_materno: document.getElementById("rl_materno").value,
              rl_telefono: document.getElementById("rl_telefono").value,
              rl_correo: document.getElementById("rl_correo").value,
              activo: true
            }
            const result = await axios.post('http://localhost:8000/api/empresa/', data);
            if(result.data.status=='ok'){
                await swal("Exito!", 'Empresa creada correctamente', "success")
                location.replace('http://localhost:8000/empresa');
            }else{
                console.error(result.data.errores);
                await swal("Error!", result.data.message, "error");
            }      
        }
    </script>
@endsection