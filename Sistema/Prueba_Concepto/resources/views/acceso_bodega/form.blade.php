<h1>{{$modo}} Acceso a bodega </h1>
<div class="form-group">

<label for="email_usuario"> Email Usuario</label>
<input type="text" class="form-control" name="email_usuario" value=" {{ isset($acceso_bodega->email_usuario)?$acceso_bodega->email_usuario:'' }} " id="email_usuario">
<br>
</div>
<div class="form-group">
<label for="id_bodega"> ID Bodega</label>
<input type="text" class="form-control" name="id_bodega" value=" {{ isset($acceso_bodega->id_bodega)?$acceso_bodega->id_bodega:'' }} " id="id_bodega">
<br>
<div class="form-check">
            <input class="form-check-input" type="checkbox" name="activo" id="activo" @if (isset($acceso_bodega->activo) && $acceso_bodega->activo || !isset($acceso_bodega->activo)) checked @endif>
            <label class="form-check-label" for="activo">
                Activo
            </label>
        </div>
<div class="form-group">
<input type="submit" value="{{$modo}} datos">
<a href="{{ url('acceso_bodega/') }}"> Regresar </a>
<br>
</div>