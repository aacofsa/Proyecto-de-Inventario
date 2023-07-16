
<div class="form-group">
    <label for="rut">Rut de la empresa</label>
    <input
        id="rut"
        name="rut"
        type="text"
        class="form-control @error('rut') is-invalid @enderror"
        placeholder="11.111.111.1 o 11111111-1"
        value="@php
            if(old('rut')){
                print (old('rut'));
            }else if($empresa){
                print $empresa->rut;
            }
        @endphp"
    >
    @error('rut')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    
    <label for="nombre">Nombre de la empresa 
        @php
            if(!$empresa){ // si no esta en modo modificar empresa
                print '<a style="color: tomato; bold">*</a>';
            }
        @endphp
    </label>
    <input
        id="nombre"
        name="nombre"
        type="text"
        class="form-control @error('nombre') is-invalid @enderror"
        placeholder="Company"
        value="@php
            if(old('nombre')){
                print (old('nombre'));
            }else if($empresa){
                print $empresa->nombre;
            }
        @endphp"
    >
    @error('nombre')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="telefono">Telefono de la empresa @php
        if(!$empresa){
            print '<a style="color: tomato;">*</a>';
        }
    @endphp</label>
    <input
        id="telefono"
        name="telefono"
        type="text"
        class="form-control @error('telefono') is-invalid @enderror"
        placeholder="+56911111111"
        value="@php
            if(old('telefono')){
                print (old('telefono'));
            }else if($empresa){
                print $empresa->telefono;
            }
        @endphp"
    >
    @error('telefono')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="correo">Correo de la empresa</label>
    <input
        id="correo"
        name="correo"
        type="text"
        class="form-control @error('correo') is-invalid @enderror"
        placeholder="ejemplo@ejemplo"
        value="@php
            if(old('correo')){
                print (old('correo'));
            }else if($empresa){
                print $empresa->correo;
            }
        @endphp"
    >
    @error('correo')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="direccion">Direccion de la empresa @php
        if(!$empresa){
            print '<a style="color: tomato;">*</a>';
        }
    @endphp</label>
    <input
        id="direccion"
        name="direccion"
        type="text"
        class="form-control @error('direccion') is-invalid @enderror"
        placeholder="Dirección empresa 111"
        value="@php
            if(old('direccion')){
                print (old('direccion'));
            }else if($empresa){
                print $empresa->direccion;
            }
        @endphp"
    >
    @error('direccion')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="rl_rut">Rut del reprentante @php
        if(!$empresa){
            print '<a style="color: tomato;">*</a>';
        }
    @endphp</label>
    <input
        id="rl_rut"
        name="rl_rut"
        type="text"
        class="form-control @error('rl_rut') is-invalid @enderror"
        placeholder="11.111.111.1 o 11111111-1"
        value="@php
            if(old('rl_rut')){
                print (old('rl_rut'));
            }else if($empresa){
                print $empresa->rl_rut;
            }
        @endphp"
    >
    @error('rl_rut')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="rl_nombre">Nombre del reprentante @php
        if(!$empresa){
            print '<a style="color: tomato;">*</a>';
        }
    @endphp</label>
    <input
        id="rl_nombre"
        name="rl_nombre"
        type="text"
        class="form-control @error('rl_nombre') is-invalid @enderror"
        placeholder="Juan"
         value="@php
            if(old('rl_nombre')){
                print (old('rl_nombre'));
            }else if($empresa){
                print $empresa->rl_nombre;
            }
        @endphp"
    >
    @error('rl_nombre')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="rl_paterno">Apellido paterno del reprentante @php
        if(!$empresa){
            print '<a style="color: tomato;">*</a>';
        }
    @endphp</label>
    <input
        id="rl_paterno"
        name="rl_paterno"
        type="text"
        class="form-control @error('rl_paterno') is-invalid @enderror"
        placeholder="Pérez"
        value="@php
            if(old('rl_paterno')){
                print (old('rl_paterno'));
            }else if($empresa){
                print $empresa->rl_paterno;
            }
        @endphp"
    >
    @error('rl_paterno')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="rl_materno">Apellido materno del reprentante</label>
    <input
        id="rl_materno"
        name="rl_materno"
        type="text"
        class="form-control @error('rl_materno') is-invalid @enderror"
        placeholder="Soto"
        value="@php
            if(old('rl_materno')){
                print (old('rl_materno'));
            }else if($empresa){
                print $empresa->rl_materno;
            }
        @endphp"
    >
    @error('rl_materno')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="rl_telefono">Telefono del reprentante
        @php
        if(!$empresa){
            print '<a style="color: tomato;">*</a>';
        }
    @endphp
    </label>
    <input
        id="rl_telefono"
        name="rl_telefono"
        type="text"
        class="form-control @error('rl_telefono') is-invalid @enderror"}
        placeholder="+56911111111"
        value="@php
            if(old('rl_telefono')){
                print (old('rl_telefono'));
            }else if($empresa){
                print $empresa->rl_telefono;
            }
        @endphp"
    >
    @error('rl_telefono')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="correo">Correo del reprentante @php
        if(!$empresa){
            print '<a style="color: tomato;">*</a>';
        }
    @endphp</label>
    <input
        id="rl_correo"
        name="rl_correo"
        type="text"
        class="form-control @error('rl_correo') is-invalid @enderror"
        placeholder="ejemplo@ejemplo"
        value="@php
            if(old('rl_correo')){
                print (old('rl_correo'));
            }else if($empresa){
                print $empresa->rl_correo;
            }
        @endphp"
    >
    @error('rl_correo')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
