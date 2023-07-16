
<br>
<h1>{{ $modo }} Bodega</h1>
<br><br>



<body>
    <p class="text-danger">* Obligatorio</p>
    <br>

    <div class="form-group">
        <label for="id_comuna">Comuna</label>
        <lavel for="id_comuna" class="text-danger"> *</lavel>

        <select class="form-select" name="id_comuna" id="id_comuna">
            <option selected disabled value="">--Seleccione la Comuna--</option>
            @foreach($comunas as $comuna)
            <option value="{{ $comuna->id }}" @if (isset($bodega->id_comuna) && $bodega->id_comuna == $comuna->id) selected @endif>{{$comuna->nombre}}</option>
            @endforeach
        </select>

        
      

        <br>

    </div>

    <div class="form-group">
        <label for="id_empresa">Empresa</label>
        <lavel for="id_empresa" class="text-danger"> *</lavel>

        <select class="form-select" name="id_empresa" id="id_empresa">
            <option selected disabled value="">--Seleccione la Empresa--</option>
            @foreach($empresas as $empresa)
            <option value="{{ $empresa->id }}" @if (isset($bodega->id_empresa) && $bodega->id_empresa == $empresa->id) selected @endif>{{ $empresa->nombre }}</option>
            @endforeach
        </select>

        

        <br>

    </div>

    <div class="form-group">
        <label for="nombre"> Nombre Bodega</label>
        <lavel for="nombre" class="text-danger"> *</lavel>
        <input type="text" class="form-control {{$errors->has('nombre')?'is-invalid':''}} " name="nombre" value="{{isset($bodega->nombre)?$bodega->nombre:old('nombre') }}" id="nombre">

        {!! $errors->first('nombre','<div class="invalid-feedback">:message</div>') !!}
        <!--Si se encuentra un error en ese campo mostrara el mensaje de error-->

        <br>

    </div>

    <div class="form-group">
        <label for="descripcion"> Descripción de la Bodega</label>
        <lavel for="descripcion" class="text-danger"> *</lavel>
        <input type="text" class="form-control {{$errors->has('descripcion')?'is-invalid':''}} " name="descripcion" value="{{isset($bodega->descripcion)?$bodega->descripcion:old('descripcion')}}" id="descripcion">

        {!! $errors->first('descripcion','<div class="invalid-feedback">:message</div>') !!}

        <br>

    </div>

    <div class="form-group">
        <label for="direccion"> Dirección de la Bodega</label>
        <lavel for="direccion" class="text-danger"> *</lavel>
        <input type="text" class="form-control {{$errors->has('direccion')?'is-invalid':''}} " name="direccion" value="{{isset($bodega->direccion)?$bodega->direccion:old('direccion')}}" id="direccion">

        {!! $errors->first('direccion','<div class="invalid-feedback">:message</div>') !!}

        <br>

    </div>

    <div class="form-group">
        <label for="correo_encargado"> Correo de Encargado</label>
        <input type="text" class="form-control {{$errors->has('correo_encargado')?'is-invalid':''}} " name="correo_encargado" value="{{isset($bodega->correo_encargado)?$bodega->correo_encargado:old('correo_encargado')}}" id="correo_encargado">

        {!! $errors->first('correo_encargado','<div class="invalid-feedback">:message</div>') !!}

        <br>

    </div>

    <div class="form-group">
        <label for="telefono_encargado"> Teléfono de Encargado</label>
        <input type="text" class="form-control {{$errors->has('telefono_encargado')?'is-invalid':''}} " name="telefono_encargado" value="{{isset($bodega->telefono_encargado)?$bodega->telefono_encargado:old('telefono_encargado')}}" id="telefono_encargado">

        {!! $errors->first('telefono_encargado','<div class="invalid-feedback">:message</div>') !!}

        <br>

    </div>

    <div class="form-group">
        <label for="hora_funcionamiento"> Hora de Funcionamiento</label>
        <input type="text" class="form-control {{$errors->has('hora_funcionamiento')?'is-invalid':''}} " name="hora_funcionamiento" value="{{isset($bodega->hora_funcionamiento)?$bodega->hora_funcionamiento:old('hora_funcionamiento')}}" id="hora_funcionamiento">

        {!! $errors->first('hora_funcionamiento','<div class="invalid-feedback">:message</div>') !!}

        <br>

    </div>

    <input class="btn btn-success" type="submit" value="{{ $modo }} datos">

    <a class="btn btn-primary" href="{{url('bodega/')}}"> Regresar </a>

    <br><br>
</body>

