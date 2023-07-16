
<h1>{{ $modo }} lote </h1>
<br>
<label for="id_producto"> ID Producto</label>
<input type="text" name="id_producto" value="{{ isset($lote->id_producto)?$lote->id_producto:'' }}" id="id_producto" 
    required    
    oninvalid="this.setCustomValidity('Ingrese el ID del producto')"
    oninput="this.setCustomValidity('')">
    
<br>

<label for="id_registro"> ID Registro</label>
<input type="text" name="id_registro" value="{{ isset($lote->id_registro)?$lote->id_registro:'' }}" id="id_registro"
    required    
    oninvalid="this.setCustomValidity('Ingrese el ID del registro')"
    oninput="this.setCustomValidity('')"
    >
<br>

<label for="cantidad"> Cantidad</label>
<input type="text" name="cantidad" value="{{ isset($lote->cantidad)?$lote->cantidad:'' }}" id="cantidad"
    required    
    oninvalid="this.setCustomValidity('Ingrese cantidad')"
    oninput="this.setCustomValidity('')">
<br>

<label for="precio_unitario"> Precio Unitario</label>
<input type="text" name="precio_unitario" value="{{ isset($lote->precio_unitario)?$lote->precio_unitario:'' }}" id="precio_unitario"
    required    
    oninvalid="this.setCustomValidity('Ingrese el precio unitario')"
    oninput="this.setCustomValidity('')">
<br>

<input type="submit" value="{{ $modo }} datos">

<a href="{{ url('lote/') }}"> Regresar </a>

<br>