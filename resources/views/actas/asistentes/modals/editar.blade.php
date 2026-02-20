@php
    $asistente = $asistente ?? null;
@endphp
<input type="hidden" name="id" value="{{$asistente->id}}">
<input type="hidden" name="cod_acta" value="{{$asistente->cod_acta}}">
<div id="errores">
    @component('sistema/div-errores')
    @endcomponent
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 mb-7">
        <label class="required fs-5">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="{{ $asistente?->nombre ?? '' }}" placeholder="Ingrese el nombre de la reunion" required>
    </div>
    <div class="col-lg-12 col-md-12 mb-7">
        <label class="required fs-5">Rol</label>
        <input type="text" name="rol" class="form-control" value="{{ $asistente?->rol ?? '' }}" placeholder="Ingrese el rol" required>
    </div>
</div>
