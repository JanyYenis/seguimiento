<input type="hidden" name="id" value="{{$calendario->id}}">
<div class="row">
    <div class="col-lg-12">
        <div class="fv-row mb-10">
            <label class="form-label required">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre" required value="{{$calendario?->nombre ?? ''}}"/>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="fv-row mb-10">
            <label class="form-label required">Descripción</label>
            <textarea class="form-control" name="descripcion" placeholder="Descripción" required id="" cols="30" rows="3" data-kt-autosize="true">{{$calendario?->descripcion ?? ''}}</textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="fv-row mb-10">
            <label class="form-label">URL</label>
            <input type="text" placeholder="URL" name="url" class="form-control" value="{{$calendario?->url ?? ''}}">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="fv-row mb-10">
            <label class="form-label required">Fecha Inicio</label>
            <input class="form-control" placeholder="Fecha inicio" name="fecha_inicio" id="kt_datepicker_1Editar" required value="{{$calendario?->fecha_inicio ?? ''}}"/>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="fv-row mb-10">
            <label class="form-label required">Hora</label>
            <input class="form-control" placeholder="Hora"  name="hora_inicio" id="kt_datepicker_2Editar" required value="{{$calendario?->fecha_inicio ? date("H:i", strtotime($calendario?->fecha_inicio)) : ''}}"/>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="fv-row mb-10">
            <label class="form-label required">Fecha Fin</label>
            <input class="form-control" placeholder="Fecha fin" name="fecha_fin" id="kt_datepicker_3Editar" required value="{{$calendario?->fecha_fin ?? ''}}"/>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="fv-row mb-10">
            <label class="form-label required">Hora</label>
            <input class="form-control" placeholder="Hora" name="hora_fin" id="kt_datepicker_4Editar" required value="{{$calendario?->fecha_fin ? date("H:i", strtotime($calendario?->fecha_fin)) : ''}}"/>
        </div>
    </div>
</div>