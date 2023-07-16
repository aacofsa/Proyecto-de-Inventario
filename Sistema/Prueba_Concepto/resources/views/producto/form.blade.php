<h1> {{ $modo }} producto </h1>

<br>

<label for="id_categoria" class="text-danger"> (*) Obligatorio </label>

<br><br>

<div class="form-group">
    <label for="id_categoria"> Categoria </label> <label for="id_categoria" class="text-danger"> (*) </label>
    <select class="form-select" name='id_categoria' id='id_categoria'>
        @foreach ($categoria as $cat)
        <option value="{{ $cat->id }}"> {{ $cat->nombre }} </option>
        @endforeach
    </select>
    <br>
</div>

<div class="form-group">
    <label for="nombre"> Nombre </label> <label for="id_categoria" class="text-danger "> (*) </label>
    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ isset($producto->nombre)?$producto->nombre:old('nombre') }}" id="nombre">
    @error('nombre')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="descripcion"> Descripcion </label> <label for="id_categoria" class="text-danger"> (*) </label>
    <input type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ isset($producto->descripcion)?$producto->descripcion:old('descripcion') }}" id="descripcion">
    @error('descripcion')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="dimensiones"> Dimensiones </label> <label for="id_categoria" class="text-danger"> (*) </label>
    <input type="text" class="form-control @error('dimensiones') is-invalid @enderror" name="dimensiones" value="{{ isset($producto->dimensiones)?$producto->dimensiones:old('dimensiones')}}" id="dimensiones">
    @error('dimensiones')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="stock"> Stock </label> <label for="id_categoria" class="text-danger"> (*) </label>
    <input type="text" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ isset($producto->stock)?$producto->stock:old('stock')}}" id="stock">
    @error('stock')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="peso"> Peso </label> <label for="id_categoria" class="text-danger"> (*) </label>
    <input type="text" class="form-control @error('peso') is-invalid @enderror" name="peso" value="{{ isset($producto->peso)?$producto->peso:old('peso')}}" id="peso">
    @error('peso')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="foto"> Foto </label> <label for="id_categoria" class="text-danger"> (*) </label>
    @if(isset($producto->foto))
    <img src="{{ asset('storage').'/'.$producto->foto }}" width="100" alt="">
    @endif
    <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" value="" id="foto">
    @error('foto')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
    <br>
</div>

<div class="form-group">
    <label for="precio"> Precio </label> <label for="id_categoria" class="text-danger"> (*) </label>
    <input type="text" class="form-control @error('precio') is-invalid @enderror" name="precio" value="{{ isset($producto->precio)?$producto->precio:old('precio')}}" id="precio">
    @error('precio')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
    <br>
</div>

<input type="submit" class="btn btn-success" value="{{ $modo }} Datos">

<a class="btn btn-primary" href="{{  url('producto/') }}"> Regresar </a>

<br>