<h1>{{isset($modo) ? $modo : 'Formulario'}} compraventa</h1>
<br>

<style>
div #divReg {
    max-width: 300px;
}
</style>

<form class="col">
    <!-- Input tipo de movimiento: compra o venta -->
    <div id="divReg">
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

    <!-- Input Monto del movimiento -->
    <div class="form-group" id="divReg">
        <label for="precio_total"> Monto * </label>
        <input type="number" class="form-control @error('precio_total') is-invalid @enderror" name="precio_total"
            value="{{ isset($rp->precio_total) ? $rp->precio_total : old('precio_total') }}" id="precio_total"
            placeholder="0" />
        @error('precio_total')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- Input Fecha del movimiento -->
    <div class="form-group" id="divReg">
        <label for="fecha"> Fecha * </label>
        <input type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha"
            value="{{ isset($rp->fecha) ? $rp->fecha : old('fecha') }}" id="fecha" />
        @error('fecha')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- Input numero de factura -->
    <div class="form-group" id="divReg">
        <label for="factura"> Factura </label>
        <input type="number" class="form-control" name="factura"
            value="{{ isset($rp->factura) ? $rp->factura : old('factura') }}" id="factura">
        @error('factura')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- Notificacion de campos requeridos -->
    <div class="form-group" id="divReg">
        * Indica un campo requerido.
    </div>

    <!-- Botones para Continuar o, volver e ir a crear lotes -->

    <div>
        @if($modo == 'Crear' )
        <input class="btn btn-success" type="submit" id="guardar-datos" value="Guardar datos" name="redir">
        <input class="btn btn-primary" type="submit" id="continuar-lotes" value="Continuar a lotes" name="redir">
        @else

        @endif
        <a href="{{ url( 'compraventa' ) }}" class="btn btn-warning"> Volver </a>
    </div>