@php
    $punto = $punto ?? null;
@endphp
<input type="hidden" name="id" value="{{$punto->id}}">
<input type="hidden" name="cod_acta" value="{{$punto->cod_acta}}">
<div id="errores">
    @component('sistema/div-errores')
    @endcomponent
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 mb-7">
        <label class="required fs-5">Orden</label>
        <input type="number" min="1" minlength="1" name="numero" class="form-control" value="{{ $punto?->numero ?? 1 }}" placeholder="Ingrese el orden del punto de la reunión" required>
    </div>
    <div class="col-lg-12 col-md-12 mb-7">
        <label class="required fs-5">Punto</label>
        <input type="text" name="titulo" class="form-control" value="{{ $punto?->titulo ?? '' }}" placeholder="Ingrese el punto de la reunion" required>
    </div>
    <div class="col-lg-12 col-md-12 mb-7">
        <label class="required fs-5">Responsable</label>
        <select name="cod_responsable" id="selectResponsableEdit" data-control="select2" data-placeholder="Seleccione el responsable" data-allow-clear="true" class="form-control" required data-dropdown-parent="body">
            <option value=""></option>
            @foreach ($responsables as $item)
                <option value="{{$item->id}}" {{$item->id == $punto?->cod_responsable ? 'selected' : ''}}>{{$item->nombre_completo}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-12 col-md-12 mb-7">
        <label class="fs-5">Descripción</label>
        <textarea name="descripcion" class="form-control" cols="30" rows="10">{{$punto?->descripcion ?? ''}}</textarea>
    </div>
</div>
