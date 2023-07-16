<h1>{{isset($modo) ? $modo : 'Formulario'}} registro</h1>
<br>

<style>
div {
    max-width: 10000px;
}
</style>

<form class="col">
    <div class="form-group">
        <label for="precio_total"> Precio total * </label>
        <input type="number" class="form-control @error('precio_total') is-invalid @enderror" name="precio_total"
            value="{{ isset($rp->precio_total) ? $rp->precio_total : old('precio_total') }}" id="precio_total"
            placeholder="0" />
        @error('precio_total')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="fecha"> Fecha * </label>
        <input type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha"
            value="{{ isset($rp->fecha) ? $rp->fecha : old('fecha') }}" id="fecha" />
        @error('fecha')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div>
        <label for="tipo"> Tipo * </label>
        <select id="tipo" class="form-control @error('tipo') is-invalid @enderror" name="tipo"
            value="{{ isset($rp->tipo) ? $rp->tipo : old('tipo') }}" />
        <option value="default"> Seleccione el tipo</option>
        <option value="compra"> Compra</option>
        <option value="venta"> Venta</option>
        </select>
        @error('tipo')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <br>
    <div class="form-group">
        <label for="factura"> Factura </label>
        <input type="number" class="form-control" name="factura"
            value="{{ isset($rp->factura) ? $rp->factura : old('factura') }}" id="factura">
        @error('factura')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        * Indica un campo requerido.
    </div>
    <div>
        <input class="btn btn-success" type="submit" value="Guardar datos" id="guardar datos">
        <a href="{{ url( 'registro_producto' ) }}" class="btn btn-warning"> Volver </a>
    </div>
</form>