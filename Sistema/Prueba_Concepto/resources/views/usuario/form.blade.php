<div style="display: flex; justify-content: space-between">
<h1>{{ $titulo }}</h1>

<a class="btn btn-primary" style="align-self: center; width: 100px" href="{{ url('/usuario') }}">Volver</a>
</div>
<br>
<br>

<div class="col-md-3">
    @if(isset($usuario->foto)) 
        <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$usuario->foto }}" id="imgUsuario" style="width:90%; max-height: auto;" alt="Foto de {{ isset($usuario -> nombre) ? $usuario -> nombre : old('nombre') }} {{ isset($usuario -> apellido_paterno) ? $usuario -> apellido_paterno : old('apellido_paterno') }}">
    @else
        <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/uploads/default_user_image.png' }}" id="imgUsuario" style="width:90%; max-height: auto;" alt="Foto de {{ isset($usuario -> nombre) ? $usuario -> nombre : old('nombre') }} {{ isset($usuario -> apellido_paterno) ? $usuario -> apellido_paterno : old('apellido_paterno') }}">
    @endif
</div>

<div class="col-md-9">
    <div class="row">
        <div class="col-md-6 pb-2">
            <label class="form-label" for="Empresa">Empresa</label>
            <select class="form-select" name="id_empresa" id="Empresa">
                @foreach($empresas as $empresa)
                    <option value="{{ $empresa->id }}" @if (isset($usuario->id_empresa) && $usuario->id_empresa == $empresa->id) selected @endif>{{ $empresa->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 pb-2">
            <label class="form-label" for="Rol">Rol</label>
            <select class="form-select" name="rol" id="Rol">
                <option value="admin" @if (isset($usuario->rol) && $usuario->rol == 'admin') selected @endif>Dueño</option>
                <option value="empleado" @if (isset($usuario->rol) && $usuario->rol == 'empleado') selected @endif>Empleado</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 pb-2">
            <label class="form-label" for="Nombre">Nombre</label> <label class="text-danger">*</label>
            <input class="form-control @error('nombre') is-invalid @enderror" type="text" name="nombre" value="{{ isset($usuario -> nombre) ? $usuario -> nombre : old('nombre') }}" placeholder="Nombre" id="Nombre" autocomplete="name">
            @error('nombre')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-md-4 pb-2">
            <label class="form-label" for="ApellidoPaterno">Apellido paterno</label> <label class="text-danger">*</label>
            <input class="form-control @error('apellido_paterno') is-invalid @enderror" type="text" name="apellido_paterno" value="{{ isset($usuario -> apellido_paterno) ? $usuario -> apellido_paterno : old('apellido_paterno') }}" placeholder="Apellido Paterno" id="ApellidoPaterno">
            @error('apellido_paterno')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-md-4 pb-2">
            <label class="form-label" for="ApellidoMaterno">Apellido materno</label> <label class="text-danger">*</label>
            <input class="form-control @error('apellido_materno') is-invalid @enderror" type="text" name="apellido_materno" value="{{ isset($usuario -> apellido_materno) ? $usuario -> apellido_materno : old('apellido_materno') }}" placeholder="Apellido Materno" id="ApellidoMaterno">
            @error('apellido_materno')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 pb-2">
            <label class="form-label" for="RUT">RUT</label>
            <input class="form-control @error('rut') is-invalid @enderror" type="text" name="rut" value="{{ isset($usuario -> rut) ? $usuario -> rut : old('rut') }}" placeholder="RUT" id="RUT">
            @error('rut')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-md-6 pb-2">
            <label class="form-label" for="FechaNacimiento">Fecha de nacimiento</label> <label class="text-danger">*</label>
            <input class="form-control @error('fecha_nacimiento') is-invalid @enderror" type="date" name="fecha_nacimiento" value="{{ isset($usuario -> fecha_nacimiento) ? $usuario -> fecha_nacimiento : old('fecha_nacimiento') }}" id="FechaNacimiento">
            @error('fecha_nacimiento')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 pb-2">
            <label class="form-label" for="Email">Correo electrónico</label> <label class="text-danger">*</label>
            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ isset($usuario -> email) ? $usuario -> email : old('email') }}" placeholder="Correo electrónico" id="Email" autocomplete="email">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-md-6 pb-2">
            <label class="form-label" for="Clave">Clave</label> <label class="text-danger">*</label>
            <input class="form-control @error('clave') is-invalid @enderror" type="password" autocomplete="false" spellcheck="false" name="clave" value="{{ isset($usuario -> clave) ? $usuario -> clave : old('clave') }}" placeholder="Clave" id="Clave" autocomplete="new-password">
            @error('clave')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 pb-3">
            <label class="form-label" for="Foto">Foto</label>
            <input class="form-control @error('foto') is-invalid @enderror" accept="image/jpg, image/jpeg, image/png" type="file" name="foto" value="" id="Foto">
            @error('foto')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    @if ($titulo != 'Registrar nuevo usuario')
    <div class="col-md-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="activo" id="activo" @if (isset($usuario->activo) && $usuario->activo || !isset($usuario->activo)) checked @endif>
            <label class="form-check-label" for="activo">
                Usuario activo
            </label>
        </div>
    </div>
    @endif

<div class="form-group" style="width: 80%; float: right">
    <br>
    <input class="btn btn-success" style="float: right; width: 150px" type="submit" value="{{ $boton }}">
</div>
</div>

<br>
<br>
<br>
<br>
</div>

<script>
    Foto.onchange = evt => {
        const [file] = Foto.files
        if (file && (file.type == "image/jpg" || file.type == "image/jpeg" || file.type == "image/png")) {
            imgUsuario.src = URL.createObjectURL(file)
        } else {
            imgUsuario.src = "{{ asset('storage').'/uploads/default_user_image.png' }}"
        }
    }
</script>
