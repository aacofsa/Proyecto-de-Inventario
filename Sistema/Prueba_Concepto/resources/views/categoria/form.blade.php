<h1>{{ $modo}} categoria </h1>
@if(count($errors)>0)
<div class="alert alert-primary" role="alert">
   <ul> 
    @foreach($errors->all() as $error)
   <li> {{$error}}</li>
    @endforeach
</ul>
</div>

@endif
<br>
<label for="nombre">Nombre categoria </label>
<input type="text" name="nombre" value="{{ isset($categoria->nombre)?$categoria->nombre:''}}" id="nombre">
<br>
<label for="description"> Descripción</label>
<input type="text" name="description" value="{{ isset($categoria->description)?$categoria->description:old('description')}}">
<br>
<input type="submit" value="{{$modo}} categoria">
<a href="{{ url('/categoria/')}}">Regresar</a>
<br>